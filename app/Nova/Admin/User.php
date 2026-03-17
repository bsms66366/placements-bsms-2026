<?php

namespace App\Nova\Admin;

use App\Nova\Resource;

use Laravel\Nova\Actions\ExportAsCsv;
use Illuminate\Http\Request;
use Illuminate\Validation\Rules;
use Illuminate\Database\Eloquent\Factories\BelongsToManyRelationship;
use Illuminate\Database\Eloquent\Relations\HasOneOrMany;
//use Spatie\Permission\Traits\HasRoles;
// ...existing code...
//use App\Nova\Actions\UserResetPassword;
//use App\Nova\Actions\SendPasswordResetLink;


use Whitecube\NovaFlexibleContent\Flexible;
use Carbon\Carbon;
use Laravel\Nova\Fields\Gravatar;
use Laravel\Nova\Fields\Avatar;
use Illuminate\Support\Facades\Storage;
//use Laravel\Nova\Contracts\Cover
//use Laravel\Nova\Fields\DateTime;
use Laravel\Nova\Fields\Date;
use Laravel\Nova\Fields\DateTime;
use Laravel\Nova\Fields\Time;
use Laravel\Nova\Fields\Number;
use Laravel\Nova\Fields\Image;
use Laravel\Nova\Fields\Email;
use Laravel\Nova\Panel;
use Laravel\Nova\Fields\Trix;
use Laravel\Nova\Fields\Boolean;
use Laravel\Nova\Fields\Markdown;

use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Password;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Http\Requests\NovaRequest;
use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Fields\BelongsToMany;
use Laravel\Nova\Fields\HasMany;
use Laravel\Nova\Fields\MorphToMany;
use Laravel\Nova\Fields\Tag;
use Laravel\Nova\Fields\Select;

//use App\Nova\Metrics\FacilitatorCount;
use App\Nova\Actions\ActiveUser;
use App\Nova\Actions\Enrolled;
use App\Nova\Actions\SendPasswordResetLink;
use App\Nova\Actions\ResetPassword;

//use App\Nova\Actions\UserResetPassword;
//use App\Nova\Actions\ResetPassword;
//use App\Models\Location;
//use App\Models\GPTeacher;
use App\Models\Notes;
use App\Models\Dissections;
use App\Models\PathPots;
//use App\Models\Role;







class User extends Resource
{
    /**
     * The logical group associated with the resource.
     *
     * @var string
     */
    public static $group = 'Admin';

    /**
     * The model the resource corresponds to.
     *
     * @var string
     */
    public static $model = \App\Models\User::class;

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
        'id', 'name', 'email','username','location','dob'
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

            Avatar::make('Avatar')->squared()->rounded(),
            //Gravatar::make()->maxWidth(50),
            //Gravatar::make('Avatar', 'email'),

            Text::make('Name')
                ->sortable()
                ->rules('required', 'max:255'),
        
            Text::make('username')
                ->sortable()
                ->rules('required', 'max:255'),
               

            Email::make('Email')
                ->sortable()
                ->rules('required', 'email', 'max:254')
                ->creationRules('unique:users,email')
                ->updateRules('unique:users,email,{{resourceId}}'),

            Password::make('Password')
                ->onlyOnForms()
                ->creationRules('required', Rules\Password::defaults())
                ->updateRules('nullable', Rules\Password::defaults()),
        
//            Select::make('Role')->options([
//            'admin' => 'Admin',
//            'editor' => 'Editor',
//            'user' => 'User',
//            ])->displayUsingLabels(),
        BelongsTo::make('Role')->sortable(), // connects user to role table
        
        
        //Avatar::make('Avatar', 'avatar')
//            ->disk('public')
//            ->store(function (Request $request, $model) {
//                if ($request->hasFile('avatar')) {
//                    $path = $request->file('avatar')->store('avatars', 'public');
//                    $model->avatar = $path;
//                    $model->save();
//                }
//            })
//            ->prunable(),

        
            //Tag::make('Role')->showCreateRelationButton(),
            //Tag::make('Role'),
            
            // ...existing code...
         
        
                new Panel('User Information', $this->userInformation()),
                //new Panel('GP Teacher', $this->GPFields()),
                //new Panel('GP Address', $this->addressFields()),
                //new Panel('Notes', $this->notesFields()),
                //new Panel('Placement', $this->placementField()),

        ];
        
     }
        
    /**
     * Get the address fields for the resource.
     *
     * @return array
     */
    
    protected function UserInformation()
{
    //Age = Carbon::createFromDate(2016)->addYears(4);
return [
    //ID::make(__('ID'), 'id')->sortable(),
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
    //Text::make('Name', 'name')->required(),
    //Text::make('Username','username')->required(),
    //Number::make('Student Number','student_number')->required(),
    //Text::make('First name','first_name')->required(),
    Text::make('Known As','known_as' ),
    //Text::make('Year','year')->required(),
    //Text::make('Email','email')->required(),
    //Text::make('Rotation Group','rotation_group')->required(),
    //Text::make('GPTeacher','GPTeacher'),
    //BelongsTo::make('GPTeacher'),
    //DateTime::make('age','dob')->age(),
    //Carbon::createFromDate('Age','DOB'),
    //Text::make('Age', function () { return $this->getAge(); }),
    //BelongsTo::make('Placement'),
    //Text::make('Gender'),
    Select::make('Gender')->options([
        'Male' => 'Male',
        'Female' => 'Female',
        'Non-binary' => 'Non-binary',
        'Prefer not to say' => 'Prefer not to say',
        'Other (please specify)' => 'Other (please specify)',
                                    
    ]),
    //Date::make('Age')->required(),
    //Text::make('Age'),
//    Boolean::make('Car Owner','car_owner')
//     ->trueValue('Yes')
//     ->falseValue('No'),
     Date::make('dob','dob'),
     DateTime::make('Registered','created_at'),
     
    //Date::make('dob','dob')->format('Y-m-d'),
    //DateTime::make('age', function () { return $this->getAttributeAge(); }),
    //Date::make('DOB','dob')
    //->pickerDefaultHour(23)//Add default hour
    //->pickerDefaultMinute(59)//Add default minute
    //->pickerDefaultSeconds(59) //Add default seconds
    //->format('DD MMM YYYY'),
];

}

//public function GPFields()
//{
//     return[
//        BelongsTo::make('GP Teacher', 'gp_teacher'),
//    ];
//}
//public function addressFields()
//{
//    return[
//    BelongsTo::make('Locations','locations'),
//];
//
//}
//public function notesFields()
//{
//    return[
//        Trix::make('Notes','notes'),
//    ];
//}

//public function placementField()
//{
//    return[
//        HasMany::make('placement'),
//    ];
//}

    //public function authorizedToView(Request $request): bool
    //{
        //return $request->user()->isAdmin(); // Adjust this condition based on your authorization logic
    //}
     


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
        return [
            //new Actions\ActivateUser,
            //new Actions\UserResetPassword,
            //new Actions\SendPasswordResetLink,
            new ResetPassword,
            ExportAsCsv::make('Export')->nameable()->withTypeSelector(true),

        ];
    }
}
