<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class FilmResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
{
    return [
        'id' => $this->id,
        'judul' => $this->judul,
        'produser' => $this->produser,
        'sutradara' => $this->sutradara,
        'penulis' => $this->penulis,
        'produksi' => $this->produksi,
        'pemeran' => $this->pemeran,
        'tahun_rilis' => $this->tahun_rilis ? $this->created_at->format('Y-m-d') : null,
        'durasi' => $this->durasi,
        'usia' => $this->usia,
        'poster_url' => $this->poster,
        'trailer_url' => $this->trailer,
        'sinopsis' => $this->sinopsis,
        'created_at' => $this->created_at ? $this->created_at->format('Y-m-d H:i:s') : null,
        'updated_at' => $this->updated_at ? $this->updated_at->format('Y-m-d H:i:s') : null,

        'genres' => GenreResource::collection($this->whenLoaded('genres')),

        'average_rating' => round((float) $this->ratings_avg_rating ?? 0, 1),
        'ratings_count' => (int) $this->ratings_count ?? 0,

    ];
}
}
