<?php

namespace App\Nova\GPClinicalSkills;

use App\Nova\Resource;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Fields\Date;
use Laravel\Nova\Fields\Boolean;
use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Fields\HasMany;
use Laravel\Nova\Fields\Select;
use Laravel\Nova\Http\Requests\NovaRequest;
use App\Nova\Actions\ExportAttendancePDF;
use App\Nova\Actions\ExportCohortAttendancePDF;
use App\Nova\Actions\ExportAttendanceCSV;

class Student extends Resource
{
    public static $group = 'GP/Clinical Skills';
    
    public static $model = \App\Models\Student::class;

    public static $title = 'name';

    public static $search = [
        'id',
        'name',
        'bsms_id',
        'student_number',
        'email',
    ];

    public function fields(NovaRequest $request)
    {
        return [
            ID::make()->sortable(),

            Boolean::make('Active', 'active')
                ->trueValue('1')
                ->falseValue('0'),

            Text::make('Name')
                ->sortable()
                ->rules('required', 'max:255'),

            Text::make('BSMS ID', 'bsms_id')
                ->sortable()
                ->rules('required', 'max:255'),

            Text::make('Student Number', 'student_number')
                ->sortable()
                ->rules('required', 'max:255'),

            Text::make('First name', 'first_name')
                ->sortable()
                ->rules('required', 'max:255'),

            Text::make('Known As', 'known_as')
                ->sortable()
                ->rules('max:255'),

            Text::make('Email')
                ->sortable()
                ->rules('required', 'email', 'max:255'),

            Text::make('Year')
                ->sortable()
                ->rules('required'),

            Text::make('Rotation Group', 'rotation_group')
                ->sortable()
                ->rules('required', 'max:255'),

            Text::make('Seminar Group', 'seminar_group')
                ->sortable()
                ->rules('max:255'),

            Text::make('CPW', 'cpw')
                ->sortable()
                ->rules('max:255'),

            Text::make('CPS', 'cps')
                ->sortable()
                ->rules('max:255'),

            Text::make('CPW/CPS', 'cpw_cps')
                ->sortable()
                ->rules('max:255'),

            Text::make('Simulated Home Visit Group', 'simulated_home_visit_group')
                ->sortable()
                ->rules('max:255'),

            Date::make('Date of Birth', 'dob')
                ->sortable(),

            Select::make('Gender', 'gender')
                ->options([
                    'male' => 'Male',
                    'female' => 'Female',
                ])
                ->displayUsingLabels()
                ->rules('required'),

            Text::make('Age', 'age')
                ->sortable()
                ->rules('required', 'max:255'),

            Select::make('Car Owner', 'car_owner')
                ->options([
                    'Yes' => 'Yes',
                    'No' => 'No',
                ])
                ->displayUsingLabels()
                ->rules('required'),

            BelongsTo::make('GP Practice', 'location2025', Location2025::class)
                ->rules('required'),

            BelongsTo::make('GP Teacher', 'gp_teacher', GPTeacher::class)
                ->rules('required'),

            BelongsTo::make('Facilitator', 'facilitator', Facilitator::class)
                ->nullable(),

            BelongsTo::make('Group', 'group', Group::class)
                ->nullable(),

            HasMany::make('Session Attendance', 'sessionAttendance', SessionAttendance2026::class),

            HasMany::make('Location Signoffs', 'locationSignoffs', LocationSignoff::class),

            HasMany::make('Examination Results', 'examinationResults', ExaminationResult::class),
        ];
    }

    public function cards(NovaRequest $request)
    {
        return [];
    }

    public function filters(NovaRequest $request)
    {
        return [];
    }

    public function lenses(NovaRequest $request)
    {
        return [];
    }

    public function actions(NovaRequest $request)
    {
        return [
            new ExportAttendancePDF,
            new ExportCohortAttendancePDF,
            new ExportAttendanceCSV,
        ];
    }
}
