<?php

namespace App\Models;
use App\Nova\Actions\Enrolled;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Jagdeepbanga\NovaDateTime\NovaDateTime as DateTime;
use NovaAttachMany\AttachMany;
//use App\Nova\facilitator;
//use App\Nova\Workshops;
//use Webparking\BelongsToDependency\BelongsToDependency;

class Rooms extends Model
{
    use HasFactory;
    protected $fillable = ['id', 'name', 'InUse'];

    protected $dates = [
        'created_at' => 'datetime:Y-m-d H:i:s',
        'updated_at' => 'datetime:Y-m-d H:i:s',
        'JoinDate' => 'datetime:Y-m-d H:i:s',
        //'created_at' => 'datetime:yyyy-mm-dd hh:mm:ss',
        //'updated_at' => 'datetime:yyyy-mm-dd hh:mm:ss',
        //'JoiningDate' => 'datetime:yyyy-mm-dd hh:mm:ss',
    ];


//Casts of the model dates
  protected $casts = [
    'JoiningDate' => 'datetime:Y-m-d H:i:s',
    //'LeavingDate' => 'datetime',
];

     public function Facilitator()
    {

        return $this->belongsTo(Facilitator::class);
        return $this->belongsTo(Workshops::class);
    } 

      //public function Workshops()
    //{

        //return $this->belongsTo(Workshops::class);
    } 
