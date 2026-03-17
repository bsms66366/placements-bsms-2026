<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model;
use Laravel\Sanctum\HasApiTokens;
use App\Models\Sanctum\PersonalAccessToken;
use Laravel\Sanctum\Sanctum;

//use LdapRecord\Laravel\Auth\LdapAuthenticatable;
use LdapRecord\Laravel\Auth\AuthenticatesWithLdap;

use Illuminate\Http\Request;

//class Student extends Authenticatable implements LdapAuthenticatable
class Student extends Model
{
    //use HasFactory;
    use HasApiTokens, HasFactory, Notifiable, AuthenticatesWithLdap;

    protected $fillable = ['id','name','bsms_id','student_number','firstname','known_as','dob','age','email','rotation_group','seminar_group','cpw','cps','cpw_cps','simulated_home_visit_group','year','gender','car_owner','gp_teacher','gp_teacher_id','facilitator_id','group_id','locations_id','location2025_id','notes','guid','domain'];


    protected $hidden = [

        'password', 'remember_token','guid','domain', 'device_name',
    ];
    
     // Casts of the model dates & other data types
    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
        'dob' => 'datetime',
    ];

/* /**
 * Bootstrap any application services.
 *
 * @return void
 */
/*public function boot()
{
    Sanctum::usePersonalAccessTokenModel(PersonalAccessToken::class);
}
 */

    public function locations()
    {
        return $this->belongsTo(Location::class, 'locations_id');
    }
    
    public function gp_teacher()
    {
        return $this->belongsTo(GPTeacher::class, 'gp_teacher_id');
    }

    public function location2025()
    {
        return $this->belongsTo(Location2025::class, 'location2025_id');
    }

    public function facilitator()
    {
        return $this->belongsTo(Facilitator::class, 'facilitator_id');
    }

    public function group()
    {
        return $this->belongsTo(Group::class, 'group_id');
    }

    public function getAge() {
        $format = '%y years, %m months and %d days';
        return \Carbon\Carbon::parse(auth()->user()->dob)->diff(\Carbon\Carbon::now())->format($format);
    }

   // public function getAttributeAge()
    //{
        //return $this->dob->format('%y years, %m months and %d days');
        //$this->age->diff($this->attributes['dob'])
       // ->format('%y years, %m months and %d days');
    //}

    public function sessionAttendance()
    {
        return $this->hasMany(SessionAttendance2026::class, 'bsms_id', 'bsms_id');
    }

    public function examinationResults()
    {
        return $this->hasMany(ExaminationResult::class, 'bsms_id', 'bsms_id');
    }

    public function locationSignoffs()
    {
        return $this->hasMany(LocationSignoff::class, 'bsms_id', 'bsms_id');
    }
}

