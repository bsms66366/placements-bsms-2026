<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class AuthStudent extends Authenticatable
{
    use HasFactory,Notifiable;

protected $table = 'auth_students';

    protected $fillable = [
        'student_number',
        'email',
        'password',
    ];

    protected $hidden = [
        'password',
    ];

    /**
     * Link to your main students table
     */
    public function student()
    {
        return $this->hasOne(
            \App\Models\Student::class,
            'student_number',
            'student_number'
        );
    }

    
}
