@extends('admin.dashboard')

@section('ratingkonten')
    <div>
        <h1 class="font-bold text-2xl">All Ratings</h1>

        <div class="flex flex-wrap py-4 gap-3">
            <div class="bg-white w-40 px-4 py-4 rounded-[10px] gap-4 col flex items-center">
                <i class="fas fa-star bg-yellow-100 text-yellow-400 rounded-full text-[21px] px-3 py-3"></i>
                <div class="items-center">
                    <h1 class="font-bold text-xl mb-[-4px]">{{$allRatings}}</h1>
                    <h1 class=" font-bold text-gray-500 text-[14px] ">Rating</h1>
                </div>
            </div>
            @foreach ($film as $film)
            <div class="bg-white px-6 py-4 rounded-[10px] gap-4 col flex items-center">
                <img src="{{$film->poster}}" class="rounded-full w-12 h-12 object-cover" alt="">
                <div class="items-center">
                    <div class="font-bold text-xl mb-[-4px] flex items-center">
                        <h1>{{ number_format($averageRatings[$film->id] ?? 0, 1) }}</h1>
                        <i class="fas fa-star text-[17px] ml-1 mb-1 text-yellow-400"></i>
                    </div>
                        <h1 class=" font-bold text-gray-500 text-[14px] ">
                            {{$film->judul}}
                        </h1>
                </div>
            </div>
            @endforeach
        </div>

        <div class="flex justify-between">
            <h2 class="font-bold text-xl mt-4 mb-4">Rating List</h2>

            <div class="flex items-center space-x-4">
                <form method="get" class="relative items-center flex" action="{{route('admin.ratings.index')}}">
                    <button class="absolute mt-1 ml-3 text-gray-400" type="submit">
                        <i class="fas fa-search "></i>
                    </button>
                    <input class="h-10 pl-9 w-60 text-gray-600 font-semibold rounded-lg focus:outline-none border-none focus:ring-2 focus:ring-transparent focus:border-transparent" type="search" name="search" placeholder="Search" value="{{request('search')}}">
                </form>
                <button>
                    <a class="bg-red-500 px-4 hover:bg-red-600 transition-all py-2 text-white rounded-sm"
                    href="{{ route('admin.ratings.create') }}"> <i class="fas fa-plus text-sm mr-1"></i> Add</a>
                </button>
            </div>
            
        </div>

        <div class="container mx-auto mt-1">
            <table class="min-w-full border-none rounded-lg  overflow-hidden">
                <thead class="text-black text-left ">
                    <tr class="bg-white text-gray-600">
                        <th class="py-3 px-5 ">
                            No
                        </th>
                        <th class="py-3 px-2">
                            <a href="{{ route('admin.ratings.index', ['sortColumn' => 'user_id', 'sortDirection' => $sortColumn === 'user_id' && $sortDirection === 'asc' ? 'desc' : 'asc']) }}">
                            User
                                @if ($sortColumn === 'user_id')
                                    @if ($sortDirection === 'asc')
                                    <i class="fa-solid fa-caret-down text-[12px] text-gray-500 pl-1 "></i>
                                    @else
                                    <i class="fa-solid fa-caret-up text-[12px] text-gray-500 pl-1 "></i>
                                    @endif
                                @else
                                <i class="fa-solid fa-sort text-[12px] text-gray-500 pl-1 "></i>
                                @endif
                                
                            </a>
                        </th>
                        <th class="py-3 px-2">
                            <a href="{{ route('admin.ratings.index', ['sortColumn' => 'film_id', 'sortDirection' => $sortColumn === 'film_id' && $sortDirection === 'asc' ? 'desc' : 'asc']) }}">
                                Film
                                    @if ($sortColumn === 'film_id')
                                    @if ($sortDirection === 'asc')
                                    <i class="fa-solid fa-caret-down text-[12px] text-gray-500 pl-1 "></i>
                                    @else
                                    <i class="fa-solid fa-caret-up text-[12px] text-gray-500 pl-1 "></i>
                                    @endif
                                @else
                                <i class="fa-solid fa-sort text-[12px] text-gray-500 pl-1 "></i>
                                @endif
                            </a>
                        </th>
                        <th class="py-3 px-2">
                            <a href="{{ route('admin.ratings.index', ['sortColumn' => 'rating', 'sortDirection' => $sortColumn === 'rating' && $sortDirection === 'asc' ? 'desc' : 'asc']) }}">
                                Rating
                                    @if ($sortColumn === 'rating')
                                    @if ($sortDirection === 'asc')
                                    <i class="fa-solid fa-caret-down text-[12px] text-gray-500 pl-1 "></i>
                                    @else
                                    <i class="fa-solid fa-caret-up text-[12px] text-gray-500 pl-1 "></i>
                                    @endif
                                @else
                                <i class="fa-solid fa-sort text-[12px] text-gray-500 pl-1 "></i>
                                @endif
                            </a>
                        </th>
                        <th class="py-3 px-2">Comment</th>
                        <th class="py-3 px-2">
                            <a href="{{ route('admin.ratings.index', ['sortColumn' => 'created_at', 'sortDirection' => $sortColumn === 'created_at' && $sortDirection === 'asc' ? 'desc' : 'asc']) }}">
                                Create at
                                    @if ($sortColumn === 'created_at')
                                    @if ($sortDirection === 'asc')
                                    <i class="fa-solid fa-caret-down text-[12px] text-gray-500 pl-1 "></i>
                                    @else
                                    <i class="fa-solid fa-caret-up text-[12px] text-gray-500 pl-1 "></i>
                                    @endif
                                @else
                                <i class="fa-solid fa-sort text-[12px] text-gray-500 pl-1 "></i>
                                @endif
                            </a>
                        </th>
                        <th class="py-3 px-2">
                            <a href="{{ route('admin.ratings.index', ['sortColumn' => 'updated_at', 'sortDirection' => $sortColumn === 'updated_at' && $sortDirection === 'asc' ? 'desc' : 'asc']) }}">
                                Update at
                                    @if ($sortColumn === 'updated_at')
                                    @if ($sortDirection === 'asc')
                                    <i class="fa-solid fa-caret-down text-[12px] text-gray-500 pl-1 "></i>
                                    @else
                                    <i class="fa-solid fa-caret-up text-[12px] text-gray-500 pl-1 "></i>
                                    @endif
                                @else
                                <i class="fa-solid fa-sort text-[12px] text-gray-500 pl-1 "></i>
                                @endif
                            </a>
                        </th>
                        <th class="py-3 px-3"></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($ratings as $u)
                        <tr class="font-bold text-sm  text-gray-600">
                            <td class="py-3 border-b border-gray-300 px-5">{{ $ratings->firstItem() + $loop->index }}</td>
                            <td class="py-3 border-b border-gray-300 px-2 ">{{ $u->user->name }}</td>
                            <td class="py-3 border-b border-gray-300 px-2 ">{{ $u->film->judul}}</td>
                            <td class="py-3 border-b border-gray-300 px-2 ">
                                <i class="fas fa-star text-yellow-400 pl-1"></i>    {{ $u->rating }}
                            </td>
                            <td class="py-3 border-b border-gray-300 px-2 ">
                            {{Str::limit($u->comment, 20, '...') }} 
                            </td>
                            <td class="py-3 border-b border-gray-300 px-2 ">{{ $u->created_at }}</td>
                            <td class="py-3 border-b border-gray-300 px-2 ">{{ $u->updated_at }}</td>
                            <td class="py-3 border-b flex gap-1 border-gray-300 px-2 ">

                                <a class="text-center rounded-full cursor-pointer transition-all hover:bg-gray-700 bg-slate-400 text-sm text-white px-2 py-1" href=" {{route('admin.ratings.edit', $u->id)}} "><i class="fas fa-pencil-alt text-[12px]"></i></a>
                                

                                <form method="post" action="{{route('admin.ratings.destroy', $u->id)}}">
                                    @csrf 
                                    <button class="text-center rounded-full cursor-pointer transition-all hover:bg-red-700 bg-red-500 text-sm text-white px-2 py-1"><i class="fas fa-trash-alt text-[12px]"></i></button>
                                </form>
   

                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <div class="mt-4">
        {{ $ratings->appends([
            'sortColumn' => $sortColumn,
            'sortDirection' => $sortDirection,
            'search' => request('search')   
        ])->links() 
        }}
    </div>
@endsection