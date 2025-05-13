@extends('admin.dashboard')

@section('filmgenretambah')
<div class="bg-gray-100 px-4 rounded-lg">
    
    <a href="{{route('admin.filmgenre.tampil')}}" class=" rounded-sm text-red-500 font-bold"><i class="fas fa-arrow-left"></i> <u>Back</u></a>

    <h1 class="text-2xl font-bold mb-4 mt-6">Tambah Genre Film</h1>
    
    <form action="{{ route('admin.filmgenre.store') }}" method="POST">
        @csrf
        
        <div class="mb-4">
            <label for="film_id" class="block font-semibold mb-2">Film</label>
            <div class="flex gap-2">
                @foreach (\App\Models\Film::all() as $film)
                    <button type="button" class="film-option transition-all hover:bg-gray-300  font-semibold text-gray-600 px-4 py-2 border rounded-sm" data-value="{{ $film->id }}">
                        {{ $film->judul }}
                    </button>
                @endforeach
            </div>
            <input type="hidden" name="film_id" id="film_id">
        </div>
        
        <div class="mb-4">
            <label for="genres" class="block font-semibold mb-2">Genre</label>
            <div class="flex gap-2 flex-wrap">  
                @foreach (\App\Models\Genre::all() as $genre)
                    <button type="button" class="genre-option transition-all hover:bg-gray-300  font-semibold text-gray-600 px-4 py-2 border rounded-sm" data-value="{{ $genre->id }}">
                        {{ $genre->nama }}
                    </button>
                @endforeach
            </div>
            <input type="hidden" name="genres" id="genres">
        </div>
        
        <button type="submit" class="w-40 bg-red-500 mt-4 transition-all text-white py-2 rounded-lg">Simpan</button>
    </form>
</div>

<script>
    document.querySelectorAll('.film-option').forEach(button => {
        button.addEventListener('click', function () {
            document.querySelectorAll('.film-option').forEach(btn => btn.classList.remove('bg-gray-300'));
            this.classList.add('bg-gray-300');
            document.getElementById('film_id').value = this.dataset.value;
        });
    });

    document.querySelectorAll('.genre-option').forEach(button => {
    button.addEventListener('click', function () {
        this.classList.toggle('bg-gray-300');
        let selectedGenres = Array.from(document.querySelectorAll('.genre-option.bg-gray-300')).map(btn => btn.dataset.value);
        document.getElementById('genres').value = JSON.stringify(selectedGenres); // Gunakan JSON.stringify()
    });
});
</script>
@endsection