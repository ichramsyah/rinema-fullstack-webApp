@extends('admin.dashboard')

@section('ratingedit')

<div class="container mx-auto ">
        
        <a href="{{route('admin.ratings.index')}}" class="px-2 py-1 rounded-sm text-red-500 font-bold"><i class="fas fa-arrow-left"></i> <u>Back</u></a>
        
        <h4 class="text-2xl px-7 pt-4 font-semibold">Edit Ratings</h4>
   

        <form action=" {{route('admin.ratings.update', $rating->id)}} " method="post" class="px-8 pt-4 pb-8 mb-4">
            @csrf 
            <div class="mb-4">
                <label for="user_id" class="block text-gray-700 text-sm font-bold mb-2">User</label>
                <input type="text" value="{{ $rating->user->name }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" disabled>
                <input type="text" name="user_id" id="user_id" value="{{ $rating->user_id }}"
                       class="font-bold appearance-none border-b-3 border-red-500 w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" hidden>
            </div>
            <div class="mb-4">
                <label for="film_id" class="block text-gray-700 text-sm font-bold mb-2">Film</label>
                <input type="text" value="{{ $rating->film->judul }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" disabled>
                <input type="text" name="film_id" id="film_id" value="{{ $rating->film_id }}"
                       class="font-bold appearance-none border-b-3 border-red-500 w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" hidden>
            </div>

            <div class="mb-4">
                <label for="rating" class="block text-gray-700 font-bold mb-2">Rating</label>
                <div class="flex items-center space-x-2">
                    <i class="fas fa-star text-yellow-400 text-2xl"></i>
                    <input type="number" name="rating" id="rating" class="w-18 text-center h-[30px] border-none rounded" min="0" max="10" step="0.1" value="{{ $rating->rating }}>
                    <h1 class="text-xl">/ 10</h1>
                </div>
            </div>


            <div class="mb-4">  
                <label for="comment" class="block text-gray-700 text-sm font-bold mb-2">Comment</label>
                <input type="text" name="comment" id="comment" value="{{ $rating->comment }}"
                       class="appearance-none mt-2 font-bold border-t-transparent border-l-transparent border-r-transparent border-2 border-red-500 focus:border-t-transparent focus:border-l-transparent focus:border-r-transparent focus:border-2 focus:border-red-500 bg-transparent  w-full py-1 px-3 text-gray-700 leading-tight focus:ring-transparent focus:shadow-outline">
            </div>



            <div class="flex items-center justify-between">
                <button
                    class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-6 mt-2 cursor-pointer rounded focus:outline-none focus:shadow-outline"
                    type="submit">
                    Update
                </button>
            </div>
        </form>
    </div>

@endsection