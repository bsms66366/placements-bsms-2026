<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ExaminationResult extends Model
{
    use HasFactory;

    protected $table = 'examination_results';

    protected $fillable = [
        'examination_id',
        'bsms_id',
        'is_competent',
        'assessed_at',
    ];

    protected $casts = [
        'examination_id' => 'integer',
        'is_competent' => 'boolean',
        'assessed_at' => 'datetime',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    public function examination()
    {
        return $this->belongsTo(Examination::class, 'examination_id');
    }
}
