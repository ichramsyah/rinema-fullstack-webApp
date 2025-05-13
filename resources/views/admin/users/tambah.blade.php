@extends('admin.dashboard')

@section('usertambah')

    <div class="container mx-auto">
        
        <a href="{{route('admin.users.tampil')}}" class="px-4 py-1 rounded-sm text-red-500 font-bold"><i class="fas fa-arrow-left"></i> <u>Back</u></a>

        <h4 class="text-2xl px-7 pt-4 font-semibold">Add User</h4>

        <form action="{{ route('admin.users.submit') }}" method="post" class="px-6 pt-6 pb-8 mb-4">
            @csrf
            <div class="mb-5">
                <label for="name" class="block text-gray-700 text-sm font-bold ">Name</label>
                <input type="text" name="name" id="name"
                    class="appearance-none mt-2 font-bold border-t-transparent border-l-transparent border-r-transparent border-2 border-red-500 focus:border-t-transparent focus:border-l-transparent focus:border-r-transparent focus:border-2 focus:border-red-500 bg-transparent  w-full py-1 px-3 text-gray-700 leading-tight focus:ring-transparent focus:shadow-outline"
                    value="{{ old('name') }}">
                @error('name')
                    <p class="text-red-500 text-xs italic">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-5">
                <label for="email" class="block text-gray-700 text-sm font-bold ">Email</label>
                <input type="email" name="email" id="email"
                    class="appearance-none mt-2 font-bold border-t-transparent border-l-transparent border-r-transparent border-2 border-red-500 focus:border-t-transparent focus:border-l-transparent focus:border-r-transparent focus:border-2 focus:border-red-500 bg-transparent  w-full py-1 px-3 text-gray-700 leading-tight focus:ring-transparent focus:shadow-outline"
                    value="{{ old('email') }}">
                @error('email')
                    <p class="text-red-500 text-xs italic">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-5">
                <label for="password" class="block text-gray-700 text-sm font-bold ">Password</label>
                <input type="password" name="password" id="password"
                    class="appearance-none mt-2 font-bold border-t-transparent border-l-transparent border-r-transparent border-2 border-red-500 focus:border-t-transparent focus:border-l-transparent focus:border-r-transparent focus:border-2 focus:border-red-500 bg-transparent  w-full py-1 px-3 text-gray-700 leading-tight focus:ring-transparent focus:shadow-outline">
                @error('password')
                    <p class="text-red-500 text-xs italic">{{ $message }}</p>
                @enderror
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