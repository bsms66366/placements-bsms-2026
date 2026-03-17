<?php

namespace App\Nova\GPClinicalSkills;

use App\Nova\Resource;
use App\Nova\Facilitator;
use App\Nova\Rooms;
use App\Nova\Actions\Enrolled;
use Illuminate\Http\Request;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Fields\Boolean;
use Laravel\Nova\Fields\Select;
use Laravel\Nova\Fields\BelongsToMany;
use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Fields\HasMany;

use Laravel\Nova\Http\Requests\NovaRequest;

class Workshops extends Resource
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
    public static $model = \App\Models\Workshops::class;

    /**
     * The single value that should be used to represent the resource when being displayed.
     *
     * @var string
     */
    public static $title = 'Workshops';

    /**
     * The columns that should be searched.
     *
     * @var array
     */
    public static $search = [
        'Workshops',
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
            ID::make(__('ID'), 'id'),
        Select::make('Workshops','name')->options([
            'Cardio-Resp-Gastro and Rectal Examination',
            'Cranial Nerves and Eye Examination',
            'Peripheral Nervous System',
            'Gynae History and Pelvic Examination',
            'GALS and MSK Examination',
            'Basic Observations',
            'ECG Recording and Glucose Monitoring with Urinalysis',
            'IM injections, Bandaging and Wound Assessment',
            'Wound Closure and BLS',
             'CTS Revision',
        ]),
            //Text::make('Workshops', 'Workshops'),
        
        
             //BelongsTo::make('Room'),
            //Text::make('Room', 'Room'),
        
             
            //Text::make('Workshop Time', 'Workshop Time'),
            Select::make('Workshop Time','workshop_time')->options([
                '12:00 - 13:15',
                '13:30 - 2:45',
                '15:00 - 16:45',
            ]),
            
            //Text::make('Workshop Group', 'workshop_group'),
            Select::make('Workshop Group','workshop_group')->options([
                'red',
                'blue',
                'green',
                'yellow',
                                                   
                                                   
            ]),
        
        Select::make('Room','room')->options([
            'Watson 303',
            'Watson 304',
            'Watson 305',
            'Watson 307',
            'Watson 310',
        ]),
            Boolean::make('active')
            ->trueValue('Yes')
            ->falseValue('No'),

            BelongsTo::make('Facilitator'),
           
         

           // HasMany::make('Rooms'),
            //BelongsToMany::make('facilitator'),
          
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
        return [];
    }
}
