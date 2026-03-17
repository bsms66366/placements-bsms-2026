<?php

namespace App\Nova\GPClinicalSkills;

use App\Nova\Resource;

use Laravel\Nova\Fields\DateTime;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Select;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Http\Requests\NovaRequest;

class PhaseOneStaff extends Resource
{
    /**
     * The logical group associated with the resource.
     *
     * @var string
     */
    public static $group = 'GP/Clinical Skills';
    public static $model = \App\Models\PhaseOneStaff::class;

    public static $title = 'AboutStaff';

    public static $search = [
        'ID',
        'AboutStaff',
        'StaffType',
        'Creator',
    ];

    public function fields(NovaRequest $request)
    {
        return [
            ID::make('ID', 'ID')
                ->sortable()
                ->readonly(),

            Text::make('About Staff', 'AboutStaff')
                ->sortable()
                ->rules('required', 'max:47')
                ->help('Name or description of the staff member'),

            Select::make('Staff Type', 'StaffType')
                ->options([
                    'Admin' => 'Admin',
                    'Facilitator' => 'Facilitator',
                ])
                ->sortable()
                ->rules('required', 'max:11')
                ->help('Role type: Admin or Facilitator')
                ->displayUsingLabels(),

            Text::make('Creator', 'Creator')
                ->sortable()
                ->rules('required', 'max:21')
                ->help('Who created this staff record'),

            DateTime::make('Created At', 'CreatedAt')
                ->sortable()
                ->rules('required')
                ->help('When this record was created'),
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
        return [];
    }
}
