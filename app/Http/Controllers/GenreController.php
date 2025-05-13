<?php

namespace App\Http\Controllers;

use App\Models\Genre;
use Illuminate\Http\Request;

class GenreController extends Controller
{
    function tampil(){
        $genre = Genre::all();
        $allGenres = Genre::count();
        $pageTitle = 'Genres';
        return view('admin.genres.tampil', compact('pageTitle', 'allGenres', 'genre'));  
    }

    function tambah(){
        return view('admin.genres.tambah');
    }

    function submit(Request $request){
        $genre = new Genre();
        $genre->nama= $request->nama;

        $genre->save();
        return redirect()->route('admin.genres.tampil');
    }

    function edit($id){
        $genre = Genre::find($id);
        $pageTitle = 'Genres';

        return view('admin.genres.edit', compact('genre', 'pageTitle'));
    }

    function update(Request $request, $id){
        $genre = Genre::find($id);
        $genre->nama = $request->nama;

        $genre->update();

        return redirect()->route('admin.genres.tampil');
    }

    function hapus($id){
        $genre = Genre::find($id);
        $genre -> delete();

        return redirect()->route('admin.genres.tampil');
    }

}   
