<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Location extends Model
{
    use HasFactory;
    protected $fillable = ['id','name','gp_address','gp_town','gp_postcode','gp_tel_no','gp_travel'];
    
protected $table = 'locations';


    public function students()
    {

        return $this->hasMany(Student::class);
    }

}
