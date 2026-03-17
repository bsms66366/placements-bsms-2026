<?php

namespace App\Nova\GPClinicalSkills;

use App\Nova\Resource;

use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Http\Requests\NovaRequest;

class MonitoredSessions2026 extends Resource
{
    /**
     * The logical group associated with the resource.
     *
     * @var string
     */
    public static $group = 'GP/Clinical Skills';
    /**
     * The model the resource corresponds to.
     *
     * @var class-string<\App\Models\MonitoredSessions2026>
     */
    public static $model = \App\Models\MonitoredSessions2026::class;

    /**
     * The single value that should be used to represent the resource when being displayed.
     *
     * @var string
     */
    public static $title = 'SessionTitle';

    /**
     * The columns that should be searched.
     *
     * @var array
     */
    public static $search = [
        'ID',
        'ModuleCode',
        'SessionTitle',
        'ClinicalSubType',
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
            ID::make('ID', 'ID')
                ->sortable()
                ->readonly(),

            Text::make('Module Code', 'ModuleCode')
                ->sortable()
                ->rules('required', 'max:21')
                ->help('The module code for this session'),

            Text::make('Session Title', 'SessionTitle')
                ->sortable()
                ->rules('required', 'max:86')
                ->help('The title of the session')
                ->displayUsing(fn ($value) => $value),

            Text::make('Clinical Sub Type', 'ClinicalSubType')
                ->sortable()
                ->nullable()
                ->rules('nullable', 'max:26')
                ->help('Optional clinical sub-type classification'),
        ];
    }

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
        return [];
    }
}
