@extends('admin.dashboard')

@section('forumcreate')

<div class="px-4">
    <a href="{{route('admin.forums.index')}}" class=" py-1 rounded-sm text-red-500 font-bold"><i class="fas fa-arrow-left"></i> <u>Back</u></a>

    <h1 class="text-2xl text-gray-700 font-bold pt-4 pb-6">Add Forums</h1>

    <form  method="post" action="{{route('admin.forums.store')}}">
        @csrf

        {{-- Menampilkan pesan error validasi --}}
        @if ($errors->any())
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4" role="alert">
                <strong class="font-bold">Oops! Ada kesalahan:</strong>
                <ul class="list-disc pl-5">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
                
            </div>
        @endif

        <div class="mb-4">
            <label class="block text-gray-700 text-lg font-bold mb-2">Title</label>
            <input for="title" class="appearance-none mt-2 font-bold border-t-transparent border-l-transparent border-r-transparent border-2 border-red-500 focus:border-t-transparent focus:border-l-transparent focus:border-r-transparent focus:border-2 focus:border-red-500 bg-transparent  w-full py-1 px-3 text-gray-700 leading-tight focus:ring-transparent focus:shadow-outline" name="title" type="text">
            @error('title')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div class="flex flex-wrap w-full pt-2">


            <div class="w-1/2">
                <label class="block text-gray-700 text-lg font-bold mb-2">Creator</label>
                <div class="flex flex-wrap gap-2">
                    @foreach($users as $user)
                    <button type="button" class="user-btn hover:bg-gray-500 hover:text-white transition-all px-8 text-gray-600 py-2 border border-gray-500 rounded-sm focus:ring focus:ring-transparent" data-value="{{ $user->id }}">{{ $user->name }}</button>
                    @endforeach
                </div>
                <input type="hidden" name="user_id" id="user_id">
                @error('user_id')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="w-1/2 ">
                <label class="block text-gray-700  text-lg font-bold mb-2">Film</label>
                <div class="flex flex-wrap gap-2">
                    @foreach($films as $film)
                    <button type="button" class="film-btn hover:bg-gray-500 hover:text-white transition-all px-8 text-gray-600 py-2 border border-gray-500 rounded-sm focus:ring focus:ring-transparent" data-value="{{ $film->id }}">{{ $film->judul }}</button>
                    @endforeach
                </div>
                <input type="hidden" name="film_id" id="film_id">
                @error('film_id')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

        </div>

        <button type="submit" class="bg-red-500 text-white px-6 py-2 mt-5 rounded hover:bg-red-600">Add</button>


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