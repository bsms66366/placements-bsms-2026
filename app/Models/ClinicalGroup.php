<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ClinicalGroup extends Model
{
    use HasFactory;

    protected $table = 'clinical _groups';

    public $timestamps = false;

    protected $fillable = [
        'Rotation Group',
        'Seminar Group',
        'CPW',
        'CPS',
        'CPW/CPS',
        'Simulated Home Visit Group',
    ];

    protected $casts = [
        'Rotation Group' => 'integer',
        'Seminar Group' => 'integer',
        'CPW' => 'integer',
        'CPS' => 'integer',
        'CPW/CPS' => 'integer',
        'Simulated Home Visit Group' => 'integer',
    ];
}
