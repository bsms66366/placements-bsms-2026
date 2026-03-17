<?php

namespace App\Nova\GPClinicalSkills;

use App\Nova\Resource;
use App\Nova\Actions\Enrolled;
use Illuminate\Http\Request;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Fields\BelongsToMany;
use Laravel\Nova\Fields\Boolean;
use Laravel\Nova\Fields\Select;
use Laravel\Nova\Fields\Trix;
use Laravel\Nova\Http\Requests\NovaRequest;
use Webparking\BelongsToDependency\BelongsToDependency;
use NovaAttachMany\AttachMany;
class Rooms extends Resource
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
     * @var string
     */
    public static $model = \App\Models\Rooms::class;

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
        'id','name',
    ];

    /**
     * Get the fields displayed by the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function fields(Request $request)
    {

 

        return [
            ID::make(__('ID'), 'id')->sortable(),
            //BelongsTo::make('Rooms', 'name'),
            //Trix::make('Notes'),
            Text::make('Room', 'name'),
            
            Boolean::make('active')
            ->trueValue('Yes')
            ->falseValue('No'),
            //BelongsTo::make('GPTeacher'),
            BelongsTo::make('facilitator'),
            //BelongsTo::make('RotationGroup'),
            //BelongsTo::make('Workshops'),

        ];

         return [
           BelongsTo::make('Group'),
            
            //BelongsToDependency::make('RotationGroup')
                //->dependsOn('rooms', 'RotationGroup_id'),  
        ];  

        return [
            BelongsTo::make('Workshops'),
         ];  
    }

    /**
     * Get the cards available for the request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function cards(Request $request)
    {
        return [];
    }

    /**
     * Get the filters available for the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function filters(Request $request)
    {
        return [];
    }

    /**
     * Get the lenses available for the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function lenses(Request $request)
    {
        return [];
    }

    /**
     * Get the actions available for the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function actions(Request $request)
    {
        return [
            new \App\Nova\Actions\Enrolled,
        ];
    }
}
