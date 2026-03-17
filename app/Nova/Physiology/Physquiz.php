<?php

namespace App\Nova\Physiology;

use App\Nova\Resource;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
//use Illuminate\Support\Facades\URL;
use Illuminate\Routing\UrlGenerator;
use Illuminate\Http\JsonResponse;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Fields\Textarea;
//use Laravel\Nova\Fields\Boolean;
use Laravel\Nova\Fields\Select;
use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Fields\HasMany;
use Laravel\Nova\Fields\DateTime;
use Laravel\Nova\Fields\Date;
use Laravel\Nova\Fields\URL;
use Laravel\Nova\Fields\File;
use Laravel\Nova\Http\Requests\NovaRequest;

use App\Models\User;
use App\Models\Category;

class Physquiz extends Resource
{
    /**
     * The logical group associated with the resource.
     *
     * @var string
     */
    public static $group = 'Physiology';

    /**
     * The model the resource corresponds to.
     *
     * @var class-string<\App\Models\physquiz>
     */
    public static $model = \App\Models\Physquiz::class;

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
            Text::make('Question'),
            Text::make('Option 1'),
            Text::make('Option 2'),
            Text::make('Option 3'),
            Text::make('Option 4'),
            Text::make('Option 5'),

            Text::make('answer'),
            Textarea::make('explanation'),

            BelongsTo::make('User')->sortable()->filterable()->nullable(),

            Text::make('User Email', function () {
                return $this->user->email ?? '-';
            }),

            BelongsTo::make('Category')->sortable()->filterable()->nullable(),
            //DateTime::make('Created At', 'created_at')->onlyOnDetail(),
            DateTime::make('Updated At', 'updated_at')->onlyOnDetail(),
        
     // Manual URL input panel
        $manualUrlPanel = \Laravel\Nova\Panel::make('Manual URL Input', [
            // Direct field for manual URL input
            Text::make('Manual URL', 'urlCode')
                ->hideFromIndex()
                ->hideFromDetail()
                ->onlyOnForms()
                ->help('Enter a URL directly. This will override any file upload.')
                ->rules('nullable', 'url')
                ->nullable(),
                
            // Direct field for content type selection
            Select::make('Content Type', 'content_type')
                ->options([
                    'video' => 'Video',
                    'pdf' => 'PDF',
                    'image' => 'Image',
                    '3d-model' => '3D Model',
                    'other' => 'Other'
                ])
                ->hideFromIndex()
                ->hideFromDetail()
                ->onlyOnForms()
                ->nullable(),
        ]),

        // Hidden field that actually stores the URL
        Text::make('URL Code', 'urlCode')
            ->onlyOnDetail(),

        // Upload 3D models, Images, PDFs and Video Urls
        File::make('Upload File', 'urlCode')
            ->disk('public')
            ->prunable()
            ->acceptedTypes('.pdf,.jpg,.jpeg,.png,.mp4,.fbx,.glb')
            ->rules('nullable', function($attribute, $value, $fail) {
                // Get the current request
                $request = request();
                
                // Skip validation if we're using a manual URL
                if (!empty($request->urlCode) && filter_var($request->urlCode, FILTER_VALIDATE_URL)) {
                    return;
                }
                
                // Only validate if a file is being uploaded
                if ($request->hasFile('urlCode')) {
                    $validator = Validator::make(
                        ['urlCode' => $request->file('urlCode')],
                        ['urlCode' => 'mimetypes:application/pdf,image/jpeg,image/png,video/mp4,application/octet-stream,model/fbx,model/gltf-binary|max:1073741824']
                    );
                    
                    if ($validator->fails()) {
                        $fail($validator->errors()->first('urlCode'));
                    }
                }
            })
            ->store(function (Request $request, $model) {
                // Log all request data for debugging
                \Log::info('Physquiz form submission', [
                    'all_request_data' => $request->all(),
                    'has_file' => $request->hasFile('urlCode'),
                    'current_urlCode' => $model->urlCode,
                    'current_content_type' => $model->content_type
                ]);
                
                // If a file is being uploaded, handle it normally
                if ($request->hasFile('urlCode')) {
                    $file = $request->file('urlCode');
                    $originalFilename = $file->getClientOriginalName();
                    $path = $file->storeAs('', $originalFilename, 'public');
                    $fullUrl = 'https://placements.bsms.ac.uk/storage/' . $path;
                    
                    $mimeType = $file->getMimeType();
                    $extension = strtolower($file->getClientOriginalExtension());
                    
                    $contentType = match (true) {
                        $mimeType === 'application/pdf' => 'pdf',
                        str_starts_with($mimeType, 'image/') => 'image',
                        str_starts_with($mimeType, 'video/') => 'video',
                        in_array($extension, ['fbx', 'glb']) ||
                        in_array($mimeType, ['model/fbx', 'model/gltf-binary']) => '3d-model',
                        default => 'unsupported'
                    };

                    \Log::info('Using uploaded file', [
                        'filename' => $originalFilename,
                        'path' => $path,
                        'url' => $fullUrl,
                        'content_type' => $contentType
                    ]);
                    
                    // Set the content type directly on the model and save it
                    $model->forceFill([
                        'content_type' => $contentType
                    ]);
                    $model->save();
                    
                    return $fullUrl;
                }
                
                // If no file was provided, don't change anything
                return $model->urlCode;
            })
            ->help('Upload a file, or use the Manual URL Input field above'),

        // Display the content type
        Text::make('Content Type', 'content_type')
            ->readonly(),

        // Display the URL
        URL::make('Resource URL', 'urlCode')
            ->readonly(),

            DateTime::make('created_at', 'created_at'),
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
