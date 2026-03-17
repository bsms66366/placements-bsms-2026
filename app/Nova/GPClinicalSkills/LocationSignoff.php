<?php

namespace App\Nova\GPClinicalSkills;

use App\Nova\Resource;

use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Fields\DateTime;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Fields\Textarea;
use Laravel\Nova\Http\Requests\NovaRequest;

class LocationSignoff extends Resource
{
    /**
     * The logical group associated with the resource.
     *
     * @var string
     */
    public static $group = 'GP/Clinical Skills';
    public static $model = \App\Models\LocationSignoff::class;

    public static $title = 'signoff_name';

    public static $search = [
        'id',
        'location_barcode',
        'bsms_id',
        'signoff_name',
        'reg_number_of_approver',
    ];

    public function fields(NovaRequest $request)
    {
        return [
            ID::make()->sortable(),

            Text::make('Location Barcode', 'location_barcode')
                ->sortable()
                ->rules('required', 'max:255')
                ->help('The barcode identifier for the location'),

            Text::make('BSMS ID', 'bsms_id')
                ->sortable()
                ->rules('required', 'max:255')
                ->help('The BSMS student identifier'),

            Text::make('Reg Number of Approver', 'reg_number_of_approver')
                ->sortable()
                ->nullable()
                ->rules('nullable', 'max:255')
                ->help('Registration number of the person approving'),

            Text::make('Signoff Name', 'signoff_name')
                ->sortable()
                ->nullable()
                ->rules('nullable', 'max:255')
                ->help('Name of the person signing off'),

            Textarea::make('Signature SVG', 'signature_svg')
                ->nullable()
                ->rules('nullable')
                ->help('SVG path data for the signature')
                ->hideFromIndex(),

            DateTime::make('Created At', 'created_at')
                ->sortable()
                ->rules('required')
                ->help('When the signoff was created'),

            BelongsTo::make('Location', 'location', Location2025::class)
                ->sortable()
                ->rules('required')
                ->help('The location this signoff is associated with'),

            Text::make('Location Postcode', 'location_postcode')
                ->sortable()
                ->nullable()
                ->rules('nullable', 'max:255')
                ->help('Postcode of the location'),
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
