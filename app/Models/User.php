<?php

namespace App\Models;

// ...existing code...
//use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\CanResetPassword;
use Illuminate\Auth\Passwords\CanResetPassword as CanResetPasswordTrait;
//use Illuminate\Auth\Passwords\CanResetPassword;
use App\Notifications\ResetPasswordNotification;
use App\Enums\UserLevel;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

use Laravel\Sanctum\HasApiTokens;
//use Spatie\Permission\Traits\HasRoles;
use Laravel\Nova\Actions\Actionable;
use Laravel\Nova\Fields\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
//use Laravel\Nova\Fields\BelongsToMany;

use App\Nova\Actions\UserResetPassword;


//use\Insenseanalytics\LaravelNovaPermission\PermissionsBasedAuthTrait;

class User extends Authenticatable
{
    
    use Actionable, HasFactory, Notifiable, HasApiTokens, CanResetPasswordTrait;
    
    
    protected $guarded = [];
    

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>*/
     
    public $fillable = [
        'name','email','password','role','active','known_as', 'dob','gender','guid','domain','avatar'];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
        'guid',
        'domain',
        'device_name',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
        'dob' => 'date',
        //'level' => UserLevel::class,
    ];
// app/Models/User.php
public function hasRole($roleName)
{
    return optional($this->role)->name === $roleName;
}

public function hasAnyRole(array $roles)
{
    return in_array(optional($this->role)->name, $roles);
}

    //public static $snakeAttributes = true;

    //protected $appends = ['created_at','updated_at'];

    //public function getCreatedAtAttribute($value)
    //{
        //return $this->changeDateFormUTCtoLocal($this->attributes['created_at']);
    //}

    //*
    // * This will change date according to timezone. 
    // * @param String path
     
    //public function getUpdatedAtAttribute($value)
    //{
        //return $this->changeDateFormUTCtoLocal($this->attributes['updated_at']);
   // }



    /**
     * The storage format of the model's date columns.
     *
     * @var string
     */
    //protected $dateFormat = 'U';
     
    /**
     * Prepare a date for array / JSON serialization.
     *
     * @param  \DateTimeInterface  $date
     * @return string
     */
    //protected function serializeDate(DateTimeInterface $date)
    //{
        //return $date->format('Y-m-d');
    //}
    
    
//    public function GPTeacher()
//    {
//        return $this->belongsTo(GPTeacher::class);
//
//    }
//
//    public function locations()
//    {
//        return $this->belongsTo(Location::class);
//    }
//    public function location_id()
//    {
//        return $this->belongsTo(Location::class, 'location_id');
//    }
//    public function gp_teacher()
//    {
//        return $this->belongsTo(GPTeacher::class, 'gp_teacher_id');
//    }
   public function Notes()
    {
       return $this->BelongsToMany(Notes::class);
    }
    
    public function role()
    {
        return $this->belongsTo(Role::class);
    }

    //public function getAge() {
        //$format = '%y years, %m months and %d days';
        //return \Carbon\Carbon::parse(auth()->user()->dob)->diff(\Carbon\Carbon::now())->format($format);
    //}

   // public function getAttributeAge()
    //{
        //return $this->dob->format('%y years, %m months and %d days');
        //$this->age->diff($this->attributes['dob'])
       // ->format('%y years, %m months and %d days');
    //}

    
    
    /**
     * Send a password reset notification to the user.
     *
     * @param  string  $token
     * @return void
     */


    public function sendPasswordResetNotification($token)
        {
            $this->notify(new \App\Notifications\MailResetPasswordNotification($token));
        }


 
// Add this in the User model:
public static function getNumberOfAdmins()
{
  // using ->count() is a much quicker database operation than using ->get() and counting in PHP.
  //return User::where('level', UserLevel::Administrator)->count();
}
}


