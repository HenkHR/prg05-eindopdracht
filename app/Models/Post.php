<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{

    protected $fillable = [
        'user_id',
        'content',
        'image_path',
        'is_visible'
    ];

    public function user()
    {
        return $this->belongsTo(User::Class);
    }
}
