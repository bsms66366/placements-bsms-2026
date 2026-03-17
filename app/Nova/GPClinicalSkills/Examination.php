<?php

namespace App\Nova\GPClinicalSkills;

use App\Nova\Resource;

use Laravel\Nova\Fields\Boolean;
use Laravel\Nova\Fields\HasMany;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Number;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Http\Requests\NovaRequest;

class Examination extends Resource
{
    /**
     * The logical group associated with the resource.
     *
     * @var string
     */
    public static $group = 'GP/Clinical Skills';
    public static $model = \App\Models\Examination::class;

    public static $title = 'examination';

    public static $search = [
        'id',
        'examination',
        'category',
    ];

    public function fields(NovaRequest $request)
    {
        return [
            ID::make()->sortable(),

            Text::make('Examination', 'examination')
                ->sortable()
                ->rules('required', 'max:255')
                ->help('Name of the examination or skill'),

            Text::make('Category', 'category')
                ->sortable()
                ->nullable()
                ->rules('nullable', 'max:255')
                ->help('Optional category for grouping examinations'),

            Number::make('Sort Order', 'sort_order')
                ->sortable()
                ->default(0)
                ->rules('integer', 'min:0')
                ->help('Order for displaying examinations (lower numbers first)'),

            Boolean::make('Active', 'active')
                ->sortable()
                ->default(true)
                ->help('Whether this examination is currently active'),

            HasMany::make('Results', 'results', ExaminationResult::class),
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
