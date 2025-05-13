<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Forum extends Model
{
    use HasFactory;

    protected $fillable = [
        'film_id',
        'user_id',
        'title',
        'is_active',
    ];

    public function film(){
        return $this->belongsTo(Film::class);
    }

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function forumReplies()
    {
        return $this->hasMany(ForumReply::class, 'forum_id');
    }

    // public function replies(){
    //     return $this->hasMany()
    // }
}
