<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Location2025 extends Model
{
    use HasFactory;

    protected $table = 'locations2025';

    protected $fillable = [
        'name',
        'gp_address',
        'gp_town',
        'gp_postcode',
        'gp_telno',
        'gp_travel',
        'barcode_no',
    ];

    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    public function signoffs()
    {
        return $this->hasMany(LocationSignoff::class, 'location_id');
    }
}
