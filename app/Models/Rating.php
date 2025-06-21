<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Rating extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'film_id',
        'rating',
        'comment',
    ];

    protected $casts = [
        'rating' => 'decimal:1', // Opsional: memastikan rating dikonversi ke decimal
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function film(): BelongsTo
    {
        return $this->belongsTo(Film::class);
    }
    
    public function genre(): BelongsTo
    {
        return $this->belongsTo(Genre::class);
    }
}
