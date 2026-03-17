<?php

namespace App\Nova\GPClinicalSkills;

use App\Nova\Resource;

use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Fields\Boolean;
use Laravel\Nova\Fields\DateTime;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Http\Requests\NovaRequest;

class ExaminationResult extends Resource
{
    /**
     * The logical group associated with the resource.
     *
     * @var string
     */
    public static $group = 'GP/Clinical Skills';
    public static $model = \App\Models\ExaminationResult::class;

    public static $title = 'id';

    public static $search = [
        'id',
        'bsms_id',
    ];

    public function fields(NovaRequest $request)
    {
        return [
            ID::make()->sortable(),

            BelongsTo::make('Examination', 'examination', Examination::class)
                ->sortable()
                ->rules('required')
                ->help('The examination being assessed'),

            Text::make('BSMS ID', 'bsms_id')
                ->sortable()
                ->rules('required', 'max:255')
                ->help('Student BSMS identifier'),

            Boolean::make('Is Competent', 'is_competent')
                ->sortable()
                ->default(false)
                ->help('Whether the student demonstrated competency'),

            DateTime::make('Assessed At', 'assessed_at')
                ->sortable()
                ->rules('required')
                ->help('When the assessment took place'),

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
