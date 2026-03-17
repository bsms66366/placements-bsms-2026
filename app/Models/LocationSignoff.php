<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LocationSignoff extends Model
{
    use HasFactory;

    protected $table = 'location_signoffs';

    public $timestamps = false;

    protected $fillable = [
        'location_barcode',
        'bsms_id',
        'reg_number_of_approver',
        'signoff_name',
        'signature_svg',
        'created_at',
        'location_id',
        'location_postcode',
    ];

    protected $casts = [
        'created_at' => 'datetime',
        'location_id' => 'integer',
    ];

    public function location()
    {
        return $this->belongsTo(Location2025::class, 'location_id');
    }
}
