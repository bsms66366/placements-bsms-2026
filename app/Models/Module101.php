<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\AsEnumCollection;

use Illuminate\Database\Eloquent\hasMany;
use Laravel\Nova\Fields\BelongsToMany;
use Laravel\Nova\Fields\BelongsTo;
use App\Enums\StatusEnum;
use App\Models\Notes;
use App\Models\Category;



class Module101 extends Model
{
    use HasFactory;
    protected $fillable = ['id', 'name', 'urlCode','Status','category_id'];
    
    public function Notes()
        {

            //return $this->hasMany(Category::class (category_id));
            
            return $this->belongsTo(Notes::class);
        }
    
    public function Category()
        {

            //return $this->hasMany(Category::class (category_id));
            
            return $this->belongsTo(Category::class);
        }
    
    /**
         * Write code on Method
         *
         * @return response()
         */
        protected $casts = [
            //'status' => StatusEnum::class
            'status' => AsEnumCollection::class.':'.StatusEnum::class,
        ];

}
