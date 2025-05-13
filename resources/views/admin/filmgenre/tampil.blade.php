@extends('admin.dashboard')

@section('filmgenrekonten')
<div>
    <div class="flex justify-between">
        <h1 class="font-bold text-2xl">Film Genre List</h1>
        <button>
                <a class="bg-red-500 px-4 hover:bg-red-600 transition-all py-2 text-white rounded-sm"
                   href="{{ route('admin.filmgenre.tambah') }}"> <i class="fas fa-plus text-sm mr-1"></i> Add</a>
            </button>
    </div>
    <div class="mt-5">
        <ul>
            @foreach ($films as $film)
            <li class="bg-white rounded-xl p-6 mb-4 flex items-start">
                <img src="{{ $film->poster }}" alt="Poster {{ $film->judul }}" class="w-24 h-auto rounded-lg mr-6">
                <div class="flex-grow">
                    <div class="relative flex justify-between items-start">
                        <h1 class="text-2xl font-semibold">{{ $film->judul }} <span class="text-lg text-gray-500 pl-3">{{ $film->tahun_rilis }}</span></h1>
                        <button class="text-gray-500 hover:text-gray-700" onclick="toggleMenu(event, this)">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 5v.01M12 12v.01M12 19v.01M12 6a1 1 0 110-2 1 1 0 010 2zm0 7a1 1 0 110-2 1 1 0 010 2zm0 7a1 1 0 110-2 1 1 0 2z" />
                            </svg>
                        </button>
                        <div class="menu absolute hidden bg-white border rounded shadow-md mt-6 right-0 w-48">
                            <ul>
                                <li class="flex items-center">
                                @if (isset($filmGenres[$film->id]) && $filmGenres[$film->id]->isNotEmpty())
                                    <a href="{{ route('admin.filmgenre.edit', $filmGenres[$film->id]->first()->id) }}" class="block w-full px-4 font-semibold text-gray-600 py-2 hover:bg-gray-100">
                                        <i class="fas fa-pencil-alt mr-1 text-gray-600"></i> Edit
                                    </a>
                                @else
                                    <a href="{{ route('admin.filmgenre.tambah') }}" class="block w-full px-4 font-semibold text-gray-600 py-2 hover:bg-gray-100">
                                        <i class="fas fa-plus mr-1 text-gray-600"></i> Tambah Genre
                                    </a>
                                @endif
                                </li>
                            </ul>
                        </div>
                    </div>
                    <ul class="flex mt-2">
                        @foreach ($filmGenres[$film->id] as $filmGenre)
                        <li class="bg-red-100 text-red-600 px-3 py-1 rounded-sm mr-2 text-sm">{{ $filmGenre->genre_name }}</li>
                        @endforeach
                    </ul>
                </div>
            </li>
            @endforeach
        </ul>
    </div>
</div>

<script>
    function toggleMenu(event, button) {
        event.stopPropagation();
        const menu = button.nextElementSibling;
        
        document.querySelectorAll('.menu').forEach(m => {
            if (m !== menu) {
                m.classList.add('hidden');
            }
        });

        menu.classList.toggle('hidden');
    }

    document.addEventListener('click', function () {
        document.querySelectorAll('.menu').forEach(menu => {
            menu.classList.add('hidden');
        });
    });
</script>
@endsection