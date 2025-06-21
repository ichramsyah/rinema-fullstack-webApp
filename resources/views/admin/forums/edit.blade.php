@extends('admin.dashboard')

@section('forumedit')

<div class="px-4">
    <a href="{{route('admin.forums.index')}}" class=" py-1 rounded-sm text-red-500 font-bold">
        <i class="fas fa-arrow-left"></i> <u>Back</u>
    </a>

    <h4 class="text-2xl px-4 pt-4 font-semibold">Edit Forums</h4>

    <form action=" {{route('admin.forums.update', $forum->id)}} " method="post" class="px-4 pt-4 pb-8 mb-4">
        @csrf 

        <div class="mb-4">  
            <label for="title" class="block text-gray-700 text-sm font-bold mb-2">Title</label>
            <input type="text" name="title" id="title" value="{{ $forum->title }}"
                       class="appearance-none mt-2 font-bold border-t-transparent border-l-transparent border-r-transparent border-2 border-red-500 focus:border-t-transparent focus:border-l-transparent focus:border-r-transparent focus:border-2 focus:border-red-500 bg-transparent  w-full py-1 px-3 text-gray-700 leading-tight focus:ring-transparent focus:shadow-outline">
        </div>

        <div class="mb-4">
            <label for="film_id" class="block text-gray-700 text-sm font-bold mb-2">Film</label>
            <input type="text" value="{{ $forum->film->judul }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm text-gray-500 focus:border-indigo-300 focus:ring focus:ring-indigo-200focus:ring-opacity-50" disabled>
            <input type="text" name="film_id" id="film_id" value="{{ $forum->film_id }}" hidden>
        </div>
        
        <div class="mb-4">
            <label for="user_id" class="block text-gray-700 text-sm font-bold mb-2">User</label>
            <input type="text" value="{{ $forum->user->name }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm text-gray-500 focus:border-indigo-300 focus:ring focus:ring-indigo-200focus:ring-opacity-50" disabled>
            <input type="text" name="user_id" id="user_id" value="{{ $forum->user_id }}" hidden>
        </div>
        


        <div class="mb-4 flex items-center">
            <label for="is_active" class="text-gray-700 text-sm font-bold mr-3">
                Is Active
            </label>
            <label class="relative inline-flex items-center cursor-pointer">
            <input type="checkbox" name="is_active" id="is_active" class="sr-only peer"
                        {{ $forum->is_active ? 'checked' : '' }}>
            <div class="w-11 h-6 bg-gray-300 peer-focus:ring-2 peer-focus:ring-gray-200 rounded-full peer
                                peer-checked:bg-red-500 peer-checked:after:translate-x-full 
                                peer-checked:after:border-white after:content-[''] after:absolute after:top-0.5 
                                after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full 
                                after:h-5 after:w-5 after:transition-all"></div>
            </label>
        </div>
        
        <div class="flex items-center justify-between">
            <button
                class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-6 mt-2 cursor-pointer roundedfocus:outline-none focus:shadow-outline"
                type="submit">
                Update
            </button>
        </div>
    </form>
</div>

@endsection