<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Nova\Fields\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use Laravel\Nova\Actions\Actionable;
use Laravel\Nova\Fields\Image;
use Laravel\Nova\Http\Requests\NovaRequest;
use Laravel\Nova\Http\Requests\ResourceIndexRequest;
use Laravel\Nova\Http\Requests\ResourceDetailRequest;
use Laravel\Scout\Searchable;
//use Spatie\MediaLibrary\MediaCollections\Models\Media;
//use Ebess\AdvancedNovaMediaLibrary\Fields\Images;

class DicomModel extends Model
{
    use HasFactory, SoftDeletes, Actionable, Searchable;

    protected $table = 'dicom';
    protected $fillable = ['id', 'name','urlCode','user_id','email','course','created_at', 'updated_at', 'category_id'];
    
    public function User()
     {
        return $this->belongsTo(User::class, 'email');
     }
    public function Category()
        {
            
            return $this->belongsTo(Category::class);
        }
    public function registerMediaConversions(Media $media = null): void
    {
        $this->addMediaConversion('thumb')
            ->width(130)
            ->height(130);
    }

//    public function registerMediaCollections(): void
//    {
//        $this->addMediaCollection('main')->singleFile();
//        $this->addMediaCollection('my_multi_collection');
//    }
}
