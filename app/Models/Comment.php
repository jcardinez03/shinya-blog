<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;

    // COMMENT - POST 
    // a comment belongs to a post
    public function post()
    {
        return $this->belongsTo(Post::class);
    }

    // COMMENT - USER
    // a comment belongs to a user
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
