<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AvatarMood extends Model
{
    use HasFactory;

    protected $fillable = ['image', 'gender'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
