<?php

namespace App\Nova\GPClinicalSkills;

use App\Nova\Resource;

use Illuminate\Http\Request;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Text;
use Illuminate\Support\Str;
use Laravel\Nova\Http\Requests\NovaRequest;
use Laravel\Nova\Fields\Markdown;
use Laravel\Nova\Fields\Markdown\MarkdownPreset;
use Laravel\Nova\Fields\Select;
use Laravel\Nova\Fields\Number;
use Laravel\Nova\Fields\Textarea;

class Invitation extends Resource
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
     * @var class-string<\App\Models\Invitation>
     */
    public static $model = \App\Models\Invitation::class;

    
    //Hide resource from sidebar
    public static $displayInNavigation = false;
    /**
     * The single value that should be used to represent the resource when being displayed.
     *
     * @var string
     */
    public static $title = 'id';
    
    //public function title()
    //{
        //return $this->name;
    //}

    /**
     * The columns that should be searched.
     *
     * @var array
     */
    public static $search = [
        'id',
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
                    ID::make()->sortable(),

                    Text::make('Code')
                        ->withMeta([
                            'readonly'  => true,
                            'value'     => (function () {
                                return $this->code ?? Str::random();
                            })()
                        ])
                        ->rules('required')
                        ->sortable(),

                    Select::make('Type')
                        ->options([
                            'student'       => 'Student',
                            'college'       => 'college',
                            'employee'      => 'employee',
                            'general'       => 'general'
                        ])
                        ->rules('required')
                        ->sortable(),

                    Text::make('Fullname')
                        ->rules('required')
                        ->sortable(),

                    Text::make('Email')
                        ->rules('required')
                        ->sortable(),

                    Number::make('Phone')
                        ->nullable()
                        ->sortable(),

                    Textarea::make('Email Content')
                        ->rules('required')
                        ->sortable(),

                    Text::make('Notes')
                        ->nullable()
                        ->sortable(),

                    Select::make('Status')
                        ->options([
                            'Open'      => 'Open',
                            'Process'   => 'Process',
                            'Closed'    => 'Closed',
                            'Aborted'   => 'Aborted'
                        ])
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
