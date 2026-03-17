<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Nova\Fields\DateTime;
use Laravel\Nova\Fields\Date;
use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Fields\BelongsToMany;
use Laravel\Nova\Fields\HasMany;
use App\Models\Category;
//use App\Models\Location;
//use App\Models\GPTeacher;
//use App\Models\Notes;

class Dissection extends Model
{
    use HasFactory;
    protected $fillable = ['id', 'name', 'video','created_at','category_id'];
    
    protected $table = 'dissections';
    
    
     // Casts of the model dates & other data types
    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
        //'dob' => 'datetime',
    ];
    
    
    
    //public function category_id()
    //{
        //return $this->belongsTo(Category::class, 'category_id');
    //}
    
    
    
public function Category()
        {

            //return $this->hasMany(Category::class);
            return $this->belongsTo(Category::class);
        }
    
    public function User()
     {
        return $this->belongsTo(User::class, 'email');
     }

    
    }


