<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GPTeacher extends Model
{
    use HasFactory;
    protected $fillable = ['id','bsms_id','name','active', 'address', 'nhs_id', 'email', 'designation','qualification','firstname', 'surname', 'known_as', 'status', 'joining_date', 'leaving_date','teaching_subject'];

    protected $table = 'gp_teachers';

    protected $dates = [
        //'created_at' => 'datetime:Y-m-d H:i:s',
        //'updated_at' => 'datetime:Y-m-d H:i:s',
        //'JoinDate' => 'datetime:Y-m-d H:i:s',
        //'created_at' => 'datetime:yyyy-mm-dd hh:mm:ss',
        //'updated_at' => 'datetime:yyyy-mm-dd hh:mm:ss',
        //'JoiningDate' => 'datetime:yyyy-mm-dd hh:mm:ss',
    ];


//Casts of the model dates
  protected $casts = [
    //'JoiningDate' => 'datetime:Y-m-d H:i:s',
    //'LeavingDate' => 'datetime',
];
    public function Rooms()
    {

        return $this->belongsTo(Rooms::class);
    }
    public function Locations()
    {

        return $this->belongsTo(Locations::class);
    }
    public function Student()
    {

        return $this->belongsTo(Student::class);
    }
    public function GPTeacher()
    {

        return $this->belongsTo(GPTeacher::class);
    }
 } 
