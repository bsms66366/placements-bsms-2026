<?php

namespace App\Nova\Anatomy;

use App\Nova\Resource;
use App\Nova\Lenses\CourseCategory;
use Illuminate\Http\Request;
//use Laravel\Nova\Fields\BelongsToMany;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Http\Requests\NovaRequest;

class FilteredPotResource extends Resource
{
    /**
     * The logical group associated with the resource.
     *
     * @var string
     */
    public static $group = 'Anatomy';
    
    public static $displayInNavigation = false;
    /**
     * The model the resource corresponds to.
     *
     * @var class-string<\App\Models\FilteredNoteResource>
     */
    //public static $model = \App\Models\FilteredNoteResource::class;
    public static $model = \App\Models\PathPots::class;
    /**
     * The single value that should be used to represent the resource when being displayed.
     *
     * @var string
     */
    public static $title = 'id';

    /**
     * The columns that should be searched.
     *
     * @var array
     */
    public static $search = [
        'category_id','name'
    ];

    /**
     * Get the fields displayed by the resource.
     *
     * @param  \Laravel\Nova\Http\Requests\NovaRequest  $request
     * @return array
     */
    public function fields(NovaRequest $request)
    {
        return [
            ID::make()->sortable(),
            Text::make('name'),
            Text::make('category_id')
//            Text::make('Category ID', function () {
//            $categoryID = $this->category_id;
//
//            $filteredResponses = \App\Models\Notes::where('category_id', $categoryID)->get();
//
//            $result = '';
//
//            foreach ($filteredResponses as $response) {
//                // Access the properties of the response and perform calculations or apply logic
//                $result .= $response->category_id;
//            }
//
//            return $result ? $result : 'No responses found';
//        }),

     
//        Text::make('Category ID', function () {
//            $category = \App\Models\Category::find(11); // Replace 1 with the desired category ID
//            return $category ? $category->name : 'N/A';
//        }),

        
        ];
    }

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
        return [];
    }

    /**
     * Get the lenses available for the resource.
     *
     * @param  \Laravel\Nova\Http\Requests\NovaRequest  $request
     * @return array
     */
    public function lenses(NovaRequest $request)
    {
        return [
        new CourseCategory()
        ];
    }

    /**
     * Get the actions available for the resource.
     *
     * @param  \Laravel\Nova\Http\Requests\NovaRequest  $request
     * @return array
     */
    public function actions(NovaRequest $request)
    {
        return [];
    }
}
