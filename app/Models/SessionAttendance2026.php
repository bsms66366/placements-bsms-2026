<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SessionAttendance2026 extends Model
{
    use HasFactory;

    protected $table = 'session_attendance_2026';

    public $timestamps = false;

    protected $fillable = [
        'bsms_id',
        'session_date',
        'session_id',
    ];

    protected $casts = [
        'session_date' => 'datetime',
        'session_id' => 'integer',
    ];

    public function session()
    {
        return $this->belongsTo(MonitoredSessions2026::class, 'session_id', 'ID');
    }
}
