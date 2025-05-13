@extends('index')

@section('detailfilm')

<section class="font-caros pt-6">
    <a href="{{route('film')}}" class="text-gray-200 flex items-center" ><i class="fas fa-arrow-left text-[12px] pr-1"></i> Back</a>
    <h1 class="py-4 text-gray-200 text-3xl">Detail Film</h1>

    <div class="flex gap-6 flex-wrap-reverse md:flex-nowrap">
        <div class="md:w-1/2 w-full">
            <iframe class="w-full rounded-xl md:h-full h-[260px]" src="{{$film->trailer}}" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" referrerpolicy="strict-origin-when-cross-origin" allowfullscreen></iframe>
        </div>
        <div class="flex gap-5 md:w-1/2">
            <img src="{{$film->poster}}" alt="{{$film->judul}}" class="rounded-md md:h-[340px] h-[240px]">
            <div>
                <h1 class="text-gray-200 text-xl">{{$film->judul}}</h1>
                <div class="flex py-3 md:gap-3 gap-2 flex-wrap">
                @foreach($genreNames as $genre)
                        <p class="text-gray-400">{{$genre}}</p>
                @endforeach
                </div>
                <div class="flex gap-4 text-gray-400 text-[12px]">
                    <p>{{$film->durasi}} Menit</p>
                    <p>{{$film->usia}}</p>
                    <p>{{Carbon\Carbon::parse($film->tahun_rilis)->format('d F Y')}}</p>
                </div>
                <p class="text-gray-200 pt-4">
                    @if($averageRatings > 0)
                        {{ number_format($averageRatings, 1) }}
                        <i class="fas fa-star text-yellow-500"></i>
                    @else
                        <p class="text-gray-300 text-[14px]">
                            Belum Ada Rating
                            <i class="fas fa-star text-yellow-500"></i>
                        </p>
                        @endif
                </p>
            </div>
        </div>
    </div>

    <div class="flex gap-2 pt-6 font-caros">
        <button id="default-btn" class="px-2 py-1 border-b-2 border-black text-gray-200 hover:text-text-gray-200 transition-all active">Forum</button>
        <button id="div2-btn" class="px-2 py-1 border-b-2 border-transparent text-gray-400 hover:text-gray-200 transition-all">Ratings</button>
        <button id="div3-btn" class="px-2 py-1 border-b-2 border-transparent text-gray-400 hover:text-gray-200 transition-all">Detail</button>
    </div>

    <!-- Forum -->
    <div class="div1 mt-4 relative ">
    @if ($forums->isNotEmpty())
        @foreach ($forums as $forum)
            <ul class="scrollbar-hide pb-[70px] h-[350px] overflow-x-hidden overflow-y-auto md:w-[60%] w-full space-y-5 ">
                @if ($forum->forumReplies->isNotEmpty())
                    @foreach($forum->forumReplies as $reply)
                        <li class="px-6 bg-black border border-gray-500 py-6 rounded-lg relative">
                            <div class="flex items-center font-caros">
                                <img src="{{ Avatar::create($reply->user->name)->toBase64() }}" class="w-8 h-8" alt="">
                                <h1 class=" text-gray-200 text-[17px] pl-3">{{$reply->user->name}}</h1>
                            </div>
                            <h1 class="pt-4 pb-5  text-sm font-caros text-gray-400">  {{$reply->created_at->diffForHumans()}}
                            </h1>
                            <h1 class="font-caros text-gray-200 pb-4" style="word-wrap: break-word;">{{$reply->body}}</h1>

                            @if (Auth::check() && Auth::id() === $reply->user_id)
                            <div class="absolute top-3 right-4">
                                <div class="relative">


                                    <button onclick="toggleDropdown('{{ $reply->id }}')" class="text-gray-200 hover:text-gray-400">
                                        <i class="fas fa-ellipsis-v px-3 py-3 text-[16px]"></i>
                                    </button>

                                    <div id="dropdown-{{ $reply->id }}" class="absolute right-0 w-32 bg-gray-800 rounded-lg shadow-lg hidden">
                                        <button class="block w-full text-left px-4 py-2 pt-3 hover:bg-gray-900 text-gray-200 rounded-t-lg" onclick="showEditForm('{{ $reply->id }}')">
                                            Edit
                                        </button>
                                        <form action="{{ route('forum.reply.delete', ['replyId' => $reply->id]) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="block w-full text-left hover:bg-gray-900 rounded-b-lg px-4 py-2 pb-3 text-gray-200 ">
                                                Hapus
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            @endif

                            <form id="editForm{{ $reply->id }}" action="{{ route('forum.reply.update', ['replyId' => $reply->id]) }}" method="POST" class="mt-4 hidden">
                                @csrf
                                @method('PUT')
                                <textarea name="body" class="w-full p-2 border rounded-md focus:ring-transparent resize-none focus:outline-none font-caros bg-black border border-gray-500 text-gray-200" required>{{ $reply->body }}</textarea>
                                <button type="submit" class="mt-2 px-4 py-2 bg-gray-800 text-gray-200 rounded-md">Simpan</button>
                            </form>
                        </li>
                    @endforeach
                @else
                    <li class="px-6 bg-black border border-gray-500 py-4 rounded-lg text-gray-400 text-center"><i>Belum ada komentar di forum ini</i></li>
                @endif
            </ul>
        @endforeach

        <div class="bg-gradient-to-t from-black to-transparent h-[90px] absolute bottom-[80px] md:w-[60%] w-full">

        </div>
        @if (Auth::check())
            <div class="bg-black md:w-[60%] w-full py-3 ">
                <div class="bg-black border border-gray-500 flex items-center px-3 py-3 rounded-full">
                    <img src="{{ Avatar::create($user->name)->toBase64() }}" class="w-9 h-9 mt-[-3px]">
                    <form action="{{ route('forum.reply.store', ['id' => $film->id]) }}" method="POST" class="w-full flex items-center justify-between">
                        @csrf
                        <textarea name="body" placeholder="Berikan komentar..." class="w-full bg-black border-none text-gray-200 h-6 pl-3 pr-6 focus:ring-transparent resize-none focus:outline-none mt-[-3px]" required></textarea>
                        <button type="submit">
                            <i class="fas fa-paper-plane hover:text-blue-500 transition-all px-3 text-xl text-gray-300 mt-[-3px]"></i>
                        </button>
                    </form>
                </div>
                @else
                <div class="flex md:w-[60%] bg-black w-full text-center bg-black py-3">
                    <a href="{{ route('login') }}"
                        class="w-full border border-gray-500 rounded-full py-4 text-gray-200 transition-all hover:bg-gray-900"
                        onclick="event.preventDefault();
                                     fetch('/save-intended-url', {
                                         method: 'POST',
                                         headers: {
                                             'Content-Type': 'application/json',
                                             'X-CSRF-TOKEN': '{{ csrf_token() }}'
                                         },
                                         body: JSON.stringify({ intended_url: window.location.pathname })
                                     })
                                     .then(response => {
                                         window.location.href = '{{ route('login') }}';
                                     })
                                     .catch(error => {
                                         console.error('Gagal menyimpan URL intended:', error);
                                         window.location.href = '{{ route('login') }}';
                                     });
                                     return false;">
                        Login
                    </a>
                </div>
                @endif
            @else
            <p class="text-gray-200 w-full bg-black border border-gray-500 p-4 rounded-lg">Forum belum dibuat</p>
            @endif
        </div>
    </div>

    <!-- Rating -->
    <div class="div2 mt-4 flex flex-wrap md:flex-nowrap md:gap-4 gap-3 hidden">
        <div class="md:w-2/3 w-full relative">
            <ul class="scrollbar-hide space-y-4 md:h-[530px] h-[400px] overflow-y-auto pb-[120px] relative">
                @if($ratings->isNotEmpty())
                @foreach($ratings as $rating)
                <li class="bg-black border border-gray-500 rounded-md px-6 py-6">
                    <div class="flex items-center">
                        <img src="{{ Avatar::create($rating->user->name)->toBase64() }}" alt="" class="w-8 h-8">
                        <h1 class="text-gray-200 pl-3 text-[17px]">{{$rating->user->name}}</h1>
                    </div>
                    <div class="flex items-center py-5">
                        <p class="text-gray-200 text-md">
                            {{$rating->rating}}
                            <i class="fas fa-star text-yellow-500"></i>
                        </p>
                        <p class="text-[14px] text-gray-400 pl-4">{{Carbon\Carbon::parse($rating->created_at)->format('d F Y')}}</p>
                    </div>
                    <div>
                        @if($rating->comment != null )
                        <p class="text-gray-200" style="word-wrap: break-word;">{{$rating->comment}}</p>
                        @else
                        <p class="text-gray-500">( Tidak memberikan komentar )</p>
                        @endif
                    </div>
                </li>
                @endforeach
                
                @else
                
                <div class="w-full flex bg-black border border-gray-500 rounded-lg">
                    <p class="text-gray-400 p-6"><i>Film ini belum memiliki Rating</i></p>
                </div>
                @endif
            </ul>
            <div class="absolute md:bottom-0 bottom-0 w-full bg-gradient-to-t from-black to-transparent md:h-[120px] h-[140px]"></div>
        </div>

        @if(Auth::check())
        @if ($userHasRated)
        <div class="bg-black border border-gray-500 rounded-lg p-6 md:w-1/3 w-full h-[150px] text-caros">
            <p class="text-gray-200">
                Terimakasih telah memberikan rating pada film ini!
                <i class="fas fa-star text-yellow-500"></i>
            </p>

            <form action="{{ route('film.rating.destroy', ['ratingId' => $userHasRated->id]) }}" method="POST" class="mt-4">
                @csrf
                @method('DELETE')
                <button type="submit" class="text-gray-100 text-[14px]  bg-gray-800 px-5 py-2 rounded-sm">Hapus Rating</button>
            </form>
            
        </div>
        @else
        <div class="bg-black border border-gray-500 rounded-lg p-6 md:w-1/3 w-full h-[330px] text-caros">
            <div class="flex items-center">
                <img src="{{ Avatar::create($user->name)->toBase64() }}" alt="" class="w-9 h-9">
                <h1 class="text-gray-200 text-md pl-3">{{$user->name}}</h1>
            </div>
            <form action="{{ route('film.rating.store', ['id' => $film->id] ) }}" class="text-caros" method="POST">
                @csrf
                <div class="flex items-center py-4">
                    <input type="number" step="any" name="rating" id="rating" min="0" max="10" required class="h-6 w-12 bg-black border border-gray-500 text-gray-200 text-center rounded-sm focus:ring-transparent focus:outline-none">
                    <p class="text-gray-200 pl-2">/ 10</p><i class="fas fa-star text-yellow-500 pl-1"></i>
                </div>
                <textarea name="comment" placeholder="Berikan Komentar (opsional)" id="comment" class="w-full h-[120px] mt-1 bg-black border border-gray-500 rounded-md resize-none focus:outline-none focus:ring-transparent text-gray-200 text-sm px-3 pt-2"></textarea>

                <button type="submit" class="px-6 py-1 bg-gradient-to-r from-blue-700 to-blue-500 text-gray-200 text-md rounded-sm mt-4">Kirim</button>
            </form>
            @endif
        </div>
        @else
        <div class="bg-black border border-gray-500 h-[84px] rounded-lg md:w-1/2 w-full">
            <div class="p-4 flex">
                <a 
                href="{{route('login')}}" 
                class="bg-gradient-to-r from-blue-600 to-blue-400 w-full rounded-lg text-center py-3 text-gray-100"  
                onclick="event.preventDefault();
                                fetch('/save-intended-url', {
                                    method: 'POST',
                                    headers: {
                                        'Content-Type': 'application/json',
                                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                                    },
                                    body: JSON.stringify({ intended_url: window.location.pathname })
                                })  
                                .then(response => {
                                    window.location.href = '{{ route('login') }}';
                                })
                                .catch(error => {
                                    console.error('Gagal menyimpan URL intended:', error);
                                    window.location.href = '{{ route('login') }}';
                                });
                                return false;"
                >Login</a>
            </div>
        </div>
        @endif
    </div>

    <!-- Sinopsis -->
    <div class="div3 mt-4 hidden flex justify-start">
        <div class="md:w-1/2 w-full break-all px-7 py-5 pb-7 bg-black border border-gray-500 font-caros space-y-6 rounded-md">
            <div class="space-y-1">
                <strong class="text-gray-200">Sinopsis</strong>
                <p class="text-gray-400 text-[15px]">{{$film->sinopsis}} </p>
            </div>
            <div class="space-y-1">
                <strong class="text-gray-200">Produser</strong>
                <p class="text-gray-400 text-[15px]">{{$film->produser}}</p>
            </div>
            <div class="space-y-1">
                <strong class="text-gray-200">Sutradara</strong>
                <p class="text-gray-400 text-[15px]">{{$film->sutradara}}</p>
            </div>
            <div class="space-y-1">
                <strong class="text-gray-200">Penulis</strong>
                <p class="text-gray-400 text-[15px]">{{$film->penulis}}</p>
            </div>
            <div class="space-y-1">
                <strong class="text-gray-200">Production</strong>
                <p class="text-gray-400 text-[15px]">{{$film->produksi}}</p>
            </div>
            <div class="space-y-1">
                <strong class="text-gray-200">Pemeran</strong>
                <p class="text-gray-400 text-[15px]">{{$film->pemeran}}</p>
            </div>
        </div>
    </div>

    <div id="notification-container" class="fixed bottom-5 right-[-90px] transform -translate-x-1/2 bg-gray-800 text-white py-4 px-8 rounded-md shadow-lg z-50 opacity-0 transition-opacity duration-300">
        <p id="notification-message">
            <i class="fas fa-check text-white"></i>
        </p>
    </div>

    <div id="error-notification-container" class="fixed bottom-[20px] right-[-120px] transform -translate-x-1/2 bg-red-500 text-white py-4 px-8 rounded-md shadow-lg z-50 opacity-0 transition-opacity duration-300">
        <p id="error-notification-message"></p>
    </div>

