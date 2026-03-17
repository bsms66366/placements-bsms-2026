<?php

namespace App\Nova\Anatomy;

use App\Nova\Resource;

use Illuminate\Http\Request;
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
use App\Nova\Filters\CategoryFilter;
use App\Models\Category;


class Spotters extends Resource
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
     * @var class-string<\App\Models\Spotters>
     */
    public static $model = \App\Models\Spotters::class;

    /**
     * The single value that should be used to represent the resource when being displayed.
     *
     * @var string
     */
    public static $title = 'id';
    
    //public static $defaultSort = 'id'; // Specify the default sort column
    
    /**
     * The columns that should be searched.
     *
     * @var array
     */
    public static $search = [
    'name'
    ];
    
    /**
     * Get the fields displayed by the resource.
     *
     * @param  \Laravel\Nova\Http\Requests\NovaRequest  $request
     * @return array
     */
    public function fields(NovaRequest $request)
    {
        // Get the default sort column and direction
                      // $defaultSortColumn = static::$defaultSort;
                       //$defaultSortDirection = 'asc';
        
        return [
                ID::make()->sortable(),
                Text::make('Name', 'name'),
                BelongsTo::make('User')->displayUsing(function ($user) {
                    return $user->email ?? '-';
                })->sortable(),
                URL::make('URL', 'link'),
                BelongsTo::make('Category')->nullable(),
                DateTime::make('Created At'),
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
    public function actions(NovaRequest $request)
    {
        return [];
    }
}
