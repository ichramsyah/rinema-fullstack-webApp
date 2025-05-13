<section class="rating">
    <div class="md:px-14 pt-2 pt-[190px]">
        <h1 data-aos="fade-right" data-aos-duration="1000" data-aos-delay="100" class="font-caros text-2xl md:text-3xl md:py-8 pb-8 text-gray-100 ">
            Rating Tertinggi 
        </h1>

        @if ($topRatedFilm)
        <div class="column md:grid md:grid-cols-[1fr_3fr] md:space-x-4 space-y-6 md:space-y-0">
            <a href="{{ route('detailfilm', ['id' => $topRatedFilm->id]) }}" data-aos="fade-up" data-aos-duration="1000" data-aos-delay="400" class="relative min-h-auto">
                <img src="{{$topRatedFilm->poster}}" class="rounded-xl md:h-auto w-full object-cover h-[350px]" alt="">
                <div class="absolute right-[10px] bottom-[80px] z-10">
                    <h1 class="text-white font-caros ">{{ number_format($topRatedFilm->average_rating, 1) }}
                        <i class="fas fa-star text-yellow-300 text-lg"></i>
                    </h1>
                </div>
                <div class="absolute bottom-0 w-full rounded-br-xl rounded-bl-xl bg-gradient-to-t from-black via-black bg-opacity-80 to-transparent h-[200px]">
                </div>
                <div class="absolute bottom-0 w-full space-y-2 px-4 pb-6 font-caros">
                    <h1 class="text-white pr-[50px] text-xl">
                        {{($topRatedFilm->judul) }} 
                    </h1>
                    <h1 class="text-gray-300 text-[12px]">
                        @foreach ($genres as $genre) {{ $genre }} @if (!$loop->last), @endif @endforeach
                    </h1>
                    <h1 class="text-gray-300 text-[12px]">
                        {{ Carbon\Carbon::parse($topRatedFilm->tahun_rilis)->format('d F Y') }}
                    </h1>
                </div>
            </a>
            
            <div data-aos="fade-up" data-aos-duration="1200" data-aos-delay="700" class="relative">
                @if (count($comments) > 0)
                <ul class="scrollbar-hide bg-black px-6 pb-[120px] h-[370px] space-y-4 font-caros rounded-lg overflow-y-auto">
                    @foreach ($comments as $comment)
                    <li style="box-shadow: 4px 4px 6px rgba(0, 0, 0, 0.1)" class="border border-gray-600 px-6 pt-4 pb-7 rounded-lg ">
                        <div class="flex items-center">
                            <img src="{{ Avatar::create($comment->user->name)->toBase64() }}" class="w-8 h-8" alt="">
                            <h1 class=" text-gray-100 text-[15px] pl-3">{{$comment->user->name}}</h1>
                        </div>

                        <div  class="pt-4 flex">
                            <h1 class="text-gray-300 text-[15px] pr-3">
                                {{$comment->rating}}
                                <i class="fas fa-star text-yellow-400"></i>
                            </h1>
                            <h1 class="text-gray-400 text-sm ">{{$comment->created_at->format('Y-m-d')}}</h1>
                        </div>
                        <div class="flex" >
                            <p class="pt-3 text-sm text-gray-300 break-all">{{ $comment->comment }}</p>
                        </div>
                    </li>
                    @endforeach
                    <div class="absolute w-full bg-gradient-to-t from-black to-transparent bottom-0 h-[120px]">a</div>
                </ul>
                @endif
            </div>
        </div>
        @else
        
        <div data-aos="fade-up" data-aos-duration="1200" data-aos-delay="700" class="w-full bg-black border border-gray-500 flex items-center rounded-md justify-center py-5 px-4">
            <h1 class="text-gray-200 text-xl flex items-center">
                Belum ada film dengan rating tertinggi
                <i class="fas fa-star text-yellow-500 ml-2"></i>
            </h1>
        </div>

        @endif  
    </div>
    <img src="{{asset('images/bg.webp')}}" class="absolute bottom-10 right-[-980px] w-[80%] z-[-5]" alt="">
</section>

<style>



</style>