<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MonitoredSessions2026 extends Model
{
    use HasFactory;

    protected $table = 'MonitoredSessions2026';

    protected $primaryKey = 'ID';

    public $timestamps = false;

    protected $fillable = [
        'ID',
        'ModuleCode',
        'SessionTitle',
        'ClinicalSubType',
    ];

    protected $casts = [
        'ID' => 'integer',
    ];
}
