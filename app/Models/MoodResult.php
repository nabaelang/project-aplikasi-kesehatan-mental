<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MoodResult extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'user_mood', 'mood_status', 'avatar_moods'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
