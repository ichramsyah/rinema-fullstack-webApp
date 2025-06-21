<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ForumReplyResource extends JsonResource
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
            'body' => $this->body,
            'created_at' => $this->created_at->diffForHumans(),
            'parent_id' => $this->parent_reply_id,

            // Sertakan data user jika sudah di-load
            'user' => new UserResource($this->whenLoaded('user')),

            // Sertakan balasan anak-anaknya secara rekursif
            // Ini akan membuat struktur nested JSON
            'children' => ForumReplyResource::collection($this->whenLoaded('children')),
        ];
    }
}