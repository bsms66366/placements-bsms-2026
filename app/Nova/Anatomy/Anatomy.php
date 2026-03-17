<?php

namespace App\Nova\Anatomy;

use App\Nova\Resource;
use Whitecube\NovaFlexibleContent\Flexible;
use App\Models\Dissections;
use App\Nova\Actions\ActiveUser;
use App\Models\Category;
use App\Models\Notes;
use Illuminate\Database\Eloquent\Factories\BelongsToManyRelationship;
use Illuminate\Database\Eloquent\Relations\HasOneOrMany;


use App\Nova\Actions\Enrolled;
use Illuminate\Http\Request;

use Laravel\Nova\Fields\Date;
use Laravel\Nova\Fields\DateTime;
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



class Anatomy extends Resource
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
     * @var string
     */
    public static $model = \App\Models\Anatomy::class;
  
    public static $displayInNavigation = false;
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
        'id','name','notes_id','notes',
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
            new Panel('AnatomyInformation', $this->anatomyInformation()),
            //new Panel('Notes', $this->noteFields()),
            new Panel('Dissection Videos', $this->DissectionFields()),
            //new Panel('Notes', $this->notesFields()),
            //new Panel('tweet', $this->tweetField()),
            //BelongsTo::make('Locations'),
        ];
    }
/**
 * Get the address fields for the resource.
 *
 * @return array
 */

            protected function anatomyInformation()
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
           //Boolean::make('active')
            //->trueValue('Yes')
           // ->falseValue('No'),
            // END
            Text::make('Name', 'name')->required(),
            Text::make('Administrator','adminisrator')->required(),
            Text::make('Email','email')->required(),
            Number::make('Video','video')->required(),
            Text::make('URL','urlCode')->required(),
            BelongsTo::make('category', 'category', 'App\Nova\Anatomy\Category'),
            //Text::make('Category','name')->required(),
            DateTime::make('created','created_at'),



            //Text::make('Known As','known_as' )->required(),
            //Text::make('Rotation Group','rotation_group')->required(),
            
            //Text::make('GPTeacher','GPTeacher'),
            //BelongsTo::make('GPTeacher'),
            //DateTime::make('age','dob')->age(),
            //Carbon::createFromDate('Age','DOB'),
            //Text::make('Age', function () { return $this->getAge(); }),
            //BelongsTo::make('tweet'),
            //Text::make('Age')->required(),
            //Date::make('DOB','dob'),
            //DateTime::make('age', function () { return $this->getAttributeAge(); }),
           
            //->pickerDefaultHour(23)//Add default hour
            //->pickerDefaultMinute(59)//Add default minute
            //->pickerDefaultSeconds(59) //Add default seconds
            //->format('DD MMM YYYY'), 
        ];
        
        }
        
        public function notesFields()
        {
            return[
                //Trix::make('Notes','notes'),
            BelongsTo::make('Notes','notes'),
            ]; 
        }

        public function dissectionFields()
        {
            return[
                HasMany::make('Dissection','dissections'),
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
            //new Actions\ImportUsers,
            //new Actions\ImportStudents,
           // new Actions\Enrolled,
           //new Actions\ActivateUser,
        ];
    }
}
