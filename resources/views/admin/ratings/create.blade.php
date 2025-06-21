@extends('admin.dashboard')

@section('ratingcreate')

<div class="px-4">
    <a href="{{route('admin.ratings.index')}}" class=" py-1 rounded-sm text-red-500 font-bold"><i class="fas fa-arrow-left"></i> <u>Back</u></a>

    <h1 class="text-2xl font-bold mb-4 mt-4">Add Ratings</h1>
    @if (session('error'))
        <div class="bg-red-500 text-white p-2 mb-4 rounded">
            {{ session('error') }}
        </div>
    @endif
    <form action="{{ route('admin.ratings.store') }}" method="POST" class="rounded w-full">
        @csrf
        
        <div class="mb-4">
            <label class="block text-gray-700 font-bold mb-2">User</label>
            <div class="flex w-[50%] flex-wrap gap-2">
                @foreach ($users as $user)
                    <button type="button" class="user-btn hover:bg-gray-500 hover:text-white transition-all px-8 text-gray-600 py-2 border border-gray-500 rounded-sm focus:ring focus:ring-transparent" data-value="{{ $user->id }}">{{ $user->name }}</button>
                @endforeach
            </div>
            <input type="hidden" name="user_id" id="user_id">
        </div>
        
        <div class="mb-4">
            <label class="block text-gray-700 font-bold mb-2">Film</label>
            <div class="flex gap-2">
                @foreach ($films as $film)
                    <button type="button" class="film-btn hover:bg-gray-500 hover:text-white transition-all px-8 text-gray-600 py-2 border border-gray-500 rounded-sm focus:ring focus:ring-transparent" data-value="{{ $film->id }}">{{ $film->judul }}</button>
                @endforeach
            </div>
            <input type="hidden" name="film_id" id="film_id">
        </div>
        
        <div class="mb-4">
            <label for="rating" class="block text-gray-700 font-bold mb-2">Rating</label>
            <div class="flex items-center gap-2">
                <i class="fas fa-star text-yellow-400 text-2xl"></i>
                <input type="number" name="rating" id="rating" class="w-18 text-center h-[30px] border-none rounded" min="0" max="10" step="0.1">
                <h1 class="text-xl">/ 10</h1>
            </div>
           
        </div>
        
        <div class="mb-4">
            <label for="comment" class="block text-gray-700 font-bold mb-2">Comment</label>
            <textarea name="comment" id="comment" class=" appearance-none mt-2 font-bold border-t-transparent border-l-transparent border-r-transparent border-2 border-red-500 focus:border-t-transparent focus:border-l-transparent focus:border-r-transparent focus:border-2 focus:border-red-500 bg-transparent  w-full py-1 px-3 text-gray-700 leading-tight focus:ring-transparent focus:shadow-outline"></textarea>
        </div>
        
        <button type="submit" class="bg-red-500 text-white px-6 py-2 rounded hover:bg-red-600">Add</button>
    </form>
</div>

<script>
    document.querySelectorAll('.user-btn').forEach(button => {
    button.addEventListener('click', function() {
        // Set nilai input hidden
        document.getElementById('user_id').value = this.dataset.value;

        // Reset semua tombol agar kembali ke warna default
        document.querySelectorAll('.user-btn').forEach(btn => {
            btn.classList.remove('bg-gray-500', 'text-white');
            btn.classList.add('bg-gray-100', 'text-gray-600');
        });

        // Tambahkan warna pada tombol yang dipilih
        this.classList.remove('bg-gray-100', 'text-gray-600');
        this.classList.add('bg-gray-500', 'text-white');
    });
});
    
document.querySelectorAll('.film-btn').forEach(button => {
    button.addEventListener('click', function() {
        // Set nilai input hidden
        document.getElementById('film_id').value = this.dataset.value;

        // Reset semua tombol agar kembali ke warna default
        document.querySelectorAll('.film-btn').forEach(btn => {
            btn.classList.remove('bg-gray-500', 'text-white');
            btn.classList.add('bg-gray-100', 'text-gray-600');
        });

        // Tambahkan warna pada tombol yang dipilih
        this.classList.remove('bg-gray-100', 'text-gray-600');
        this.classList.add('bg-gray-500', 'text-white');
    });
});
    
  
</script>

@endsection