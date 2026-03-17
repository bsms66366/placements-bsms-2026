<?php

namespace App\Nova\GPClinicalSkills;

use App\Nova\Resource;

use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Fields\DateTime;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Http\Requests\NovaRequest;

class SessionAttendance2026 extends Resource
{
    /**
     * The logical group associated with the resource.
     *
     * @var string
     */
    public static $group = 'GP/Clinical Skills';
    public static $model = \App\Models\SessionAttendance2026::class;

    public static $title = 'id';

    public static $search = [
        'id',
        'bsms_id',
    ];

    public function fields(NovaRequest $request)
    {
        return [
            ID::make()->sortable(),

            Text::make('BSMS ID', 'bsms_id')
                ->sortable()
                ->rules('required', 'max:255')
                ->help('Student BSMS identifier'),

            DateTime::make('Session Date', 'session_date')
                ->sortable()
                ->rules('required')
                ->help('Date and time of session attendance'),

            BelongsTo::make('Session', 'session', MonitoredSessions2026::class)
                ->sortable()
                ->rules('required')
                ->help('The monitored session attended'),
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
