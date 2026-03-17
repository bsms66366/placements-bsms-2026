<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AppFeedback extends Model
{
    use HasFactory;

    protected $table = 'app_feedback';

    protected $fillable = [
        'bsms_id',
        'student_name',
        'email',
        'feedback_type',
        'subject',
        'message',
        'rating',
        'app_version',
        'device_info',
    ];

    protected $casts = [
        'rating' => 'integer',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    public function student()
    {
        return $this->belongsTo(Student::class, 'bsms_id', 'bsms_id');
    }
}
