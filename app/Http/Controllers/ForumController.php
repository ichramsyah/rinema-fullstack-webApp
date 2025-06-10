<?php

namespace App\Http\Controllers;




use App\Models\Film;
use App\Models\Forum;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class ForumController extends Controller
{
    public function index(){
        $pageTitle = 'Forums';
        $allForums = Forum::count();
        $forums = Forum::with(['film', 'user'])->latest()->paginate(5);

        return view('admin.forums.index', compact('forums', 'allForums', 'pageTitle'));

    }

    public function create(){
        $pageTitle = 'Forums';
        $films = Film::all();
        $users = User::all();

        return view('admin.forums.create', compact('pageTitle', 'users', 'films'));
    }
    

    public function store(Request $request){
        $request->validate([
            'film_id' => [
                'required',
                'exists:films,id',
                Rule::unique('forums', 'film_id'), // Validasi unique untuk film_id di tabel forums
            ],
            'title' => 'required|string|max:255',
        ], [
            'film_id.unique' => 'Forum untuk film ini sudah ada.', // Pesan error custom
        ]);
        
        $forum = new Forum();
        $forum->film_id = $request->film_id;
        $forum->user_id = Auth::id();
        $forum->title = $request->title;
        $forum->save();

        return redirect()->route('admin.forums.index')->with('success', 'Forum berhasil dibuat.');
    }

    public function edit($id){
        $pageTitle = 'Forums';
        $forum = Forum::findOrFail($id);
        $forum = Forum::with('user')->findOrFail($id);
        $forum = Forum::with('film')->findOrFail($id);
        return view('admin.forums.edit', compact('forum', 'pageTitle'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'film_id' => [
                'required',
                'exists:films,id',
                Rule::unique('forums', 'film_id')->ignore($id), // Ignore forum saat ini saat update
            ],
            'title' => 'required|string|max:255',
        ], [
            'film_id.unique' => 'Forum untuk film ini sudah ada.', // Pesan error custom
        ]);

        $forum = Forum::findOrFail($id);

        $forum->film_id = $request->film_id;
        $forum->title = $request->title;
        $forum->is_active = $request->has('is_active');
        $forum->save();

        return redirect()->route('admin.forums.index')->with('success', 'Forum berhasil diupdate.');
    }

    public function destroy($id){
        $forum = Forum::find($id);
        $forum->delete();
        return redirect()->route('admin.forums.index');
    }
}


