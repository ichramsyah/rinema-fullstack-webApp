@extends('admin.dashboard')

@section('userkonten')
    <div>
        <div class="flex justify-between">
            <h1 class="font-bold text-2xl">All Users</h1>
        </div>
        
        <div class="flex py-2 mt-2">
            <div class="bg-white w-36 px-4 py-4 rounded-[10px] gap-4 col flex items-center">
                <i class="fas fa-user bg-red-200 text-red-500 rounded-full text-[21px] px-3 py-3"></i>
                <div class="items-center">
                    <h1 class="font-bold text-xl mb-[-4px]">{{$allUser}}</h1>
                        <h1 class=" font-bold text-gray-500 text-[14px] ">user</h1>
                </div>
            </div>
        </div>
        <div class="flex justify-between">
            <h2 class="font-bold text-xl mt-4 mb-4">User List</h2>
            <div class="flex items-center space-x-4">
                <form method="get" class="relative items-center flex" action="{{route('admin.users.tampil')}}">
                    <button class="absolute mt-1 ml-3 text-gray-400" type="submit">
                        <i class="fas fa-search "></i>
                    </button>
                    <input class="h-10 pl-9 w-60 text-gray-600 font-semibold rounded-lg focus:outline-none border-none focus:ring-2 focus:ring-transparent focus:border-transparent" type="search" name="search" placeholder="Search users" value="{{request('search')}}">
                </form>
                <button>
                    <a class="bg-red-500 px-4 hover:bg-red-600 transition-all py-2 text-white rounded-sm"
                    href="{{ route('admin.users.tambah') }}"> <i class="fas fa-plus text-sm mr-1"></i> Add</a>
                </button>
                
            </div>
            
        </div>

        <div class="container mx-auto mt-1">
            <table class="min-w-full border-none rounded-lg  overflow-hidden">
                <thead class="text-black text-left ">
                    <tr class="bg-white text-gray-600">
                        <th class="py-3 px-5 ">No</th>
                        <th class="py-3 px-5">
                            <a href="{{route('admin.users.tampil', ['sortColumn' => 'name', 'sortDirection' => $sortColumn === 'name' && $sortDirection === 'asc' ? 'desc' : 'asc']) }}">
                                Name
                                @if ($sortColumn === 'name')
                                    @if($sortDirection === 'asc')
                                    <i class="fa-solid fa-caret-down text-[12px] text-gray-500 pl-1 "></i>
                                    @else
                                    <i class="fa-solid fa-caret-up text-[12px] text-gray-500 pl-1 "></i>
                                    @endif
                                @else
                                <i class="fa-solid fa-sort text-[12px] text-gray-500 pl-1 "></i>
                                @endif
                            </a>
                        </th>
                        <th class="py-3 px-5">Role</th>
                        <th class="py-3 px-5">
                            <a href="{{route('admin.users.tampil', ['sortColumn' => 'email', 'sortDirection' => $sortColumn === 'email' && $sortDirection === 'asc' ? 'desc' : 'asc']) }}">
                                Email
                                @if ($sortColumn === 'email')
                                    @if($sortDirection === 'asc')
                                    <i class="fa-solid fa-caret-down text-[12px] text-gray-500 pl-1 "></i>
                                    @else
                                    <i class="fa-solid fa-caret-up text-[12px] text-gray-500 pl-1 "></i>
                                    @endif
                                @else
                                <i class="fa-solid fa-sort text-[12px] text-gray-500 pl-1 "></i>
                                @endif
                            </a>
                        </th>
                        <th class="py-3 px-5">Avatar</th>
                        <th class="py-3 px-5">Status</th>
                        <th class="py-3 px-5">
                            <a href="{{route('admin.users.tampil', ['sortColumn' => 'created_at', 'sortDirection' => $sortColumn === 'created_at' && $sortDirection === 'asc' ? 'desc' : 'asc']) }}">
                                Created at
                                @if ($sortColumn === 'created_at')
                                    @if($sortDirection === 'asc')
                                    <i class="fa-solid fa-caret-down text-[12px] text-gray-500 pl-1 "></i>
                                    @else
                                    <i class="fa-solid fa-caret-up text-[12px] text-gray-500 pl-1 "></i>
                                    @endif
                                @else
                                <i class="fa-solid fa-sort text-[12px] text-gray-500 pl-1 "></i>
                                @endif
                            </a>
                        </th>
                        <th class="py-3 px-5"></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($user as $u)
                        <tr class="font-bold text-sm  text-gray-600">
                            <td class="py-3 border-b border-gray-300 px-4">{{ $user->firstItem() + $loop->index  }}</td>
                            <td class="py-3 border-b border-gray-300 px-4 ">{{ $u->name }}</td>
                            <td class="py-3 border-b border-gray-300 px-4 ">{{ $u->role }}</td>
                            <td class="py-3 border-b border-gray-300 px-4 ">{{ $u->email }}</td>
                            <td class="py-3 border-b border-gray-300 pl-7">
                                <img src="{{ Avatar::create($u->name)->toBase64() }}" class="rounded-full w-8 h-8 object-cover">
                            </td>
                            <td class="py-3 border-b border-gray-300 text-center text-sm pr-5">
                                @if($u->is_active)
                                    <h1><i class="fas fa-circle text-[12px] text-green-500"></i> Active</h1>
                                    
                                @else
                                    <h1><i class="fas fa-circle text-[12px] text-red-500"></i> Off</h1>
                                @endif
                            </td>
                            <td class="py-3 border-b border-gray-300 px-4 text-[14px]">{{ $u->created_at }}</td>
                            <td class="py-4 border-b border-gray-300 px-2 justify-center gap-2 flex">
                                <a class="text-center rounded-full cursor-pointer transition-all hover:bg-gray-700 bg-slate-400 text-sm text-white px-2 py-1" href=" {{route('admin.users.edit', $u->id)}} "><i class="fas fa-pencil-alt text-[12px]"></i></a>
                                <form method="post" action="{{route('admin.users.hapus', $u->id)}}"> 
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
        {{ $user->appends([
            'sortColumn' => $sortColumn,
            'sortDirection' => $sortDirection,
            'search' => request('search')   
        ])->links() 
        }}
    </div> 
@endsection