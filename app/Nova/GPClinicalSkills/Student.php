<?php

namespace App\Nova\GPClinicalSkills;

use App\Nova\Resource;
use Whitecube\NovaFlexibleContent\Flexible;
use App\Models\Location2025;
use App\Nova\Actions\ActiveUser;
use App\Models\GPTeacher;
use App\Nova\Metrics\FacilitatorCount;
use Illuminate\Database\Eloquent\Factories\BelongsToManyRelationship;
use Illuminate\Database\Eloquent\Relations\HasOneOrMany;


use App\Nova\Actions\Enrolled;
use Illuminate\Http\Request;

use Laravel\Nova\Fields\DateTime;
use Laravel\Nova\Fields\Date;
use Laravel\Nova\Fields\Time;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Number;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Fields\Gravatar;
use Laravel\Nova\Fields\Image;
use Laravel\Nova\Http\Requests\NovaRequest;
use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Fields\BelongsToMany;
use Laravel\Nova\Fields\HasMany;
use Laravel\Nova\Panel;
use Laravel\Nova\Fields\Trix;
use Laravel\Nova\Fields\Boolean;
use Laravel\Nova\Fields\Markdown;
use Carbon\Carbon;



class Student extends Resource
{
    /**
     * The logical group associated with the resource.
     *
     * @var string
     */
    public static $group = 'GP/Clinical Skills';

    public static $displayInNavigation = true;
    /**
     * The model the resource corresponds to.
     *
     * @var string
     */
    public static $model = \App\Models\Student::class;
  

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
        'id','name','user_id','location','student','dob',
    ];

    /**
     * Get the fields displayed by the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function fields(NovaRequest $request)
    {

        return[
            new Panel('Student Information', $this->studentInformation()),
            new Panel('GP Teacher', $this->GPFields()),
            new Panel('GP Practice', $this->addressFields()),
            new Panel('Facilitators', $this->facilitatorFields()),
            new Panel('Notes', $this->notesFields()),
            new Panel('Session Attendance', $this->sessionAttendanceFields()),
            new Panel('Placement Location Signoffs', $this->locationSignoffFields()),
            new Panel('Examination Results', $this->examinationResultsFields()),
        ];
    }
/**
 * Get the address fields for the resource.
 *
 * @return array
 */

            protected function studentInformation()
        {
            //Age = Carbon::createFromDate(2016)->addYears(4); 
        return [
            ID::make(__('ID'), 'id')->sortable(),
            //Image::make('Photo')->disableDownload(),
            //Gravatar::make('Avatar', 'EmailAddress')->maxWidth(50),
            //Gravatar::make()->maxWidth(50),
             // Removed temporarily as there is no corresponding
            // database column in gp_teachers table. This prevents
            // us saving teachers using the Nova UI.
           Boolean::make('active')
            ->trueValue('Yes')
            ->falseValue('No'),
            // END
            Text::make('Name', 'name')->required(),
            Text::make('BSMSID','bsms_id')->required(),
            Number::make('Student Number','student_number')->required(),
            Text::make('First name','first_name')->required(),
            Text::make('Known As','known_as' ),
            Text::make('Year','year')->required(),
            Text::make('Email','email')->required(),
            Text::make('Rotation Group','rotation_group')->required(),
            Text::make('Seminar Group','seminar_group')->nullable(),
            Text::make('CPW','cpw')->nullable(),
            Text::make('CPS','cps')->nullable(),
            Text::make('CPW/CPS','cpw_cps')->nullable(),
            Text::make('Simulated Home Visit Group','simulated_home_visit_group')->nullable(),
           //Text::make('GPTeacher','GPTeacher'),
            //BelongsTo::make('GPTeacher'),
            //DateTime::make('age','dob')->age(),
            //Carbon::createFromDate('Age','DOB'),
            //Text::make('Age', function () { return $this->getAge(); }),
            //BelongsTo::make('Placement'),
            Text::make('Gender'),
            //Date::make('Age')->required(),
            Text::make('Age')->required(),
            Boolean::make('Car Owner','car_owner')
             ->trueValue('Yes')
             ->falseValue('No'),
             Date::make('DOB','dob')->filterable(),
             
            //DateTime::make('age', function () { return $this->getAttributeAge(); }),
           
            //->pickerDefaultHour(23)//Add default hour
            //->pickerDefaultMinute(59)//Add default minute
            //->pickerDefaultSeconds(59) //Add default seconds
            //->format('DD MMM YYYY'), 
        ];
        
        }
        
        public function GPFields()
        {
             return[
                BelongsTo::make('GP Teacher', 'gp_teacher', 'App\Nova\GPClinicalSkills\GPTeacher'),
            ];
        }
        public function addressFields()
        {
            return[
            BelongsTo::make('Location2025','location2025'),
    ];

        }


         public function facilitatorFields()
        {
             return[
                BelongsTo::make('Facilitator', 'facilitator'),
            ];
        }
        public function notesFields()
        {
            return[
                Trix::make('Notes','notes'),
            ]; 
        }

        public function sessionAttendanceFields()
        {
            return[
                \App\Nova\Fields\AttendanceDisplay::make('Session Attendance Records', 'sessions')
                    ->onlyOnDetail(),
            ]; 
        }

        public function locationSignoffFields()
        {
            return[
                \App\Nova\Fields\AttendanceDisplay::make('Location Signoff Records', 'locations')
                    ->onlyOnDetail(),
            ]; 
        }

        public function examinationResultsFields()
        {
            return[
                \App\Nova\Fields\AttendanceDisplay::make('Examination Results Records', 'examinations')
                    ->onlyOnDetail(),
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
        return [
            (new \App\Nova\Metrics\AttendanceStatistics())->width('1/4'),
            (new \App\Nova\Metrics\SessionAttendanceCount())->width('1/4'),
            (new \App\Nova\Metrics\LocationSignoffCount())->width('1/4'),
            (new \App\Nova\Metrics\ExaminationCompetency())->width('1/4'),
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
            //new \App\Nova\Actions\ImportUsers,
            //new \App\Nova\Actions\ImportStudents,
           // new \App\Nova\Actions\Enrolled,
           new \App\Nova\Actions\ActivateUser,
           new \App\Nova\Actions\ExportAttendancePDF,
        ];
    }
}
