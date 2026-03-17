<?php

namespace App\Nova\GPClinicalSkills;

use App\Nova\Resource;
//use IziDev\VCalendar\SuperDatePicker;
//use Inspheric\Fields\Indicator;

//use App\Nova\Actions\Activate;
//use App\Nova\Actions\Status;

//use App\Nova\Actions\Enrolled;
//use App\Nova\Actions\ActivateUser;
use App\Nova\Metrics\FacilitatorCount;
use KirschbaumDevelopment\Nova\InlineSelect;
//use Jagdeepbanga\NovaDateTime\NovaDateTime as DateTime;
use Illuminate\Database\DBAL\TimestampType;
use Illuminate\Http\Request;
use Laravel\Nova\Fields\DateTime;
use Laravel\Nova\Fields\Date;
use Laravel\Nova\Fields\HasMany;
use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Fields\Timestamp;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Fields\Boolean;
use Laravel\Nova\Fields\Select;
use Laravel\Nova\Http\Requests\NovaRequest;

class Facilitator extends Resource
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
    public static $model = \App\Models\Facilitator::class;
    

      /* protected $dates = [
         'created_at' => 'datetime',
        'updated_at' => 'datetime',
        'JoiningDate' => 'datetime',
    ]; */

//Casts of the model dates
  /*  protected $casts = [
    'JoiningDate' => 'datetime',
    //'LeavingDate' => 'datetime',
];  */
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
        'id',
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
            Text::make('name','name'),
            Boolean::make('active')
            ->trueValue('Yes')
            ->falseValue('No'),
            Text::make('First name','firstname'),
            Text::make('Surname', 'surname'),
            Text::make('Known AS','known_as'),
            Text::make('Email','email'),
            Text::make('Address','address'),
            Text::make('Designation','designation'),
            Text::make('Qualification','qualification'),
            //InlineSelect::make('Status'),
            //Text::make('Status', 'Status'),
            Text::make('bsms ID','bsms_id'),
            Text::make('Teaching Subject', 'teaching_subject'),
            Text::make('Joining Date', 'joining_date')
            //DateTime::make('Joining Date', 'joining_date')
            /* ->pickerDefaultHour(23)  //Add default hour
            ->pickerDefaultMinute(59)//Add default minute
            ->pickerDefaultSeconds(59) //Add default seconds

            //HasMany::make('Workshops') */
            
        ];

/*         return[
        Indicator::make('Status') ->labels([
                'banned' => 'Banned',
                'active' => 'Active',
                'invited' => 'Invited',
                'inactive' => 'Inactive',
]), 
            
];*/

 }

    /**
     * Get the cards available for the request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function cards(Request $request)
    {
        return [
            (new FacilitatorCount())->width('full'),
        ];
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
    /*     return [
            InlineSelect::make('Status') ->options(function () {
        return [
            'one' => 'foo',
            'two' => 'bar',
        ];
    }),


        ]; */
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
            //new Actions\Enrolled,
            //new Actions\ActivateUser,
            //new Actions\Status,
            //(new Activate)->canSee(function ($request) {
                //return $request->user()->can('Set Active Status');
                //})
           //Actions\Activate::make()
        ]; 
    }
}
/* public function Workshops()
    {

        $this->HasMany(Workshops::class);
    }  */
