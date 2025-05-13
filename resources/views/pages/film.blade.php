@extends('index') 

@section('film') 
    
<section class="pt-10">
    <div class="film">
        <div class="font-caros pb-6">
            <h1 class="text-gray-200 text-4xl">Film</h1>
        </div>
    </div>
    <div class="md:flex justify-between items-center">
        <ul class="flex flex-wrap w-full gap-0 space-y-4 md:gap-1 font-caros">
            <li class="mt-4">
                <a href="{{ route('film') }}" class="px-4 py-2 hover:text-gray-200 transition-all {{ request('genre') == null ? 'bg-black border border-gray-500 rounded-lg text-gray-200 hover:text-white' : 'text-gray-400' }}">Semua</a>
            </li>
            @foreach(\App\Models\Genre::all() as $genre)
                <li>
                    <a href="{{ route('film', ['genre' => $genre->nama]) }}" class="px-4 py-2 hover:text-gray-200 transition-all {{ request('genre') == $genre->nama ? 'bg-black border border-gray-500 rounded-lg text-gray-200 hover:text-white' : 'text-gray-400' }}">{{ $genre->nama }}</a>
                </li>
            @endforeach
        </ul>

        <div class="md:w-1/3 flex md:justify-end items-center gap-3">
            <!-- Form Pencarian -->
            <form action="{{ route('film') }}" method="get" class="relative w-full md:w-auto md:pt-0 pt-6">
                <button type="submit" 
                        class="absolute left-3 top-1/2 transform md:-translate-y-1/2 text-gray-500 hover:text-red-500">
                    <i class="fas fa-search text-gray-500 transition-all hover:text-blue-700"></i>
                </button>
                <input type="text" autocomplete="off" value="{{ request('search') }}" placeholder="Cari judul film"
                    class="w-full md:w-72 px-9 py-2 text-gray-200 bg-transparent border border-gray-600 md:rounded-md rounded-sm focus:none focus:outline-none" 
                    name="search">
            </form>

            <!-- Dropdown Sort -->
            <div class="relative z-30 md:mt-0 mt-6">
                <button id="dropdownButton" 
                        class="px-4 py-2 flex text-[14px] items-center bg-black border border-gray-600 rounded-md transition font-caros text-gray-200">
                    Filter {{ request('sort') == 'desc' ? '' : '' }} <i class="fas fa-ellipsis-v ml-2"></i>
                </button>
                <div id="dropdownMenu" 
                    class="absolute right-0 mt-2 w-32 bg-gray-800 text-gray-200 rounded-md shadow-lg hidden">
                    <a href="{{ route('film', ['genre' => request('genre'), 'search' => request('search'), 'sort' => 'desc']) }}" 
                    class="block px-4 py-2">
                        Teratas
                    </a>
                    <a href="{{ route('film', ['genre' => request('genre'), 'search' => request('search')]) }}" 
                    class="block px-4 py-2 pb-4">
                        Terbawah
                    </a>
                </div>
            </div>
        </div>
    </div>

    <div data-aos="fade-up" data-aos-duration="700" data-aos-delay="100" class="grid md:grid-cols-4 grid-cols-2 md:gap-6 gap-3 pt-6">
        @foreach($filmsWithGenres as $film)
            <div class="relative">
                <div class="relative group w-full h-[220px] md:h-[400px] rounded-lg overflow-hidden">
                    <img src="{{$film->poster}}"
                         class="w-full h-full object-cover rounded-lg transition-transform duration-300 group-hover:scale-105"
                         alt="">

                
                    
                    <a href="{{ route('detailfilm', ['id' => $film->id]) }}">
                        <button id="btn-detail"
                                class="absolute inset-0 flex items-center justify-center opacity-0 group-hover:opacity-100 transition-opacity duration-300 text-white bg-black bg-opacity-55 py-2 px-4 rounded-md">
                            Lihat Selengkapnya
                        </button>
                    </a>
                </div>
             
                <div class="font-caros">
                    <div class="flex justify-between pt-3 pb-3">
                        <h1 class="text-gray-200 md:text-xl text-lg mr-2">{{$film->judul}}</h1>
                        <p class="text-gray-200 md:text-lg text-sm flex items-center">
                            {{ number_format($film->average_rating, 1) }}
                            <i class="fas fa-star text-yellow-500 mt-[-2px]"></i>
                        </p>
                    </div>
                    <h1 class="text-gray-400 text-sm rounded-sm">{{$film->genres}}</h1>
                    <div class="flex justify-between pt-2 text-[12px]">
                        <h1 class="text-gray-400 rounded-sm">{{$film->usia}}</h1>
                        <p class="text-gray-400 rounded-sm">{{ Carbon\Carbon::parse($film->tahun_rilis)->format('d F Y') }}</p>
                        <p class="text-gray-400 rounded-sm">{{$film->durasi}} Menit</p>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</section>

@endsection
