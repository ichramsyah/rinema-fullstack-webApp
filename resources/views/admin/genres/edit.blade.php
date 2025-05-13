@extends('admin.dashboard')

@section('genreedit')

    <div class="container mx-auto ">
        
        <a href="{{route('admin.genres.tampil')}}" class="px-2 py-1 rounded-sm text-red-500 font-bold"><i class="fas fa-arrow-left"></i> <u>Back</u></a>
        
        <h4 class="text-2xl px-7 pt-4 font-semibold">Genre Edit</h4>
   

        <form action=" {{route('admin.genres.update', $genre->id)}} " method="post" class="px-8 pt-4 pb-8 mb-4">
            @csrf <div class="mb-4">
                <label for="nama" class="block text-gray-700 text-sm font-bold mb-2">Nama</label>
                <input type="text" name="nama" id="nama" value="{{ $genre->nama }}"
                       class="appearance-none mt-2 font-bold border-t-transparent border-l-transparent border-r-transparent border-2 border-red-500 focus:border-t-transparent focus:border-l-transparent focus:border-r-transparent focus:border-2 focus:border-red-500 bg-transparent  w-full py-1 px-3 text-gray-700 leading-tight focus:ring-transparent focus:shadow-outline">
            </div>

            <div class="flex items-center justify-between">
                <button
                    class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-6 mt-2 cursor-pointer rounded focus:outline-none focus:shadow-outline"
                    type="submit">
                    Edit
                </button>
            </div>
        </form>
    </div>

@endsection