<?php

namespace App\Nova\GPClinicalSkills;

use App\Nova\Resource;

use Laravel\Nova\Fields\DateTime;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Http\Requests\NovaRequest;

class LocationCategory extends Resource
{
    /**
     * The logical group associated with the resource.
     *
     * @var string
     */
    public static $group = 'GP/Clinical Skills';
    public static $model = \App\Models\LocationCategory::class;

    public static $title = 'name';

    public static $search = [
        'id',
        'name',
    ];

    public function fields(NovaRequest $request)
    {
        return [
            ID::make()->sortable(),

            Text::make('Name', 'name')
                ->sortable()
                ->rules('nullable', 'max:11')
                ->help('Category name (e.g., Sim Flat, IA, Immersion, GP, C_hospital)'),

            DateTime::make('Created At', 'created_at')
                ->sortable()
                ->exceptOnForms(),

            DateTime::make('Updated At', 'updated_at')
                ->sortable()
                ->exceptOnForms(),
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
