<?php

namespace App\Http\Controllers;

use App\Models\Film;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Stringable;

class FilmController extends Controller
{
    public function index(Request $request)
    {
        $pageTitle = 'Films';
        $allFilm = Film::count();

        $search = $request->input('search');

        $sortColumn = $request->input('sortColumn', 'id');
        $sortDirection = $request->input('sortDirection', 'asc');

        $filmQuery = Film::query();

        if ($search) {
            $filmQuery->where(function ($query) use ($search) {
                $query->where('judul', 'like', '%' . $search . '%')
                    ->orWhere('produser', 'like', '%' . $search . '%')
                    ->orWhere('sutradara', 'like', '%' . $search . '%')
                    ->orWhere('penulis', 'like', '%' . $search . '%')
                    ->orWhere('pemeran', 'like', '%' . $search . '%');
            });
        }

        $filmQuery->orderBy($sortColumn, $sortDirection);

        $film = $filmQuery->paginate(5);

        $queryParams = $request->query();

        return view('admin.films.tampil', compact('pageTitle', 'allFilm', 'film', 'queryParams', 'sortDirection', 'sortColumn'));
    }

    function tambah(){
        $pageTitle = 'Films';
        return view('admin.films.tambah', compact('pageTitle'));
    }

    function submit(Request $request){
        
        $request->validate([
            'judul' => 'required',
            'produser' => 'nullable',
            'sutradara' => 'nullable',
            'penulis' => 'nullable',
            'produksi' => 'nullable',
            'pemeran' => 'nullable',
            'tahun_rilis' => 'nullable|date_format:Y-m-d',
            'durasi' => 'nullable|integer|min:0',
            'usia' => 'nullable',
            'poster' => 'nullable|url', 
            'trailer' => 'nullable|url', 
            'sinopsis' => 'nullable|string',
        ]);


        $film = new Film();
        $film->judul= $request->judul;
        $film->produser= $request->produser;
        $film->sutradara= $request->sutradara;
        $film->penulis= $request->penulis;
        $film->produksi= $request->produksi;
        $film->pemeran= $request->pemeran;
        $film->tahun_rilis= $request->tahun_rilis;
        $film->durasi= $request->durasi;
        $film->usia= $request->usia;
        $film->poster= $request->poster;
        $film->trailer= $request->trailer;
        $film->sinopsis= $request->sinopsis;

        $film-> save();

        return redirect()->route('admin.films.tampil');
    }

    function edit($id){
        $film = Film::find($id);
        $pageTitle = 'Films';
        return view ('admin.films.edit', compact('film', 'pageTitle'));
    }

    function update(Request $request, $id){
        $film = Film::find($id);
        $film->judul= $request->judul;
        $film->produser= $request->produser;
        $film->sutradara= $request->sutradara;
        $film->penulis= $request->penulis;
        $film->produksi= $request->produksi;
        $film->pemeran= $request->pemeran;
        $film->tahun_rilis= $request->tahun_rilis;
        $film->durasi= $request->durasi;
        $film->usia= $request->usia;
        $film->poster= $request->poster;
        $film->trailer= $request->trailer;
        $film->sinopsis= $request->sinopsis;
       
        $film-> update();

        return redirect()->route('admin.films.tampil');
    }

    function hapus($id){
        $film = Film::find($id);
        $film -> delete();
        return redirect()->route('admin.films.tampil');
    }

}
