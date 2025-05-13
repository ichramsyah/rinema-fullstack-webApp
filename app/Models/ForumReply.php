<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ForumReply extends Model
{
    use HasFactory;

    protected $fillable = ['forum_id', 'user_id', 'body'];

    public function forum()
    {
        return $this->belongsTo(Forum::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function parent()
    {
    return $this->belongsTo(ForumReply::class, 'parent_reply_id');
    }

    public function replies()
    {
    return $this->hasMany(ForumReply::class, 'parent_reply_id');
    }
}
