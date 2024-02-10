<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MoodConfiguration extends Model
{
    use HasFactory;

    protected $fillable = ['question_id', 'selected_option', 'mood', 'percentage'];

    public function question()
    {
        return $this->belongsTo(Question::class);
    }

    public static function getMood($questionId, $selectedOption)
    {
        return static::where('question_id', $questionId)
            ->where('selected_option', $selectedOption)
            ->value('mood');
    }
}