</section>


<script>
  document.addEventListener('DOMContentLoaded', function() {
  const buttons = {
    'default-btn': '.div1',
    'div2-btn': '.div2',
    'div3-btn': '.div3',
  };
  const divs = document.querySelectorAll('div[class^="div"]');

  Object.keys(buttons).forEach(buttonId => {
    const button = document.getElementById(buttonId);
    button.addEventListener('click', function() {
      const divToShow = document.querySelector(buttons[this.id]);

      divs.forEach(div => {
        div.classList.add('hidden');
      });

      if (divToShow) {
        divToShow.classList.remove('hidden');
      }

      // Tambahkan/Hapus class active
      Object.keys(buttons).forEach(btnId => {
        const currentBtn = document.getElementById(btnId);
        if (btnId === this.id) {
          currentBtn.classList.add('text-gray-200');
          currentBtn.classList.remove('text-gray-400');
        } else {
          currentBtn.classList.remove('text-gray-200');
          currentBtn.classList.add('text-gray-400');
        }
      });
    });
  });
});

function toggleDropdown(replyId) {
        // Ambil dropdown yang sesuai dengan ID
        const dropdown = document.getElementById(`dropdown-${replyId}`);

        // Sembunyikan semua dropdown lain sebelum membuka yang ini
        document.querySelectorAll("[id^='dropdown-']").forEach(el => {
            if (el !== dropdown) el.classList.add("hidden");
        });

        // Toggle visibilitas dropdown
        dropdown.classList.toggle("hidden");
    }

    // Tutup dropdown jika klik di luar
    document.addEventListener("click", function(event) {
        if (!event.target.closest(".relative")) {
            document.querySelectorAll("[id^='dropdown-']").forEach(el => el.classList.add("hidden"));
        }
    });

    function showEditForm(replyId) {
        const editForm = document.getElementById('editForm' + replyId);
        editForm.classList.toggle('hidden');
    }

    const notificationContainer = document.getElementById('notification-container');
        const notificationMessage = document.getElementById('notification-message');
        const errorNotificationContainer = document.getElementById('error-notification-container');
        const errorNotificationMessage = document.getElementById('error-notification-message');

        // Fungsi untuk menampilkan notifikasi sukses (dengan animasi fade-in)
        function showSuccessNotification(message) {
            notificationMessage.textContent = message;
            notificationContainer.classList.remove('opacity-0');
            setTimeout(() => {
                notificationContainer.classList.add('opacity-0');
            }, 3000); // Sembunyikan setelah 3 detik
        }

        // Fungsi untuk menampilkan notifikasi error (dengan animasi fade-in)
        function showErrorNotification(message) {
            errorNotificationMessage.textContent = message;
            errorNotificationContainer.classList.remove('opacity-0');
            setTimeout(() => {
                errorNotificationContainer.classList.add('opacity-0');
            }, 3000); // Sembunyikan setelah 3 detik
        }

        // Cek apakah ada pesan sukses atau error dari sesi Laravel
        const successMessage = "{{ session('success') }}";
        const errorMessage = "{{ session('error') }}";

        if (successMessage) {
            showSuccessNotification(successMessage);
        }

        if (errorMessage) {
            showErrorNotification(errorMessage);
        }
</script>


<style>
        /* Custom scrollbar-hide */
.scrollbar-hide::-webkit-scrollbar {
  display: none;
}
.scrollbar-hide {
  -ms-overflow-style: none; /* IE and Edge */
  scrollbar-width: none;    /* Firefox */
}

input[type="number"]::-webkit-outer-spin-button,
input[type="number"]::-webkit-inner-spin-button {
    -webkit-appearance: none;
    margin: 0;
}
input[type="number"] {
    -moz-appearance: textfield;
    appearance: textfield;
}



</style>
</section>


@endsection