<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Examination extends Model
{
    use HasFactory;

    protected $table = 'examinations';

    public $timestamps = false;

    protected $fillable = [
        'examination',
        'category',
        'sort_order',
        'active',
    ];

    protected $casts = [
        'sort_order' => 'integer',
        'active' => 'boolean',
    ];

    public function results()
    {
        return $this->hasMany(ExaminationResult::class, 'examination_id');
    }
}
