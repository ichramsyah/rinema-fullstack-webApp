@extends('admin.dashboard')

@section('genrekonten')

<div>
    <div class="flex justify-between">
        <h1 class="font-bold text-2xl">All Genres</h1>
        <button>
            <a class="bg-red-500 px-4 hover:bg-red-600 transition-all py-2 text-white rounded-sm"
               href="{{ route('admin.genres.tambah') }}"> <i class="fas fa-plus text-sm mr-1"></i> Add</a>
        </button>
    </div>
    <div class="flex py-4">
        <div class="bg-white w-40 px-4 py-4 rounded-[10px] gap-4 col flex items-center">
            <i class="fas fa-tags bg-green-200 text-green-500 rounded-full text-[21px] px-3 py-3"></i>
            <div class="items-center">
                <h1 class="font-bold text-xl mb-[-4px]">{{$allGenres}}</h1>
                    <h1 class=" font-bold text-gray-500 text-[14px] ">Genres</h1>
            </div>
        </div>
    </div>
    <div class="mt-2">
    <h2 class="font-bold text-xl mb-4">Genre List</h2>
    <div class="flex flex-wrap gap-2">
    @foreach ($genre as $genre)
        <div class="relative flex items-center justify-between bg-white text-gray-800 px-4 py-1 rounded-md w-36 ">
            <span class="font-bold text-[15px] text-center flex-1">{{ $genre->nama }}</span>
            <button class="focus:outline-none px-1 py-1" onclick="toggleMenu(event, this)">
                <i class="fas fa-ellipsis-v text-gray-400"></i>
            </button>
            <div class="menu absolute z-50 right-0 mt-32 w-32 bg-white rounded-md shadow-lg hidden">
                <a href="{{ route('admin.genres.edit', $genre->id) }}" class="block font-bold px-3 py-2 text-sm text-gray-600 hover:bg-gray-100">
                    <i class="fas fa-pencil-alt mr-1 text-gray-600"></i>   Edit
                </a>
                <form method="post" action="{{route('admin.genres.hapus', $genre->id) }}">
                    @csrf
                    <button class="block font-bold w-full text-left px-3 py-2 text-sm text-gray-600 hover:bg-gray-100" type="submit">
                        <i class="fas fa-trash-alt mr-1 text-gray-600"></i>    Hapus
                    </button>
                </form>
            </div>
        </div>
    @endforeach
</div>
</div>
</div>

<script>
    function toggleMenu(event, button) {
        event.stopPropagation(); // Mencegah event dari bubbling ke document
        const menu = button.nextElementSibling;
        
        // Tutup semua menu terlebih dahulu
        document.querySelectorAll('.menu').forEach(m => {
            if (m !== menu) {
                m.classList.add('hidden');
            }
        });

        // Toggle menu yang diklik
        menu.classList.toggle('hidden');
    }

    // Tutup menu jika klik di luar
    document.addEventListener('click', function () {
        document.querySelectorAll('.menu').forEach(menu => {
            menu.classList.add('hidden');
        });
    });
</script>
@endsection