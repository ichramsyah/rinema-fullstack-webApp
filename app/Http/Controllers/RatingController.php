<?php

namespace App\Http\Controllers;

use App\Models\Film;
use App\Models\Rating;
use App\Models\User;
use Illuminate\Http\Request;

class RatingController extends Controller
{
    function index(Request $request){
        $pageTitle = 'Ratings';
        $allRatings = Rating::count();
        $film = Film::all();
        $ratings = Rating::with(['user', 'film'])->get();

        $averageRatings = Rating::groupBy('film_id')
        ->selectRaw('film_id, avg(rating) as average_rating')
        ->pluck('average_rating', 'film_id');

        $search = $request->input('search');

        $sortColumn = $request->input('sortColumn', 'id'); 
        $sortDirection = $request->input('sortDirection', 'asc');    

        $ratingQuery = Rating::query()->with(['user', 'film']);

        if($search){
            $ratingQuery->where(function ($query) use ($search) {
              
                if(is_numeric($search)){
                    $query->where('user_id', $search)
                        ->orWhere('film_id', $search)
                        ->orWhere('rating', $search);
                }

                $query->orWhereHas('user', function ($userQuery) use ($search) {
                    $userQuery->where('name', 'like', '%' . $search . '%');
                })->orWhereHas('film', function($filmQuery) use ($search) {
                    $filmQuery->where('judul', 'like', '%' . $search . '%');
                });

                if(strtotime($search)){
                    $date = date('Y-m-d', strtotime($search));
                    $query->orWhereDate('created_at', $date)
                        ->orWhereDate('updated_at', $date);
                }
        });

        }

        $ratingQuery->orderBy($sortColumn, $sortDirection);

        $ratings = $ratingQuery->paginate(5);

        return view('admin.ratings.index', compact('ratings', 'pageTitle', 'allRatings', 'film', 'averageRatings', 'sortColumn', 'sortDirection'));
    }

    function create(){  
        $pageTitle = 'Ratings';
        $users = User::all();
        $films = Film::all();
        return view('admin.ratings.create', compact('users', 'films', 'pageTitle'));
    }

    public function store(Request $request)
    {
    $request->validate([
        'user_id' => 'required|exists:users,id',
        'film_id' => 'required|exists:films,id',
        'rating' => 'required|numeric|min:0|max:10',
        'comment' => 'nullable|string',
    ]);

    // Cek apakah rating sudah ada
    $existingRating = Rating::where('user_id', $request->user_id)
        ->where('film_id', $request->film_id)
        ->first();

    if ($existingRating) {
        return redirect()->back()->withInput()->with('error', 'Pengguna sudah memberikan rating untuk film ini.');
    }

    Rating::create([
        'user_id' => $request->user_id,
        'film_id' => $request->film_id,
        'rating' => $request->rating,
        'comment' => $request->comment,
    ]);
    

    return redirect()->route('admin.ratings.index')->with('success', 'Rating berhasil ditambahkan.');
    }


    public function edit($id)
    {
    $pageTitle = 'Ratings';
    $rating = Rating::findOrFail($id);
    $rating = Rating::with('user')->findOrFail($id);
    $rating = Rating::with('film')->findOrFail($id);
    return view('admin.ratings.edit', compact('rating', 'pageTitle'));
    }

    public function update(Request $request, $id){

        $request->validate([
            'user_id' => 'required|exists:users,id',
            'film_id' => 'required|exists:films,id',
            'rating' => 'required|numeric|min:0|max:10',
            'comment' => 'nullable|string',
        ]);

        $rating = Rating::find($id);
        $rating->user_id = $request->user_id;
        $rating->film_id= $request->film_id;
        $rating->rating = $request->rating;
        $rating->comment= $request->comment;

        $rating->update();

        return redirect()->route('admin.ratings.index');
    }

    function destroy($id){
        $rating = Rating::find($id);
        $rating->delete();

        return redirect()->route('admin.ratings.index')->with('success', 'Rating berhasil dihapus.');
    }

    
}
