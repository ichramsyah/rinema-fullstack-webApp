@extends('admin.dashboard')

@section('filmkonten')
<div>
    <h1 class="font-bold text-2xl">All Films</h1>
    
    <div class="flex py-4">
        <div class="bg-white w-40  px-4 py-4 rounded-[10px] gap-4 col flex items-center">
            <i class="fas fa-film bg-blue-200 text-blue-500 rounded-full text-[21px] px-3 py-3"></i>
            <div class="items-center">
                <h1 class="font-bold text-xl mb-[-4px]">{{$allFilm}}</h1>
                <h1 class=" font-bold text-gray-500 text-[14px] ">Film</h1>
            </div>
        </div>
    </div>
    <div class="flex items-center justify-between">
        <h1 class="text-xl font-semibold">Film List</h1>
        <div class="flex items-center space-x-4">
            <form method="get" class="relative items-center flex" action="{{route('admin.films.tampil')}}">
                <button class="absolute mt-1 ml-3 text-gray-400" type="submit">
                    <i class="fas fa-search "></i>
                </button>
                <input class="h-10 pl-9 w-60 text-gray-600 font-semibold rounded-lg focus:outline-none border-none focus:ring-2 focus:ring-transparent focus:border-transparent" type="search" name="search" placeholder="Search" value="{{request('search')}}">
            </form>
            <button>
                <a class="bg-red-500 px-4 hover:bg-red-600 transition-all py-2 text-white rounded-sm"
                    href="{{ route('admin.films.tambah') }}"> <i class="fas fa-plus text-sm mr-1"></i> Add</a>
            </button>
        </div>
        
    </div>

    <div class="mx-auto mt-3 px-1 overflow-x-auto">
        <table class="min-w-full border-none rounded-lg overflow-hidden">
            <thead class="text-black text-left ">
                <tr class="bg-white text-gray-600">
                    <th class="py-3 px-5 ">No</th>
                    <th class="py-3 px-5">Judul</th>
                    <th class="py-3 px-5">Produser</th>
                    <th class="py-3 px-5">Sutradara</th>
                    <th class="py-3 px-5">Penulis</th>
                    <th class="py-3 px-5">Produksi</th>
                    <th class="py-3 px-5">Pemeran</th>
                    <th class="py-3 px-5">
                        <a href="{{route('admin.films.tampil', ['sortColumn' => 'tahun_rilis', 'sortDirection' => $sortColumn === 'tahun_rilis' && $sortDirection === 'asc' ? 'desc' : 'asc']) }}">
                            Tahun Rilis
                            @if ($sortColumn === 'tahun_rilis')
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
                    <th class="py-3 px-5">Durasi</th>
                    <th class="py-3 px-5">Usia</th>
                    <th class="py-3 px-5">Poster</th>
                    <th class="py-3 px-5">Trailer</th>
                    <th class="py-3 px-5">Sinopsis</th>
                    <th class="py-3 px-5"></th>
                </tr>
            </thead>
            <tbody>
                 @foreach($film as $data)
                <tr class="font-bold text-sm text-gray-600">
                    <td class="py-3 border-b border-gray-300 px-4">{{ $film->firstItem() + $loop->index  }}</td>
                    <td class="py-3 border-b border-gray-300 px-4">{{ $data->judul }}</td>
                    <td class="py-3 border-b border-gray-300 px-4">{{ Str::limit($data->produser, 30, '...') }}</td>
                    <td class="py-3 border-b border-gray-300 px-4">{{ Str::limit($data->sutradara, 30, '...') }}</td>
                    <td class="py-3 border-b border-gray-300 px-4">{{ Str::limit($data->penulis, 30, '...') }}</td>
                    <td class="py-3 border-b border-gray-300 px-4">{{ $data->produksi }}</td>
                    <td class="py-3 border-b border-gray-300 px-4">{{ Str::limit($data->pemeran, 30, '...') }}</td>
                    <td class="py-3 border-b border-gray-300 px-4">{{ $data->tahun_rilis }}</td>
                    <td class="py-3 border-b border-gray-300 px-4">{{ $data->durasi }} Menit</td>
                    <td class="py-3 border-b border-gray-300 px-4">{{ $data->usia }}</td>
                    <td class="py-3 border-b border-gray-300 px-4">
                        <img src="{{ $data->poster }}" alt="Poster {{ $data->judul }}">
                    </td>
                    <td class="py-3 border-b border-gray-300 px-4">
                        <iframe class="w-full rounded-xl md:h-full h-[260px]" src="{{ $data->trailer }}" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" referrerpolicy="strict-origin-when-cross-origin" allowfullscreen></iframe>
                    </td>
                    <td class="py-3 border-b border-gray-300 px-4">{{ Str::limit($data->sinopsis, 30, '...') }}</td>
                    <td class="py-12 border-b border-gray-300 px-4 flex items-center space-x-2">
                        <a href="{{route('admin.films.edit', $data->id)}}" class="text-center rounded-full cursor-pointer transition-all hover:bg-gray-700 bg-slate-400 text-sm text-white px-2 py-1">
                            <i class="fas fa-pencil-alt text-[12px]"></i>
                        </a>
                        <form method="post" action="{{route('admin.films.hapus', $data->id)}}">
                            @csrf
                            <button class="text-center rounded-full cursor-pointer transition-all hover:bg-red-700 bg-red-500 text-sm text-white px-2 py-1">
                                <i class="fas fa-trash-alt text-[12px]"></i>
                            </button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
<div class="mt-4">
    {{ $film->appends([
            'sortColumn' => $sortColumn,
            'sortDirection' => $sortDirection,
            'search' => request('search')   
        ])->links() 
        }}
</div>
@endsection