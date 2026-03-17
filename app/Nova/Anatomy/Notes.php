<?php

namespace App\Nova\Anatomy;

use App\Nova\Resource;

use Laravel\Nova\Actions\ExportAsCsv;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Storage;
use Illuminate\Routing\UrlGenerator;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Http\Requests\NovaRequest;
use Laravel\Nova\Fields\File;
use Laravel\Nova\Fields\URL;
use Laravel\Nova\Fields\HasMany;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Fields\Date;
use Laravel\Nova\Fields\DateTime;
use Laravel\Scout\Searchable;
use Laravel\Nova\Fields\Trix;
use Laravel\Nova\Fields\Image;

//use Ebess\AdvancedNovaMediaLibrary\Fields\Files;
//use Ebess\AdvancedNovaMediaLibrary\Fields\Images;

use App\Models\User;
use App\Models\Category;


class Notes extends Resource
{
    /**
     * The logical group associated with the resource.
     *
     * @var string
     */
    public static $group = 'Anatomy';
    /**
     * The model the resource corresponds to.
     *
     * @var class-string<\App\Models\Notes>
     */
    public static $model = \App\Models\Notes::class;

    /**
     * The single value that should be used to represent the resource when being displayed.
     *
     * @var string
     */
    public static $title = 'name';

    /**
     * The columns that should be searched.
     *
     * @var array
     */
    public static $search = [
        'name'
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
            Text::make('Name', 'name')->sortable(),
            
            BelongsTo::make('User'),
            Text::make('User Email', function () {
                return $this->user->email ?? '-';
            }),
            BelongsTo::make('Category'),
            
            //Text::make('Directory Name')->rules('required', 'string'),
            Text::make('URL', 'urlCode')->onlyOnIndex()->resolveUsing(function () {
                // Assuming 'urlCode' is the field that stores the URL
                return $this->urlCode;
            }),
            URL::make('URL', 'urlCode')->onlyOnDetail(),
            
        File::make('PDF Files', 'urlCode')
            ->disk('public')
            ->store(function (Request $request, $model) {
                $directory = '';
                $originalFilename = $request->file('urlCode')->getClientOriginalName();
                $path = $request->file('urlCode')->storeAs($directory, $originalFilename, 'public');

                // Define the host URL prefix
                $hostUrl = 'https://placements.bsms.ac.uk/storage/';
                    
                    // Define your custom prefix
                    //$prefix = 'DICM/';
                    
                // Combine the host URL prefix and file path to create the full URL
                $fullUrl = $hostUrl . $path;
                //$fullUrl = $hostUrl . $prefix . $path;


                // Save the URL in the database
                $model->urlCode = $fullUrl;
                $model->save();

              return [
                  //'notes' => $path,
                ];
            }),

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
