<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CheckIn extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'weight',
        'sleep_quality',
        'training_quality',
        'soreness',
        'food_quality',
        'comment',
        'image_path',
        'coach_comment'

    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}