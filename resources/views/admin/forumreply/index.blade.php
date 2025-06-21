@extends('admin.dashboard')

@section('forumreplykonten')

<div>
    <h1 class="font-bold text-2xl">All Replies</h1>

    <div class="flex flex-wrap py-4 space-x-2">
        <div class="bg-white w-40 px-4 py-4 rounded-[10px] gap-4 col flex items-center">
            <i class="fas fa-comments bg-orange-100 text-orange-400 rounded-full text-[21px] px-3 py-3"></i>
            <div class="items-center">
                <h1 class="font-bold text-xl mb-[-4px]">{{$allReplies}}</h1>
                <h1 class=" font-bold text-gray-500 text-[14px] ">Replies</h1>
            </div>
        </div>
    </div>

    <div class="flex justify-between">
        <h2 class="font-bold text-xl mt-4 mb-4">Replies List</h2>
        <div class="flex items-center space-x-4">
            <form method="get" class="relative items-center flex" action="{{route('admin.forumreply.index')}}">
                <button class="absolute mt-1 ml-3 text-gray-400" type="submit">
                    <i class="fas fa-search "></i>
                </button>
                <input class="h-10 pl-9 w-60 text-gray-600 font-semibold rounded-lg focus:outline-none border-none focus:ring-2 focus:ring-transparent focus:border-transparent" type="search" name="search" placeholder="Search" value="{{request('search')}}">
            </form>
            <button>
                <a class="bg-red-500 px-4 hover:bg-red-600 transition-all py-2 text-white rounded-sm"
                href="{{ route('admin.forumreply.create') }}"> <i class="fas fa-plus text-sm mr-1"></i> Add</a>
            </button>
        </div>
        
    </div>

    <table class="min-w-full border-none rounded-lg overflow-hidden">
        <thead class="text-left text-black">
            <tr class="text-gray-600 bg-white">
                <th class="px-3 py-3">No</th>
                <th class="px-3 py-3">
                    <a href="{{ route('admin.forumreply.index', ['sortColumn' => 'forum_id', 'sortDirection' => $sortColumn === 'forum_id' && $sortDirection === 'asc' ? 'desc' : 'asc']) }}">
                    Forum
                        @if ($sortColumn === 'forum_id')
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
                <th class="px-3 py-3">
                    <a href="{{ route('admin.forumreply.index', ['sortColumn' => 'user_id', 'sortDirection' => $sortColumn === 'user_id' && $sortDirection === 'asc' ? 'desc' : 'asc']) }}">
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
                <th class="px-3 py-3">
                    <a href="{{ route('admin.forumreply.index', ['sortColumn' => 'body', 'sortDirection' => $sortColumn === 'body' && $sortDirection === 'asc' ? 'desc' : 'asc']) }}">
                    Body
                        @if ($sortColumn === 'body')
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
                <th class="px-3 py-3">
                    <a href="{{ route('admin.forumreply.index', ['sortColumn' => 'created_at', 'sortDirection' => $sortColumn === 'created_at' && $sortDirection === 'asc' ? 'desc' : 'asc']) }}">
                    Created at
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
                <th class="px-3 py-3"></th>
            </tr>
        </thead>
        <tbody>
            @foreach($replies as $reply)
            <tr class="font-bold text-sm text-gray-600">
                <td class="py-3 border-b border-gray-300 px-3">{{ $loop->iteration }}</td>
                <td class="py-3 border-b border-gray-300 px-3">{{ $reply->forum->title }}</td>
                <td class="py-3 border-b border-gray-300 px-3">{{ $reply->user->name }}</td>
                <td class="py-3 border-b border-gray-300 px-3">{{ Str::limit($reply->body, 10, '...') }}</td>
                <td class="py-3 border-b border-gray-300 px-3">{{ $reply->created_at }}</td>
                <td class="py-3 border-b border-gray-300 px-3 flex gap-1">
                    <a class="text-center rounded-full cursor-pointer transition-all hover:bg-gray-700 bg-slate-400 text-sm text-white px-2 py-1" href=" {{route('admin.forumreply.edit', $reply->id)}} "><i class="fas fa-pencil-alt text-[12px]"></i></a>

                    <form method="post" action="{{route('admin.forumreply.destroy', $reply->id)}}">
                        @csrf 
                        <button class="text-center rounded-full cursor-pointer transition-all hover:bg-red-700 bg-red-500 text-sm text-white px-2 py-1"><i class="fas fa-trash-alt text-[12px]"></i></button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>

<div class="mt-4">
        {{ $replies->appends([
            'sortColumn' => $sortColumn,
            'sortDirection' => $sortDirection,
            'search' => request('search')   
        ])->links() 
        }}
    </div>
@endsection