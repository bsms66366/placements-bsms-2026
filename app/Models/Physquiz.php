<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\Category;
use App\Models\User;

class Physquiz extends Model
{
    use HasFactory;

    protected $table = 'physquiz';
     // Add your table name and fillable fields as needed
    //protected $fillable = ['name'];
    
    protected $fillable = [
        'question',
        'option_1',
        'option_2',
        'option_3',
        'option_4',
        'option_5',
        'answer',
        'explanation',
        'content_type',
        'user_id',
        'category_id',
        'urlCode',
    ];

    protected static function booted()
    {
        static::saving(function ($model) {
            $request = request();
            
            // Check if we're coming from Nova with a manual content type
            if ($request->has('manual_content_type')) {
                // If we have a manual content type from Nova, use it
                $model->content_type = $request->get('manual_content_type');
                return;
            }
            
            // Only run if urlCode is present and content_type is not already set
            if (!empty($model->urlCode) && empty($model->content_type)) {
                $url = $model->urlCode;
                if (str_contains($url, 'youtube.com') || str_contains($url, 'youtu.be')) {
                    $model->content_type = 'video';
                } elseif (str_ends_with($url, '.pdf')) {
                    $model->content_type = 'pdf';
                } elseif (preg_match('/\.(jpg|jpeg|png)$/i', $url)) {
                    $model->content_type = 'image';
                } elseif (preg_match('/\.(fbx|glb)$/i', $url)) {
                    $model->content_type = '3d-model';
                } elseif (str_ends_with($url, '.mp4')) {
                    $model->content_type = 'video';
                } else {
                    $model->content_type = 'unknown';
                }
            } else {
                // If urlCode is empty, clear content_type
                $model->content_type = null;
            }
        });
    }


 /**
     * Get the user that owns the quiz question.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the category that the quiz question belongs to.
     */
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

}
