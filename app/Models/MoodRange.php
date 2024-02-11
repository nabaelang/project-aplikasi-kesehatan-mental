<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MoodRange extends Model
{
    use HasFactory;
    protected $fillable = ['min_range', 'max_range', 'mood_status', 'avatar_moods'];
}
