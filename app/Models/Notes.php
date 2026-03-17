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

class Notes extends Model
{
    use HasFactory;
    protected $fillable = ['id', 'name', 'administrator', 'urlCode','email', 'video','created_at'];
    
    public function User()
     {
        return $this->belongsTo(User::class, 'administrator');
     }
    public function User2()
     {
        return $this->belongsTo(User::class, 'email');
     }
    public function Category()
        {

            //return $this->hasMany(Category::class (category_id));
            
            return $this->belongsTo(Category::class);
        }
    
    public function Module101()
        {

            //return $this->hasMany(Category::class (category_id));
            
            return $this->belongsTo(Module101::class);
        }
    
    public function Module102()
        {

            //return $this->hasMany(Category::class (category_id));
            
            return $this->belongsTo(Module102::class);
        }
    
}



