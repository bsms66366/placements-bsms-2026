<?php

namespace App\Nova\Anatomy;

use App\Nova\Resource;

use Laravel\Nova\Actions\ExportAsCsv;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Fields\Date;
use Laravel\Nova\Fields\DateTime;
use Laravel\Nova\Http\Requests\NovaRequest;
use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Fields\BelongsToMany;
use Laravel\Nova\Fields\HasMany;
use Laravel\Nova\Fields\Select;
use Laravel\Nova\Fields\URL;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\BelongsToManyRelationship;
use Illuminate\Database\Eloquent\Relations\HasOneOrMany;

//use App\Nova\Filters\CategoryFilter;

//use App\Nova\Imports\VideoImport;
use App\Models\Location;
use App\Models\GPTeacher;
use App\Models\Category;

class Dissection extends Resource
{
    /**
     * The logical group associated with the resource.
     *
     * @var string
     */
    public static $group = 'Anatomy';

    /**
     * The model the resource corresponds to.
     *
     * @var class-string<\App\Models\AnatomyDissection>
     */
    public static $model = \App\Models\Dissection::class;

    /**
     * The single value that should be used to represent the resource when being displayed.
     *
     * @var string
     */
    public static $title = 'name';
    public static $globalSearchResults = 10;
    public function title()
    {
        return $this->name;
    }
    /**
     * The columns that should be searched.
     *
     * @var array
     */
    public static $search = [
    'name'
    ];

    public static $defaultSort = 'id'; // Specify the default sort column
    
    /**
     * Get the fields displayed by the resource.
     *
     * @param  \Laravel\Nova\Http\Requests\NovaRequest  $request
     * @return array
     */
    
    


    public function fields(NovaRequest $request)
    {
        // Get the default sort column and direction
                $defaultSortColumn = static::$defaultSort;
                $defaultSortDirection = 'asc';
        
        
        
        return [
            //ID::make()->sortable(),
            Text::make('name', 'name')
                        ->filterable(),
//                        ->searchable(),
        
            //Text::make('administrator', 'administrator'),
            //Text::make('email', 'email'),
        BelongsTo::make('User','user'),
        Text::make('User Email', function () {
                return $this->user->email ?? '-';
            }),
        
            URL::make('URL','video'),
            //Text::make('video', 'video'),
            BelongsTo::make('Category')
                        ->nullable()
                        ->filterable(),
//                        ->searchable(),
        
            //BelongsTo::make('Category','category_id'),
            //BelongsTo::make('Category','category_id')->nullable(),
            //BelongsTo::make('category', 'dissection_id')->nullable(),
            //Text::make('category', 'category'),
            //Text::make('category', 'category_id'),
//        Select::make('Category')->options([
//                'Pathology Pot' => 'Pathology Pot',
//                'PA Program' => 'PA Program',
//                'Module 102' => 'Module 102',
//                'Module 103' => 'Module 103',
//                'Module 104' => 'Module 104',
//                'Module 202' => 'Module 202',
//                'Module 203' => 'Module 203',
//                'Module 204' => 'Module 204',
//                'Session Note' => 'Session Note',
//                'Post Graduate' => 'Post Graduate',
//                '360 Video' => '360 Video',
//                'Medical Neuroscience' => 'Medical Neuroscience',
//                'Pharmacy' => 'Pharmacy',
//                'Health Professionals' => 'Health Professionals',
//                'Biomedical Science' => 'Biomedical Science',
//                'Radiology' => 'Radiology',
//                'ENT' => 'ENT',
//                'Public Display' => 'Public Display',
//                'Introduction to:' => 'Introduction to',
//                'Head, Neck and Brain' => 'Head, Neck and Brain',
//                'Ear Nose and Throat' => 'Ear Nose and Throat',
//                'Thorax' => 'Thorax',
//                'Abdomen and Pelvis' => 'Abdomen and Pelvis',
//                'Back and limbs' => 'Back and Limbs',
//                'Embryology' => 'Embryology',
//                'Public Display' => 'Public Display',
//
//        ]),
        
            
            DateTime::make('created','created_at'),

        ];
        
        // Modify the query to use the default sort column and direction
                return $query->orderBy($defaultSortColumn, $defaultSortDirection);
        
     

        
}
    
                    //BelongsTo::make('GPTeacher', 'gp_teacher'),
            //BelongsTo::make('Category'),
            //BelongsTo::make('Categories')->nullable(),
        
        //BelongsTo::make('GP Teacher', 'gp_teachers')
        //BelongsTo::make('category', 'category'),
        
    
    
    
        
//        public function categoryFields()
//        {
//            return[
//            BelongsTo::make('Category','catergories'),
//    ];

//    }

    /**
     * Get the cards available for the request.
     *
     * @param  \Laravel\Nova\Http\Requests\NovaRequest  $request
     * @return array
     */
    public function cards(NovaRequest $request)
    {
        return [];
    }

    /**
     * Get the filters available for the resource.
     *
     * @param  \Laravel\Nova\Http\Requests\NovaRequest  $request
     * @return array
     */
    public function filters(NovaRequest $request)
    {
        return [
//        new CategoryFilter(),
        ];
    }

    /**
     * Get the lenses available for the resource.
     *
     * @param  \Laravel\Nova\Http\Requests\NovaRequest  $request
     * @return array
     */
    public function lenses(NovaRequest $request)
    {
        return [];
    }

    /**
     * Get the actions available for the resource.
     *
     * @param  \Laravel\Nova\Http\Requests\NovaRequest  $request
     * @return array
     */
    public function actions(NovaRequest $request)
    {
        return [
        ExportAsCsv::make('Export')->nameable()->withTypeSelector(true),
        //new Imports\VideoImport,
        ];
    }
    
    /**
         * Build an "index" query for the given resource.
         *
         * @param  \Laravel\Nova\Http\Requests\NovaRequest  $request
         * @param  \Illuminate\Database\Eloquent\Builder  $query
         * @return \Illuminate\Database\Eloquent\Builder
         */
        public static function indexQuery(NovaRequest $request, $query)
        {
            $categoryFilter = $request->query('category'); // Get the selected category ID from the query string
            
            if ($categoryFilter) {
                $category = Category::findOrFail($categoryFilter);

                // Modify the query to filter by the selected category
                $query->where('category_id', $category->id);
            }

            return $query;
        }
    
    /**
        * Get the displayable value of the resource's category.
        *
        * @return string
        */
       public function categoryDisplay()
       {
           return $this->category->name;
       }

       /**
        * Get the category that owns the resource.
        *
        * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
        */
       public function category()
       {
           return $this->belongsTo(Category::class);
       }
}
