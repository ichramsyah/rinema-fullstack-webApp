<section class="film-terbaru md:px-16">
    <div class="flex justify-between  items-center">
        <h1 data-aos="fade-right" data-aos-duration="700"  class="text-gray-200 pb-2 font-caros text-2xl md:text-3xl"> 
            Film terbaru
        </h1>
        <div data-aos="fade-left" data-aos-duration="1000" data-aos-delay="100" class="flex items-center font-caros">
            <a href="{{route('film')}}" class=" text-sm md:text-xl pr-2 text-gray-200 ">Lihat semua</a>
        </div>
    </div>
    <!-- Swiper Container -->
    <div class="relative z-10">
        <div class="swiper filmSwiper mt-4">
            <ul data-aos="fade-up" data-aos-duration="1000" data-aos-delay="100" class="swiper-wrapper">
                @foreach ($latestFilms as $film)
                <li class="swiper-slide font-caros">
                    <div class="relative bg-gray-800 h-[370px] md:h-54 w-42 rounded-lg z-10 overflow-hidden">
                        <img src="{{ $film->poster }}" class="w-full h-[380px] object-cover">
                        <div class="hover-effect absolute bg-gradient-to-t from-black via-black/80 to-transparent h-[460px] z-20 bottom-0 left-0 right-0 top-140 text-center">
                            <div class="absolute space-x-2  text-[12px] justify-center flex bottom-0 right-0 left-0 bottom-[80px]">
                                <a href="{{ route('detailfilm', ['id' => $film->id]) }}" class="space-x-2 text-gray-200 font-caros text-xl/6 justify-center flex bottom-0 right-0 left-0 bottom-4 px-4">{{$film->judul}}</a>
                               
                            </div>
                            <div class="absolute font-caros text-[11px] justify-center space-x-4 flex flex-wrap right-0 left-0 bottom-[50px]">
                                <h1 class="text-gray-400 rounded-lg">{{$film->usia}}</h1>
                                <h1 class="text-gray-400 rounded-lg">{{$film->durasi}} menit</h1>
                                <h1 class="text-gray-400 rounded-lg">{{ Carbon\Carbon::parse($film->tahun_rilis)->format('d F Y') }}
                                    </div>
                            <h1 class="absolute bottom-[30px] right-0 left-0 text-[11px] text-gray-400">{{$film->genres}}</h1>
                           
                            
                        </div>
                    </div>
                </li>
                @endforeach
                <li class="swiper-slide font-caros">
                    <div class="relative h-[370px] md:h-54 w-42 rounded-lg z-10 flex items-center justify-center overflow-hidden group">
                        <!-- Background Image -->
                        <div class="absolute inset-0 bg-cover bg-center before:absolute before:inset-0 before:bg-black/70" style="background-image: url('https://m.media-amazon.com/images/M/MV5BNTFiYjVmY2QtOGU0Ni00YTBhLThkYzgtYWVmODg1NDBjMDE0XkEyXkFqcGc@._V1_FMjpg_UX1000_.jpg');"></div>

                            <!-- Konten -->
                            <a href="{{route('film')}}" class="relative z-10 py-20 flex flex-col items-center text-white">
                                <h1 class="mt-2 text-lg group-hover:text-gray-300 transition-all duration-300">Lihat Semua</h1>
                        </a>
                    </div>
                </li>
                
                
            </ul>
        </div>
        
        <div id="swiper-hover" class="w-full flex mt-[-180px] justify-between">
            <i class="swiper-prev z-30  md:mx-[-70px] mx-[-20px] fas fa-chevron-left transition-all duration-300 text-white rounded-full bg-gray-800 hover:bg-gray-900 px-4 py-3 font-sm"></i>
            <i class="swiper-next z-30  md:mx-[-70px] mx-[-20px] fas fa-chevron-right transition-all duration-300 text-white rounded-full bg-gray-800 hover:bg-gray-900 px-4 py-3 font-sm"></i>
        </div>
    </div>

    
   
</section>

