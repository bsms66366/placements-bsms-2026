<?php

namespace App\Nova\Physiology;

use App\Nova\Resource;


use Laravel\Nova\Actions\ExportAsCsv;
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
use Laravel\Scout\Searchable;

//use App\Nova\Filters\CategoryFilter;
//use App\Models\User;
use App\Models\Category;
use App\Models\Directory;
//use Searchable;
//use APP_URL;
//use App\Nova\Fields\CustomFile;

class Biomedeng extends Resource
{
    /**
     * The logical group associated with the resource.
     *
     * @var string
     */
    public static $group = 'Physiology';

    //Hide resource from sidebar
    public static $displayInNavigation = false;
    /**
     * The model the resource corresponds to.
     *
     * @var string
     */
    public static $model = \App\Models\Biomedeng::class;

    /**
     * The single value that should be used to represent the resource when being displayed.
     *
     * @var string
     */
    public static $title = 'name';
//    public static $globalSearchResults = 10;
    /**
     * Get the value that should be displayed to represent the resource.
     *
     * @return string
     */
    public function title()
    {
        return $this->name;
    }

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
        //$filename = 'mccIiwLyj4j0pDn7xcXH1rlotkGoIScfoRPed9KS.pdf';
        //$path = storage_path($filename);
        return [
            ID::make()->sortable(),
            //ID::make(),
            Text::make('name', 'name')
                        ->filterable(),
//                        ->searchable(),
            BelongsTo::make('User','user')
                    ->filterable(),
            Text::make('User Email', function () {
                    return $this->user->email ?? '-';
                }),
    
            BelongsTo::make('Directory'),
        
    
            BelongsTo::make('Category')
                        ->filterable(),
//                        ->searchable(),
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

            DateTime::make('created_at', 'created_at'),
        ];
    
    }
    public function category()
      {
          return $this->belongsTo(Category::class, 'category_id');
       }
public function directorys()
  {
      return $this->belongsTo(Directory::class, 'directory_id');
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
        ExportAsCsv::make('Export')->nameable()->withTypeSelector(true),
        ];
    }
}
