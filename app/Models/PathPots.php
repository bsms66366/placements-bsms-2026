<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Nova\Fields\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use Laravel\Nova\Actions\Actionable;

use Laravel\Nova\Http\Requests\NovaRequest;
use Laravel\Nova\Http\Requests\ResourceIndexRequest;
use Laravel\Nova\Http\Requests\ResourceDetailRequest;
use Laravel\Scout\Searchable;

class PathPots extends Model
{
    use HasFactory;
    protected $table = 'pathpots';
    protected $fillable = ['id', 'name', 'administrator', 'urlCode','email','course','created_at', 'updated_at'];
    
    public function User()
     {
        return $this->belongsTo(User::class, 'email');
     }
    public function Category()
        {

            //return $this->hasMany(Category::class (category_id));
            
            return $this->belongsTo(Category::class);
        }
    /**
     * Build a Scout search query for the given resource.
     *
     * @param  \Laravel\Nova\Http\Requests\NovaRequest  $request
     * @param  \Laravel\Scout\Builder  $query
     * @return \Laravel\Scout\Builder
     */
    
    public static function scoutQuery(NovaRequest $request, $query)
    {
        return $query;
    }
}

