<?php

namespace App\Nova\GPClinicalSkills;

use App\Nova\Resource;

use Illuminate\Http\Request;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Http\Requests\NovaRequest;
//use Illuminate\Database\Eloquent\hasMany;
use Laravel\Nova\Fields\HasMany;
use Laravel\Nova\Fields\BelongsToMany;
use Laravel\Nova\Fields\BelongsTo;

use App\Models\User;
use App\Models\Dissections;
use App\Models\Notes;
use App\Models\Category;

use Laravel\Nova\Fields\SessionNote;


class Module102 extends Resource
{
    /**
     * The logical group associated with the resource.
     *
     * @var string
     */
    public static $group = 'GP/Clinical Skills';
    public static $displayInNavigation = false;
    /**
     * The model the resource corresponds to.
     *
     * @var class-string<\App\Models\Module102>
     */
    public static $model = \App\Models\Module102::class;

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
        'id','name','urlCode'
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
    
    
            ID::make()->sortable()->nullable(),
            //$this->SessionNote = Notes::findOrFail($request->Id),
            //$this->categorie = Category::findOrFail($request->Id),
        ];
    }

    /**
     * Get the cards available for the request.
     *
     * @param  \Laravel\Nova\Http\Requests\NovaRequest  $request
     * @return array
     */
    
//    public function cards(NovaRequest $request)
//
//    $user = Notes::find(1);
//
//    {
//        return [
//        foreach ($name->name as $name) {
//            echo $role->pivot->created_at;
//        }
//
//        ];
//
//        return $this->belongsToMany(Role::class)->withPivot('active', 'created_by');
//
//
//    }

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
