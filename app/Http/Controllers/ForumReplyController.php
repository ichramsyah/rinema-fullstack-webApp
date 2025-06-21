<?php

namespace App\Http\Controllers;

use App\Models\Forum;
use App\Models\ForumReply;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class ForumReplyController extends Controller
{
    public function index(Request $request)
{
    $allReplies = ForumReply::count();

    $search = $request->input('search');
    $sortColumn = $request->input('sortColumn', 'id');
    $sortDirection = $request->input('sortDirection', 'asc');

    $replyQuery = ForumReply::query()->with(['user', 'forum', 'parent.user']);

    if ($search) {
        $replyQuery->whereHas('user', function ($query) use ($search) {
            $query->where('name', 'like', '%' . $search . '%');
        })->orWhereHas('forum', function ($query) use ($search) {
            $query->where('title', 'like', '%' . $search . '%');
        })->orWhere('body', 'like', '%' . $search . '%'); 
    }

    $replyQuery->orderBy($sortColumn, $sortDirection);

    $replies = $replyQuery->paginate(5)->appends([
        'search' => $search,
        'sortColumn' => $sortColumn,
        'sortDirection' => $sortDirection,
    ]);

    return view('admin.forumreply.index', compact('allReplies', 'replies', 'sortColumn', 'sortDirection', 'search'));
}

    public function create(Request $request){
        $pageTitle = 'Replies';

        $forums = Forum::all();
        $users = User::all();

        $parentReplyId = $request->query('parent_reply_id');
        $parentReply = null;

        if ($parentReplyId) {
            $parentReply = ForumReply::find($parentReplyId);
        }

        return view('admin.forumreply.create', compact('pageTitle', 'forums', 'users', 'parentReplyId', 'parentReply'));
    }

    public function store(Request $request){
        $request->validate([
            'forum_id' => 'required|exists:forums,id',
            'user_id' => 'required|exists:users,id',
            'body' => 'required|string',
            'parent_reply_id' => 'nullable|exists:forum_replies,id',
        ]);
    
        // Ambil data dari request
        $forumId = $request->input('forum_id');
        $body = $request->input('body');
        $parentReplyId = $request->input('parent_reply_id');
    
        // Ambil user_id dari pengguna yang sedang login (jika menggunakan autentikasi)
        $userId = Auth::id(); // Atau cara lain untuk mendapatkan user_id
    
        // Buat instance ForumReply dan simpan ke database
        ForumReply::create([
            'forum_id' => $forumId,
            'user_id' => $userId,
            'body' => $body,
            'parent_reply_id' => $parentReplyId,
        ]);
    
        // Redirect atau berikan respons sukses
        return redirect()->route('admin.forumreply.index')->with('success', 'Balasan forum berhasil ditambahkan.');
    }

    public function edit($id)
    {
    $pageTitle = 'Ratings';
    $replies = ForumReply::findOrFail($id);
    $replies = ForumReply::with('Forum')->findOrFail($id);
    $replies = ForumReply::with('user')->findOrFail($id);
    return view('admin.forumreply.edit', compact('replies', 'pageTitle'));
    }
    
    public function update(Request $request, $id){
        $request->validate([
            'forum_id' => 'required|exists:forums,id',
            'user_id' => 'required|exists:users,id',
            'body' => 'required|string',
            'parent_reply_id' => 'nullable|exists:forum_replies,id',
        ]);

        $replies= ForumReply::find($id);
        $replies->user_id = $request->user_id;
        $replies->forum_id= $request->forum_id;
        $replies->body = $request->body;

        $replies->update();

        return redirect()->route('admin.forumreply.index');
    }
    
    public function destroy($id){
        $replies = ForumReply::find($id);
        $replies->delete();

        return redirect()->route('admin.forumreply.index')->with('success', 'Balasan forum berhasil dihapus.');
    }
}
