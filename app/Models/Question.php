<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    protected $fillable = ['question', 'survey_date', 'answer_options'];

    protected $casts = [
        'answer_options' => 'array',
    ];

    public function moods()
    {
        return $this->hasMany(Mood::class, 'survey_date', 'survey_date');
    }
}
