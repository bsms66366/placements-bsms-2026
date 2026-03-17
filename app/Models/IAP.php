<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Nova\Fields\Heading;

class IAP extends Model
{
 
    use HasFactory;
    protected $fillable = ['id', 'InitalAssement'];
}
 