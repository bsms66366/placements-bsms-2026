<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
//use Spatie\MediaLibrary\HasMedia;
//use Spatie\MediaLibrary\InteractsWithMedia;
//use Spatie\MediaLibrary\MediaCollections\Models\Media;
//use Ebess\AdvancedNovaMediaLibrary\Fields\Images;

class Dicom extends Model
{
    use HasFactory;

    protected $table = 'dicom';
    protected $fillable = ['id', 'name', 'urlCode', 'user_id', 'email', 'course', 'created_at', 'updated_at', 'category_id'];

    // Other model methods and relationships...

    // Define media conversions and collections as needed
//    public function registerMediaConversions(Media $media = null): void
//    {
//        $this->addMediaConversion('thumb')
//            ->width(130)
//            ->height(130);
//    }

//    public function registerMediaCollections(): void
//    {
//        $this->addMediaCollection('main')->singleFile();
//        $this->addMediaCollection('my_multi_collection');
//    }
}

