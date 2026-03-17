<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Fields\BelongsToMany;
use Laravel\Nova\Fields\HasMany;

use App\Models\Dissections;
use App\Models\Notes;
use App\Models\Category;

class Directory extends Model
{
    use HasFactory;
    protected $table = 'directorys';
    
    protected $fillable = ['id', 'name', 'administrator', 'urlCode','email','course','created_at', 'updated_at'];
    
    
    
    public function notes()
    {
        return $this->HasMany(Notes::class);
        //return $this->belongsToMany(Notes::class);
        //return $this->belongsTo(Workshops::class);
    }
    public function dissections()
    {
        //return $this->HasMany(Notes::class);
        //return $this->belongsToMany(Notes::class);
        return $this->belongsTo(Dissections::class);
    }
    public function directorys()
    {
        //return $this->HasMany(Notes::class);
        //return $this->belongsToMany(Notes::class);
        return $this->belongsTo(Directory::class);
    }
    public function Category()
        {

            //return $this->hasMany(Category::class (category_id));
            
            return $this->belongsTo(Category::class);
        }
}
