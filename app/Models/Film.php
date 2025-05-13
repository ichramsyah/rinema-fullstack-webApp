<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Film extends Model
{
    use HasFactory;

    protected $fillable = [
        'judul',
        'produser',
        'sutradara',
        'penulis',
        'produksi',
        'pemeran',
        'tahun_rilis',
        'durasi',
        'usia',
        'poster',
        'trailer',
        'sinopsis',
    ];

    
}
