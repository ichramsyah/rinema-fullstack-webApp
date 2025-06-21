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

    // --- TAMBAHKAN DUA METODE DI BAWAH INI ---

    /**
     * Mendefinisikan relasi ke "anak-anak" atau balasan dari balasan ini.
     * Satu balasan bisa memiliki BANYAK balasan (anak).
     */
    public function children()
    {
        // Model ini memiliki banyak 'ForumReply' (anak), yang dicocokkan melalui
        // foreign key 'parent_reply_id' dengan local key 'id' dari model ini (induk).
        return $this->hasMany(ForumReply::class, 'parent_reply_id', 'id');
    }

    /**
     * Mendefinisikan relasi ke "induk" atau balasan yang dibalas oleh balasan ini.
     * Satu balasan dimiliki oleh SATU balasan (induk).
     */

}
