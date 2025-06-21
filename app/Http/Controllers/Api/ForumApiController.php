<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Film;
use App\Models\ForumReply;
use Illuminate\Http\Request;
use App\Http\Resources\ForumReplyResource;
use Illuminate\Support\Facades\Gate;

class ForumApiController extends Controller
{
    /**
     * Menampilkan semua balasan forum untuk sebuah film.
     * Endpoint: GET /api/films/{film}/forum-replies
     */
    public function index(Film $film)
    {
        // Ambil forum yang berelasi dengan film
        $forum = $film->forum()->first();

        if (!$forum) {
            // Jika belum ada forum sama sekali, kembalikan koleksi kosong
            return ForumReplyResource::collection([]);
        }

        // Ambil hanya balasan level atas (yang tidak membalas balasan lain)
        // dan eager load relasi user serta anak-anaknya secara rekursif
        $replies = $forum->forumReplies()
                        ->whereNull('parent_reply_id')
                        ->with(['user', 'children.user', 'children.children']) // Eager load nested replies
                        ->latest()
                        ->get();

        return ForumReplyResource::collection($replies);
    }

    /**
     * Menyimpan balasan baru di forum sebuah film.
     * Endpoint: POST /api/films/{film}/forum-replies
     */
    public function store(Request $request, Film $film)
    {
        $request->validate([
            'body' => 'required|string',
            'parent_reply_id' => 'nullable|exists:forum_replies,id' // Opsional, untuk nested reply
        ]);

        // Jika film belum punya forum, buatkan satu. Jika sudah ada, ambil yang itu.
        $forum = $film->forum()->firstOrCreate([]);

        $reply = $forum->forumReplies()->create([
            'user_id' => auth()->id(),
            'body' => $request->body,
            'parent_reply_id' => $request->parent_reply_id,
        ]);

        // Muat relasi user agar bisa ditampilkan di respons
        $reply->load('user');

        return response()->json([
            'message' => 'Balasan berhasil dikirim.',
            'data' => new ForumReplyResource($reply)
        ], 201);
    }

    /**
     * Memperbarui balasan forum.
     * Endpoint: PATCH /api/forum-replies/{reply}
     */
    public function update(Request $request, ForumReply $reply)
    {
        // Otorisasi: hanya user yang membuat reply yang bisa mengedit
        if (auth()->id() !== $reply->user_id) {
            return response()->json(['message' => 'Tidak diizinkan.'], 403); // 403 Forbidden
        }

        $request->validate(['body' => 'required|string']);

        $reply->update(['body' => $request->body]);

        $reply->load('user');

        return response()->json([
            'message' => 'Balasan berhasil diperbarui.',
            'data' => new ForumReplyResource($reply)
        ]);
    }

    /**
     * Menghapus balasan forum.
     * Endpoint: DELETE /api/forum-replies/{reply}
     */
    public function destroy(ForumReply $reply)
    {
        // Otorisasi: hanya user yang membuat reply yang bisa menghapus
        if (auth()->id() !== $reply->user_id) {
            return response()->json(['message' => 'Tidak diizinkan.'], 403); // 403 Forbidden
        }

        $reply->delete();

        return response()->json(['message' => 'Balasan berhasil dihapus.']);
    }
}