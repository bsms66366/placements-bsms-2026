<?php

namespace App\Nova\GPClinicalSkills;

use App\Nova\Resource;
use App\Nova\Actions\Enrolled;
use App\Nova\Actions\ActivateUser;
//use Jagdeepbanga\NovaDateTime\NovaDateTime as DateTime;
use Illuminate\Database\DBAL\TimestampType;
use Laravel\Nova\Fields\DateTime;
use Laravel\Nova\Fields\Date;
use Illuminate\Http\Request;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Fields\Boolean;
use Laravel\Nova\Fields\Select;
use Laravel\Nova\Panel;
use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Fields\BelongsToMany;
use Laravel\Nova\Http\Requests\NovaRequest;
use Laravel\Nova\Fields\Status;


class GPTeacher extends Resource
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
    public static $model = \App\Models\GPTeacher::class;

    /**
     * The single value that should be used to represent the resource when being displayed.
     *
     * @var string
     */
    public static $title = 'name';
    //public static $title = 'name';

    /**
     * The columns that should be searched.
     *
     * @var array
     */
    public static $search = [
        'name','surname','bsms_id','nhs_id',
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
            ID::make(__('ID'), 'id'), //->sortable(),
            new Panel('Address Information', $this->addressFields()),
        ];
    }
    protected function addressFields()
{
    return [
            //Text::make('name','name'),
            Boolean::make('active')
            ->trueValue('Yes')
            ->falseValue('No'),


            Text::make('name','name'),

            /* Status::make('Status')
    ->loadingWhen(['waiting', 'running'])
    ->failedWhen(['failed']), */


            Text::make('Firstname','firstname'),
            Text::make('Surname', 'surname'),
            Text::make('Known AS','known_as'),
            Text::make('Email','email'),
            Text::make('Address','address'),
            Text::make('NHS id','nhs_id'),
            Text::make('Designation','designation'),
            Text::make('Qualification','qualification'),
            //Text::make('JoiningDate','JoiningDate'),
           //Text::make('LeavingDate','LeavingDate'),
            //Text::make('Status', 'status'),
            Text::make('bsmsID', 'bsms_id'),
            Text::make('TeachingSubject', 'teaching_subject'),
            //Date::make('Joining Date', 'joining_date'),
            //DateTime::make('JoiningDate', 'joining_date'),
            //DateTime::make('Leaving Date', 'leaving_date'),
            //DateTime::make('JoiningDate', 'joining_date')
            
            //->pickerDefaultHour(23)  //Add default hour
            //->pickerDefaultMinute(59)//Add default minute
            //->pickerDefaultSeconds(59), //Add default seconds

            //DateTime::make('Leaving Date', 'leaving_date')
            //->pickerDefaultHour(23)  //Add default hour
            //->pickerDefaultMinute(59)//Add default minute
            //->pickerDefaultSeconds(59) //Add default seconds
        ];     
             return[
        new Panel('GP Surgery Information', $this->GPFields())

    ];
    return[
        BelongsTo::make('Location'),

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
                (new \App\Nova\Actions\ActivateUser)
                    ->confirmText('Are you sure you want to activate this user?')
                    ->confirmButtonText('Activate')
                    ->cancelButtonText("Don't activate"),
        ];
    }
    /* public function Rooms()
    {

        $this->HasMany(Room::class);
    } */  
}
