@extends('admin.dashboard')

@section('filmgenreedit')
<div class="container mx-auto p-3">
    
    <a href="{{route('admin.filmgenre.tampil')}}" class=" py-1 rounded-sm text-red-500 font-bold"><i class="fas fa-arrow-left"></i> <u>Back</u></a>

    <form class="mt-6" action="{{ route('admin.filmgenre.update', $filmGenre->id) }}" method="POST">
        @csrf
        
        <h1 class="text-2xl font-bold mb-4">{{$film->judul}}</h1>
        
        <div class="mb-4">
            <label class="text-lg font-semibold">Choose Genre</label>
            <div class="flex flex-wrap gap-2 mt-2">
            <input type="hidden" name="film_id" value="{{ $film->id }}">
                @foreach ($genres as $genre)
                    <label for="genre{{ $genre->id }}" class="px-4 py-2 rounded-sm text-white cursor-pointer transition-colors 
                        {{ in_array($genre->id, $filmGenres) ? 'bg-gray-700' : 'bg-gray-300' }}">
                        <input type="checkbox" name="genres[]" value="{{ $genre->id }}" id="genre{{ $genre->id }}" class="hidden"
                            {{ in_array($genre->id, $filmGenres) ? 'checked' : '' }}>
                        {{ $genre->nama }}
                    </label>
                @endforeach
            </div>
        </div>
        
        <button type="submit" class="px-4 py-2 bg-red-500 hover:bg-red-600 text-white mt-4 rounded-sm">Simpan</button>
    </form>
</div>

<script>
    document.querySelectorAll('input[type=checkbox]').forEach(checkbox => {
        checkbox.addEventListener('change', function () {
            const label = this.parentElement;
            label.classList.toggle('bg-gray-700', this.checked);
            label.classList.toggle('bg-gray-300', !this.checked);
        });
    });
</script>
@endsection
