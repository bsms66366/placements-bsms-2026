<?php

namespace App\Nova\Admin;

use App\Nova\Resource;

use Illuminate\Http\Request;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Boolean;
use Laravel\Nova\Http\Requests\NovaRequest;
use Laravel\Nova\Fields\Tag;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Fields\HasMany;
//use Laravel\Nova\Fields\BelongsToMany;

class Role extends Resource
{
    /**
     * The logical group associated with the resource.
     *
     * @var string
     */
    public static $group = 'Admin';

    public static $displayInNavigation = true;
    /**
     * The model the resource corresponds to.
     *
     * @var class-string<\App\Models\Role>
     */
    public static $model = \App\Models\Role::class;

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
        'id,name',
    ];

    public static function authorizedToViewAny(Request $request)
    {
        return $request->user()?->hasRole('admin') ?? false;
    }

    public function authorizedToView(Request $request)
    {
        return $request->user()?->hasRole('admin') ?? false;
    }

    public static function authorizedToCreate(Request $request)
    {
        return $request->user()?->hasRole('admin') ?? false;
    }

    public function authorizedToUpdate(Request $request)
    {
        return $request->user()?->hasRole('admin') ?? false;
    }

    public function authorizedToDelete(Request $request)
    {
        return $request->user()?->hasRole('admin') ?? false;
    }

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
        Text::make('Name')->sortable()->rules('required', 'max:255'),
         HasMany::make('Users'),
                    //BelongsToMany::make('Users'),
            //Boolean::make('Can View Users', 'id'),
            //Tag::make('Role')->showCreateRelationButton(),
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
