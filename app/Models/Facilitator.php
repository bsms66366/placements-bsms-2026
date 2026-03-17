<?php

namespace App\Models;

//use App\Nova\Actions\Enrolled;
use App\Nova\Actions\ActivateUser;

//use Jagdeepbanga\NovaDateTime\NovaDateTime as DateTime;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Nova\Fields\DateTime;
use Laravel\Nova\Fields\Date;

class Facilitator extends Model
{
    use HasFactory;
    protected $fillable = ['id', 'bsms_id','name', 'address', 'email', 'designation','qualification','firstname', 'surname', 'known_as', 'status', 'joining_date','teaching_subject', 'active'];

 /*  protected $dates = [
        'created_at' => 'datetime:Y-m-d H:i:s',
        'updated_at' => 'datetime:Y-m-d H:i:s',
        'JoinDate' => 'datetime:Y-m-d H:i:s',
        //'created_at' => 'datetime:yyyy-mm-dd hh:mm:ss',
        //'updated_at' => 'datetime:yyyy-mm-dd hh:mm:ss',
        //'JoiningDate' => 'datetime:yyyy-mm-dd hh:mm:ss',
    ];
 */

//Casts of the model dates
  /* protected $casts = [
    'JoiningDate' => 'datetime:Y-m-d H:i:s',
    //'LeavingDate' => 'datetime',
]; */

    public function Rooms()
    {

        return $this->belongsTo(Rooms::class);
    }

    
  /*      public function Status()
    {

        return $this->belongsTo(Status::class);
    }   
    
 */
    public function Facilitator()
    {

        return $this->belongsTo(Facilitator::class);
    }  
}

