<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PhaseOneStaff extends Model
{
    use HasFactory;

    protected $table = 'phase_one_staff';

    protected $primaryKey = 'ID';

    public $timestamps = false;

    protected $fillable = [
        'AboutStaff',
        'StaffType',
        'Creator',
        'CreatedAt',
    ];

    protected $casts = [
        'ID' => 'integer',
        'CreatedAt' => 'datetime',
    ];
}
