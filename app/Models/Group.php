<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Group extends Model
{
    use HasFactory;
    protected $fillable = ['id', 'group'];

    public function Student()
    {

        return $this->belongsTo(Student::class);
    }
}
