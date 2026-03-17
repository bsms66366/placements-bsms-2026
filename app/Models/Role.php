<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Nova\Fields\Tag;
//use Laravel\Nova\Fields\Text;

class Role extends Model
{
    use HasFactory;
    protected $fillable = ['id'];
    
    public function users()
    {
        return $this->hasMany(User::class); // single-role pattern
    }

}
