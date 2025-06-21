@extends('admin.dashboard')

@section('useredit')
    <div class="container mx-auto ">
        
        <a href="{{route('admin.users.tampil')}}" class="px-2 py-1 rounded-sm text-red-500 font-bold"><i class="fas fa-arrow-left"></i> <u>Back</u></a>
        
        <h4 class="text-2xl px-7 pt-4 font-semibold">Edit User</h4>
   

        <form action=" {{route('admin.users.update', $user->id)}} " method="post" class="px-8 pt-4 pb-8 mb-4">
            @csrf <div class="mb-4">
                <label for="name" class="block text-gray-700 text-sm font-bold mb-1">Name</label>
                <input type="text" name="name" id="name" value="{{ $user->name }}"
                       class="font-bold mb-1 appearance-none mt-2 font-bold border-t-transparent border-l-transparent border-r-transparent border-2 border-red-500 focus:border-t-transparent focus:border-l-transparent focus:border-r-transparent focus:border-2 focus:border-red-500 bg-transparent  w-full py-1 px-3 text-gray-700 leading-tight focus:ring-transparent focus:shadow-outline">
            </div>

            <div class="mb-4">
                <label for="email" class="block text-gray-700 text-sm font-bold mb-1">Email</label>
                <input type="email" name="email" id="email" value="{{ $user->email }}"
                       class="font-bold mb-1 appearance-none mt-2 font-bold border-t-transparent border-l-transparent border-r-transparent border-2 border-red-500 focus:border-t-transparent focus:border-l-transparent focus:border-r-transparent focus:border-2 focus:border-red-500 bg-transparent  w-full py-1 px-3 text-gray-700 leading-tight focus:ring-transparent focus:shadow-outline">
            </div>

            <div class="mb-4">
                <label for="password" class="block text-gray-700 text-sm font-bold mb-1">Password</label>
                <input type="password" name="password" id="password" value="{{ $user->password }}"
                       class="font-bold mb-1 appearance-none mt-2 font-bold border-t-transparent border-l-transparent border-r-transparent border-2 border-red-500 focus:border-t-transparent focus:border-l-transparent focus:border-r-transparent focus:border-2 focus:border-red-500 bg-transparent  w-full py-1 px-3 text-gray-700 leading-tight focus:ring-transparent focus:shadow-outline">
            </div>

            <div class="mb-4 flex items-center">
                <label for="is_active" class="text-gray-700 text-sm font-bold mr-3">
                    Is Active
                </label>
                <label class="relative inline-flex items-center cursor-pointer">
                    <input type="checkbox" name="is_active" id="is_active" class="sr-only peer"
                        {{ $user->is_active ? 'checked' : '' }}>
                    <div class="w-11 h-6 bg-gray-300 peer-focus:ring-2 peer-focus:ring-gray-200 rounded-full peer
                                peer-checked:bg-red-500 peer-checked:after:translate-x-full 
                                peer-checked:after:border-white after:content-[''] after:absolute after:top-0.5 
                                after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full 
                                after:h-5 after:w-5 after:transition-all"></div>
                </label>
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