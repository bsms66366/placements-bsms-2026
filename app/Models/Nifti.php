<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Nifti extends Model
{
    use HasFactory;
    /**
         * The table associated with the model.
         *
         * @var string
         */
        protected $table = 'nifti';
    
    /**
        * The attributes that are mass assignable.
        *
        * @var array
        */
       protected $fillable = [
            'directory_name',
           'file_name',
           'file_path',
           'upload_date',
           'file_size',
           'file_format',
           'modality',
           'patient_id',
           'study_id',
           'series_id',
           'description',
           'orientation',
           'voxel_dimensions',
           'dimensions',
            'urlCode',
           'created_by',
            'created_at',
            'updated_at',
           'tags',
       ];
    
    
    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'upload_date' => 'datetime',
        'tags' => 'array',
    ];

    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = true;
    
}
