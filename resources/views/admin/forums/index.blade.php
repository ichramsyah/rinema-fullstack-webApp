@extends('admin.dashboard')


@section('forumkonten')

<div>
    <h1 class="font-bold text-2xl">
        All Forums
    </h1>
    <div class="flex flex-wrap py-4 space-x-2">
        <div class="bg-white w-40 px-4 py-4 rounded-[10px] gap-4 col flex items-center">
            <i class="fas fa-comments bg-orange-100 text-orange-400 rounded-full text-[21px] px-3 py-3"></i>
            <div class="items-center">
                <h1 class="font-bold text-xl mb-[-4px]">{{$allForums}}</h1>
                <h1 class=" font-bold text-gray-500 text-[14px] ">Forums</h1>
            </div>
        </div>
    </div>
    <div class="flex justify-between">
        <h1 class="font-bold text-xl">Forum list</h1>
        <button>
            <a class="bg-red-500 px-4 hover:bg-red-600 transition-all py-2 text-white rounded-sm"
            href="{{route('admin.forums.create')}}"> <i class="fas fa-plus text-sm mr-1"></i> Add</a>
        </button>
    </div>

    <div class="container mx-auto mt-4">
        <table class="min-w-full border-none rounded-lg  overflow-hidden">
            <thead class="text-left text-black">
                <tr class="text-gray-600 bg-white">
                    <th class="px-5 py-3">
                        No
                    </th>
                    <th class="px-5 py-3">
                        Title
                    </th>
                    <th class="px-5 py-3">
                        Film
                    </th>
                    <th class="px-5 py-3">
                        Creator
                    </th>
                    <th class="px-5 py-3">
                        Is Active
                    </th>
                    <th class="px-5 py-3">
                        Created at
                    </th>
                    <th class="px-5 py-3"></th>
                </tr>
            </thead>
            <tbody>
                @foreach($forums as $forum)
                <tr class="font-bold text-sm  text-gray-600">
                    <td class="py-3 border-b border-gray-300 px-5">
                        {{ $forums->firstItem() + $loop->index }}
                    </td>
                    <td class="py-3 border-b border-gray-300 px-5">
                        {{$forum->title}}
                    </td>
                    <td class="py-3 border-b border-gray-300 px-5">
                        {{$forum->film->judul}}
                    </td>
                    <td class="py-3 border-b border-gray-300 px-5">
                        {{$forum->user->name}}
                    </td>
                    <td class="py-3 border-b px-5 border-gray-300 text-sm pr-5">
                        @if($forum->is_active)
                            <h1><i class="fas fa-circle text-[12px] text-green-500"></i> Active</h1>
                            
                        @else
                            <h1><i class="fas fa-circle text-[12px] text-red-500"></i> Off</h1>
                        @endif
                    </td>
                    <td class="py-3 border-b border-gray-300 px-5">
                        {{$forum->created_at}}
                    </td>
                    <td class="py-3 border-b border-gray-300 px-5 gap-1 flex">
                        
                        <a class="text-center rounded-full cursor-pointer transition-all hover:bg-gray-700 bg-slate-400 text-sm text-white px-2 py-1" href="{{route('admin.forums.edit', $forum->id)}}"><i class="fas fa-pencil-alt text-[12px]"></i></a>

                        <form method="post" action="{{route('admin.forums.destroy', $forum->id)}}">
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
@endsection