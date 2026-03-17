<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
//use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model;
use Laravel\Sanctum\HasApiTokens;
use App\Models\Sanctum\PersonalAccessToken;
use Laravel\Sanctum\Sanctum;
use LdapRecord\Laravel\Auth\LdapAuthenticatable;
use LdapRecord\Laravel\Auth\AuthenticatesWithLdap;
use Illuminate\Http\Request;

use Laravel\Nova\Fields\DateTime;
use Laravel\Nova\Fields\Time;

class Anatomy extends Model implements LdapAuthenticatable

{
    //use HasFactory;
    use HasApiTokens, HasFactory, AuthenticatesWithLdap;

    protected $fillable = ['id','name','bsms_id','student_number','firstname','known_as','dob','age','email','rotation_group','year','gp_teacher','locations'];

    protected $table = 'dissections';
    //protected $table = 'notes';
    
    protected $hidden = [

        'password', 'remember_token',
    ];
    
     // Casts of the model dates & other data types
    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
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

    public function catergory()
    {
        return $this->belongsTo(Catergory::class);

    }

    public function notes()
    {
        return $this->belongsTo(Notes::class);
    }
    public function catergory_id1()
    {
        return $this->belongsTo(Notes::class, 'category_id');
    }
    public function catergory_id2()
    {
        return $this->belongsTo(Dissection::class, 'category_id');
    }
    /* public function getAge() {
        $format = '%y years, %m months and %d days';
        return \Carbon\Carbon::parse(auth()->user()->dob)->diff(\Carbon\Carbon::now())->format($format);
    } */

   // public function getAttributeAge()
    //{
        //return $this->dob->format('%y years, %m months and %d days');
        //$this->age->diff($this->attributes['dob'])
       // ->format('%y years, %m months and %d days');
    //}

    public function dissections()
{
    return $this->HasMany(Dissection::class);

}
}

/* class User extends Authenticatable implements LdapAuthenticatable
{
    use AuthenticatesWithLdap;

} */
