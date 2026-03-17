<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NoteView extends Model
{
    use HasFactory;
        
    protected $fillable = ['note_id', 'user_id', 'last_viewed_at'];

    protected $appends = ['views_count'];

    public function getViewsCountAttribute()
      {
          return self::where('note_id', $this->note_id)->count();
      }


    public function note()
        {
            return $this->belongsTo(Note::class);
        }

    public function user()
        {
            return $this->belongsTo(User::class);
        }
}
