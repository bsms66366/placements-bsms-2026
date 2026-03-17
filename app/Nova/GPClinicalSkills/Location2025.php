<?php

namespace App\Nova\GPClinicalSkills;

use App\Nova\Resource;

use Laravel\Nova\Fields\DateTime;
use Laravel\Nova\Fields\HasMany;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Fields\Textarea;
use Laravel\Nova\Http\Requests\NovaRequest;

class Location2025 extends Resource
{
    /**
     * The logical group associated with the resource.
     *
     * @var string
     */
    public static $group = 'GP/Clinical Skills';
    public static $model = \App\Models\Location2025::class;

    public static $title = 'name';

    public static $search = [
        'id',
        'name',
        'gp_postcode',
        'barcode_no',
        'gp_town',
    ];

    public function fields(NovaRequest $request)
    {
        return [
            ID::make()->sortable(),

            Text::make('Name', 'name')
                ->sortable()
                ->rules('required', 'max:255')
                ->help('Name of the GP practice or location'),

            Text::make('Address', 'gp_address')
                ->sortable()
                ->rules('required', 'max:255')
                ->help('Street address of the location'),

            Text::make('Town', 'gp_town')
                ->sortable()
                ->rules('required', 'max:255')
                ->help('Town or city'),

            Text::make('Postcode', 'gp_postcode')
                ->sortable()
                ->rules('required', 'max:255')
                ->help('Postcode'),

            Text::make('Telephone', 'gp_telno')
                ->sortable()
                ->rules('required', 'max:255')
                ->help('Contact telephone number'),

            Textarea::make('Travel Instructions', 'gp_travel')
                ->rules('required', 'max:255')
                ->help('How to get to this location')
                ->hideFromIndex(),

            Text::make('Barcode Number', 'barcode_no')
                ->sortable()
                ->rules('max:255')
                ->help('Barcode identifier for the location'),

            DateTime::make('Created At', 'created_at')
                ->sortable()
                ->exceptOnForms(),

            DateTime::make('Updated At', 'updated_at')
                ->sortable()
                ->exceptOnForms(),

            HasMany::make('Signoffs', 'signoffs', LocationSignoff::class),
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
