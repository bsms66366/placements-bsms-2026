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

class Category extends Model
{
    use HasFactory;
    protected $table = 'categories';
    
    protected $fillable = ['id', 'name', 'updated_at', 'created_at', 'category_id'];
    
    
    
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
}
