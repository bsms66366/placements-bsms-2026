<?php

namespace App\Models;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\BelongsToManyRelationship;
use Illuminate\Database\Eloquent\Relations\HasOneOrMany;
use Laravel\Nova\Fields\DateTime;
use Laravel\Nova\Fields\Date;
use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Fields\BelongsToMany;
use Laravel\Nova\Fields\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Category;

use App\Nova\Filters\CategoryFilter;






class Spotters extends Model
{
    use HasFactory;
    protected $fillable = ['id', 'name', 'email','link','created_at','category_id','user_id'];
    
    public function category()
            {

                //return $this->hasMany(Category::class);
                return $this->belongsTo(Category::class);
            }
        
        public function user()
         {
            return $this->belongsTo(User::class);
         }
    
}
