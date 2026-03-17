<?php

namespace App\Nova;

//use App\Models\PathPots;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
//use Illuminate\Support\Facades\URL;
use Illuminate\Routing\UrlGenerator;
use Illuminate\Http\JsonResponse;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\URL;
use Laravel\Nova\Fields\Image;
use Laravel\Nova\Http\Requests\NovaRequest;
use Laravel\Nova\Fields\HasMany;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Fields\Date;
use Laravel\Nova\Fields\DateTime;
use Laravel\Nova\Fields\File;

use App\Nova\Filters\CategoryFilter;
//use APP_URL;
//use App\Nova\Fields\CustomFile;

class PathPots extends Resource
{
    /**
     * The model the resource corresponds to.
     *
     * @var string
     */
    public static $model = \App\Models\PathPots::class;

    /**
     * The single value that should be used to represent the resource when being displayed.
     *
     * @var string
     */
    public static $title = 'id';

    /**
     * The columns that should be searched.
     *
     * @var array
     */
    public static $search = [
    'id','name','administrator','category_id','Category','User'
    ];

    /**
     * Get the fields displayed by the resource.
     *
     * @param  \Laravel\Nova\Http\Requests\NovaRequest  $request
     * @return array
     */
    public function fields(NovaRequest $request)
    {
        //$filename = 'mccIiwLyj4j0pDn7xcXH1rlotkGoIScfoRPed9KS.pdf';
        //$path = storage_path($filename);
        return [
            ID::make()->sortable(),
            //ID::make(),
            Text::make('name', 'name'),
            BelongsTo::make('User'),
            Text::make('User Email', function () {
                    return $this->user->email ?? '-';
                }),
            URL::make('URL','urlCode'),
        //Text::make('administrator', 'administrator'),
            //Text::make('urlLink', 'urlCode'),
            //URL::make('urlCode','urlCode'),
//            Text::make('urlLink','urlCode', function () {
//            $urlCode = $this->urlCode;
//                       return "<a href='https://placements.ac.uk/storage/{$urlCode}'>@{$urlCode}</a>";
//                       })->asHtml(),
        
            //Text::make('email', 'email'),
            File::make('Notes','urlCode')
                ->disk('public')
            ->preview(function ($value, $disk) {
                return $value
                            ? Storage::disk($disk)->url($value)
                            : null;
                  }),
        
            //CustomFile::make('Note', 'urlCode')->disk('public'),
            DateTime::make('created_at', 'created_at'),
            //Text::make('updated_at', 'updated'),
            //File::make('Nova File Field', 'file')->exceptOnForms(),
            //Response::make(file_get_contents($path), 200, [
                        //'Content-Type' => 'application/pdf',
                        //'Content-Disposition' => 'inline; filename="'.$filename.'"']),
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
        return [
        //new CategoryFilter(),
        ];
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
        return [
        /*(new Actions\ShowPathPots)
                    ->uri('/api/ShowPathPots')
                    ->onlyOnTableRow(),*/
        ];
    }
}
