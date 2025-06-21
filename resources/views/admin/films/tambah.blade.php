@extends('admin.dashboard')

@section('filmtambah')

<div class="container mx-auto">
        
        <a href="{{route('admin.films.tampil')}}" class="px-4 py-1 rounded-sm text-red-500 font-bold"><i class="fas fa-arrow-left"></i> <u>Back</u></a>

        <h4 class="text-2xl px-8 pt-4 font-semibold">Add Film</h4>

        <form action="{{ route('admin.films.submit') }}" enctype="multipart/form-data" method="post" class="px-8 pt-6 pb-8 mb-4">
            @csrf
            <div class="mb-5">
                <label for="judul" class="block text-gray-700 text-sm font-bold ">Judul</label>
                <input type="text" name="judul" id="judul"
                    class="appearance-none mt-2 font-bold border-t-transparent border-l-transparent border-r-transparent border-2 border-red-500 focus:border-t-transparent focus:border-l-transparent focus:border-r-transparent focus:border-2 focus:border-red-500 bg-transparent  w-full py-1 px-3 text-gray-700 leading-tight focus:ring-transparent focus:shadow-outline">
            </div>
            <div class="mb-5">
                <label for="produser" class="block text-gray-700 text-sm font-bold ">Produser</label>
                <input type="text" name="produser" id="produser"
                    class="appearance-none mt-2 font-bold border-t-transparent border-l-transparent border-r-transparent border-2 border-red-500 focus:border-t-transparent focus:border-l-transparent focus:border-r-transparent focus:border-2 focus:border-red-500 bg-transparent  w-full py-1 px-3 text-gray-700 leading-tight focus:ring-transparent focus:shadow-outline">
            </div>
            <div class="mb-5">
                <label for="sutradara" class="block text-gray-700 text-sm font-bold ">Sutradara</label>
                <input type="text" name="sutradara" id="sutradara"
                    class="appearance-none mt-2 font-bold border-t-transparent border-l-transparent border-r-transparent border-2 border-red-500 focus:border-t-transparent focus:border-l-transparent focus:border-r-transparent focus:border-2 focus:border-red-500 bg-transparent  w-full py-1 px-3 text-gray-700 leading-tight focus:ring-transparent focus:shadow-outline">
            </div>
            <div class="mb-5">
                <label for="penulis" class="block text-gray-700 text-sm font-bold ">Penulis</label>
                <input type="text" name="penulis" id="penulis"
                    class="appearance-none mt-2 font-bold border-t-transparent border-l-transparent border-r-transparent border-2 border-red-500 focus:border-t-transparent focus:border-l-transparent focus:border-r-transparent focus:border-2 focus:border-red-500 bg-transparent  w-full py-1 px-3 text-gray-700 leading-tight focus:ring-transparent focus:shadow-outline">
            </div>
            <div class="mb-5">
                <label for="produksi" class="block text-gray-700 text-sm font-bold ">Produksi</label>
                <input type="text" name="produksi" id="produksi"
                    class="appearance-none mt-2 font-bold border-t-transparent border-l-transparent border-r-transparent border-2 border-red-500 focus:border-t-transparent focus:border-l-transparent focus:border-r-transparent focus:border-2 focus:border-red-500 bg-transparent  w-full py-1 px-3 text-gray-700 leading-tight focus:ring-transparent focus:shadow-outline">
            </div>
            <div class="mb-5">
                <label for="pemeran" class="block text-gray-700 text-sm font-bold ">Pemeran</label>
                <input type="text" name="pemeran" id="pemeran"
                    class="appearance-none mt-2 font-bold border-t-transparent border-l-transparent border-r-transparent border-2 border-red-500 focus:border-t-transparent focus:border-l-transparent focus:border-r-transparent focus:border-2 focus:border-red-500 bg-transparent  w-full py-1 px-3 text-gray-700 leading-tight focus:ring-transparent focus:shadow-outline">
            </div>
            <div class="mb-5">
                <label for="tahun_rilis" class="block text-gray-700 text-sm font-bold">Tahun Rilis</label>
                <input type="date" name="tahun_rilis" id="tahun_rilis"
                    class="appearance-none mt-2 font-bold border-t-transparent border-l-transparent border-r-transparent border-2 border-red-500 focus:border-t-transparent focus:border-l-transparent focus:border-r-transparent focus:border-2 focus:border-red-500 bg-transparent  w-full py-1 px-3 text-gray-700 leading-tight focus:ring-transparent focus:shadow-outline" min="2000-01-01">
            </div>
            <div class="mb-5">
                <label for="durasi" class="block text-gray-700 text-sm font-bold">Durasi (Menit)</label>
                <input type="number" name="durasi" id="durasi"
                    class="appearance-none mt-2 font-bold border-t-transparent border-l-transparent border-r-transparent border-2 border-red-500 focus:border-t-transparent focus:border-l-transparent focus:border-r-transparent focus:border-2 focus:border-red-500 bg-transparent  w-full py-1 px-3 text-gray-700 leading-tight focus:ring-transparent focus:shadow-outline"
                    min="0">
            </div>
            <div class="mb-5">
                <label for="usia" class="block text-gray-700 text-sm font-bold ">Usia</label>
                <input type="text" name="usia" id="usia"
                    class="appearance-none mt-2 font-bold border-t-transparent border-l-transparent border-r-transparent border-2 border-red-500 focus:border-t-transparent focus:border-l-transparent focus:border-r-transparent focus:border-2 focus:border-red-500 bg-transparent  w-full py-1 px-3 text-gray-700 leading-tight focus:ring-transparent focus:shadow-outline">
            </div>
            <div class="mb-5">
                <label for="poster" class="block text-gray-700 text-sm font-bold">Tautan Poster Film</label>
                <input type="text" name="poster" id="poster"
                    class="appearance-none mt-2 font-bold border-t-transparent border-l-transparent border-r-transparent border-2 border-red-500 focus:border-t-transparent focus:border-l-transparent focus:border-r-transparent focus:border-2 focus:border-red-500 bg-transparent  w-full py-1 px-3 text-gray-700 leading-tight focus:ring-transparent focus:shadow-outline"
                    placeholder="Masukkan tautan gambar poster">
            </div>
            <div class="mb-5">
                <label for="trailer" class="block text-gray-700 text-sm font-bold">Tautan Trailer Film</label>
                <input type="text" name="trailer" id="trailer"
                    class="appearance-none mt-2 font-bold border-t-transparent border-l-transparent border-r-transparent border-2 border-red-500 focus:border-t-transparent focus:border-l-transparent focus:border-r-transparent focus:border-2 focus:border-red-500 bg-transparent  w-full py-1 px-3 text-gray-700 leading-tight focus:ring-transparent focus:shadow-outline"
                    placeholder="Masukkan tautan gambar trailer">
            </div>
            <div class="mb-5">
                <label for="sinopsis" class="block text-gray-700 text-sm font-bold ">Sinopsis</label>
                <textarea name="sinopsis" id="sinopsis"
                    class="appearance-none mt-2 font-bold border-t-transparent border-l-transparent border-r-transparent border-2 border-red-500 focus:border-t-transparent focus:border-l-transparent focus:border-r-transparent focus:border-2 focus:border-red-500 bg-transparent  w-full py-1 px-3 text-gray-700 leading-tight focus:ring-transparent focus:shadow-outline"></textarea>
            </div>
          


            <div class="flex items-center justify-between">
                <button
                    class="bg-red-500 mt-3 hover:bg-red-600 transition-all text-white font-bold px-5 py-2 rounded-sm  focus:outline-n border-red-500one focus:shadow-outline"
                    type="submit">
                    Tambah
                </button>
            </div>
        </form>
    </div>

@endsection