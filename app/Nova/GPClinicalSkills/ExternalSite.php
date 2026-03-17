<?php

namespace App\Nova\GPClinicalSkills;

use App\Nova\Resource;

use Laravel\Nova\Fields\Boolean;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Select;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Fields\Textarea;
use Laravel\Nova\Http\Requests\NovaRequest;

class ExternalSite extends Resource
{
    /**
     * The logical group associated with the resource.
     *
     * @var string
     */
    public static $group = 'GP/Clinical Skills';
    public static $model = \App\Models\ExternalSite::class;

    public static $title = 'LocationName';

    public static $search = [
        'ID',
        'LocationName',
        'LocationCategory',
        'LocationPostcode',
    ];

    public function fields(NovaRequest $request)
    {
        return [
            ID::make('ID', 'ID')
                ->sortable()
                ->readonly(),

            Select::make('Location Category', 'LocationCategory')
                ->options([
                    'Simulation Flat' => 'Simulation Flat',
                    'Initial Assessment' => 'Initial Assessment',
                    'Community Hospital' => 'Community Hospital',
                    'Immersion Community' => 'Immersion Community',
                    'Other' => 'Other',
                ])
                ->sortable()
                ->rules('required', 'max:19')
                ->help('Category of the external site')
                ->displayUsingLabels(),

            Text::make('Location Name', 'LocationName')
                ->sortable()
                ->rules('required', 'max:68')
                ->help('Name of the location'),

            Boolean::make('Taxi Required', 'TaxiRequired')
                ->sortable()
                ->trueValue('TRUE')
                ->falseValue('FALSE')
                ->help('Whether taxi transport is required'),

            Textarea::make('Full Address', 'LocationFullAddress')
                ->nullable()
                ->rules('nullable', 'max:90')
                ->help('Complete address of the location')
                ->hideFromIndex(),

            Text::make('Postcode', 'LocationPostcode')
                ->sortable()
                ->nullable()
                ->rules('nullable', 'max:9')
                ->help('Location postcode'),

            Text::make('Contact Person', 'ContactPerson')
                ->nullable()
                ->rules('nullable', 'max:77')
                ->help('Primary contact person')
                ->hideFromIndex(),

            Text::make('Contact Number', 'ContactNumber')
                ->nullable()
                ->rules('nullable', 'max:26')
                ->help('Contact telephone number')
                ->hideFromIndex(),

            Text::make('Contact Email', 'ContactEmail')
                ->nullable()
                ->rules('nullable', 'max:70', 'email')
                ->help('Contact email address')
                ->hideFromIndex(),

            Textarea::make('Travel Suggestion', 'TravelSuggestion')
                ->nullable()
                ->rules('nullable', 'max:770')
                ->help('How to get to this location')
                ->hideFromIndex(),

            Text::make('Latitude', 'LocationLatitude')
                ->rules('required', 'max:18')
                ->help('Geographic latitude coordinate')
                ->hideFromIndex(),

            Text::make('Longitude', 'LocationLongitude')
                ->rules('required')
                ->help('Geographic longitude coordinate')
                ->hideFromIndex(),

            Select::make('Year 1', 'Year1')
                ->options([
                    'Yes' => 'Yes',
                    'No' => 'No',
                ])
                ->sortable()
                ->rules('required', 'max:3')
                ->help('Available for Year 1 students')
                ->displayUsingLabels(),

            Select::make('Year 2', 'Year2')
                ->options([
                    'Yes' => 'Yes',
                    'No' => 'No',
                ])
                ->sortable()
                ->rules('required', 'max:3')
                ->help('Available for Year 2 students')
                ->displayUsingLabels(),

            Text::make('Created At', 'created_at')
                ->sortable()
                ->rules('required', 'max:16')
                ->help('When this record was created')
                ->readonly(),

            Text::make('Modified', 'Modified')
                ->sortable()
                ->rules('required', 'max:16')
                ->help('Last modification date')
                ->readonly(),

            Text::make('Updated By', 'updated_by')
                ->sortable()
                ->rules('required', 'max:21')
                ->help('Who last updated this record'),
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
