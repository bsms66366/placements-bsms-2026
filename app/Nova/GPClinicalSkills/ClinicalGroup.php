<?php

namespace App\Nova\GPClinicalSkills;

use App\Nova\Resource;

use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Number;
use Laravel\Nova\Http\Requests\NovaRequest;

class ClinicalGroup extends Resource
{
    /**
     * The logical group associated with the resource.
     *
     * @var string
     */
    public static $group = 'GP/Clinical Skills';
    public static $model = \App\Models\ClinicalGroup::class;

    public static $title = 'id';

    public static $search = [
        'id',
    ];

    public function fields(NovaRequest $request)
    {
        return [
            ID::make()->sortable(),

            Number::make('Rotation Group', 'Rotation Group')
                ->sortable()
                ->nullable()
                ->rules('nullable', 'integer')
                ->help('Rotation group number'),

            Number::make('Seminar Group', 'Seminar Group')
                ->sortable()
                ->nullable()
                ->rules('nullable', 'integer')
                ->help('Seminar group number'),

            Number::make('CPW', 'CPW')
                ->sortable()
                ->nullable()
                ->rules('nullable', 'integer')
                ->help('Clinical Practice Workshop group'),

            Number::make('CPS', 'CPS')
                ->sortable()
                ->nullable()
                ->rules('nullable', 'integer')
                ->help('Clinical Practice Session group'),

            Number::make('CPW/CPS', 'CPW/CPS')
                ->sortable()
                ->nullable()
                ->rules('nullable', 'integer')
                ->help('Combined CPW/CPS group'),

            Number::make('Simulated Home Visit Group', 'Simulated Home Visit Group')
                ->sortable()
                ->nullable()
                ->rules('nullable', 'integer')
                ->help('Simulated home visit group number'),
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
