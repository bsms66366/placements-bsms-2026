<?php

namespace App\Nova\Anatomy;

use App\Nova\Resource;

use Laravel\Nova\Actions\ExportAsCsv;
use Illuminate\Http\Request;
use Laravel\Nova\Http\Requests\NovaRequest;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\HasMany;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Fields\BelongsToMany;

use App\Models\Notes;

class Category extends Resource
{
    /**
     * The logical group associated with the resource.
     *
     * @var string
     */
    public static $group = 'Anatomy';
    //Hide resource from sidebar
    public static $displayInNavigation = false;
    
  

    /**
     * The model the resource corresponds to.
     *
     * @var string
     */
    public static $model = \App\Models\Category::class;

    /**
     * The single value that should be used to represent the resource when being displayed.
     *
     * @var string
     */
    public static $title = 'name';

    /**
     * The columns that should be searched.
     *
     * @var array
     */
    public static $search = [
        'id','name'
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
            Text::make('name', 'name'),
            //BelongsToMany::make('Notes')
        
            //HasMany::make('Notes'),
            //Text::make('updated_at', 'updated_at'),
            //Text::make('created_at', 'created_at'),
            //BelongsTo::make('AnatomyDissection'),
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
        return [];
    }

    /**
     * Get the actions available for the resource.
     *
     * @param  \Laravel\Nova\Http\Requests\NovaRequest  $request
     * @return array
     */
    
    public static function availableForQuery(Request $request)
           {
               return true; // Allow export for all records
           }
    
    public function actions(NovaRequest $request)
    {
       
        return [
        //ExportAsCsv->download('your_resource_export.csv'),
        ExportAsCsv::make('Export')->nameable()->withTypeSelector(true),
//        ExportAsCsv::make()->withTypeSelector(true)->withFormat(function ($model) {
//                return [
//                    'ID' => $model->getKey(),
//                    'Name' => $model->name,
//                ];
//            }),
        ];
    }
}
