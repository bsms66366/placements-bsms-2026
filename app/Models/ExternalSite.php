<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ExternalSite extends Model
{
    use HasFactory;

    protected $table = 'external_Sites';

    protected $primaryKey = 'ID';

    public $timestamps = false;

    protected $fillable = [
        'LocationCategory',
        'LocationName',
        'TaxiRequired',
        'LocationFullAddress',
        'LocationPostcode',
        'ContactPerson',
        'ContactNumber',
        'ContactEmail',
        'TravelSuggestion',
        'LocationLatitude',
        'LocationLongitude',
        'Year1',
        'Year2',
        'created_at',
        'Modified',
        'updated_by',
    ];

    protected $casts = [
        'ID' => 'integer',
        'LocationLongitude' => 'decimal:9',
    ];
}
