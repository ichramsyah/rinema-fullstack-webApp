<header>
    <nav class="w-full md:py-1 py-1 fixed z-50">
        <div class="container">
            <div class="flex justify-between mx-auto px-4 md:px-16 items-center">
                <a href="{{route('home') }}" class="flex items-center">
                    <img src="{{ asset('images/logo-white.webp') }}" class="w-20 h-20 mr-1">
                </a>

                <ul class="flex absolute items-center right-2 md:right-16 font-caros text-sm space-x-4 md:space-x-10">
                        <li>
                            <a href="{{route('home')}}" class="hidden md:flex text-gray-200 hover:text-gray-200 transition-all duration-300 hover:text-gray-400">Home</a>
                        </li>
                        <li>
                            <a href="{{route('film')}}" class="hidden md:flex text-gray-200 hover:text-gray-200 transition-all duration-300 hover:text-gray-400">Film</a>
                        </li>
                @if (Route::has('login'))
                        @auth
                            <li>
                                <a href="{{ url('/profile') }}" class=" flex items-center px-6 py-2 rounded-sm bg-slate-800 transition-all duration-300 hover:bg-slate-700 text-gray-200 ">
                                    <i class="fas fa-user text-[10px] mr-2 "></i>
                                    {{ Str::limit(Auth::User()->name, 12) }}
                                </a>
                            </li>
                        @else
                            <li>
                                <a 
                                href="{{ route('login') }}" 
                                class="text-gray-200 hover:text-gray-400 transition-all duration-300"
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
                            </li>
                            @if (Route::has('register'))
                                <li>
                                    <a href="{{ route('register') }}" class="px-6 py-2 rounded-sm bg-slate-800 transition-all duration-300 hover:bg-slate-700 text-gray-200 "
                                    
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
                                        window.location.href = '{{ route('register') }}';
                                    })
                                    .catch(error => {
                                        console.error('Gagal menyimpan URL intended:', error);
                                        window.location.href = '{{ route('register') }}';
                                    });
                                    return false;"
                                    
                                    >Register</a>
                                </li>
                            @endif
                        @endauth
                        @endif
                    </ul>
            </div>
        </div>
    </nav>
</header>

<script>
    document.addEventListener("DOMContentLoaded", function () {
        const navbar = document.querySelector("nav");
        let lastScrollY = window.scrollY;
        let isScrolling;

        navbar.style.transition =
            "transform 0.3s ease, background-color 0.3s ease, box-shadow 0.3s ease";

        const handleScroll = () => {
            clearTimeout(isScrolling);

            if (window.scrollY > lastScrollY && window.scrollY > 10) {
                navbar.style.transform = "translateY(-60%)";
                navbar.style.backgroundColor = "rgba(0, 0, 0, 0.7)";
                navbar.style.backdropFilter = "blur(7px)";

                if (window.innerWidth < 480) {
                }
            } else {
                navbar.style.transform = "translateY(0)";

                navbar.style.backdropFilter = "blur(7px)";
                navbar.style.backgroundColor = "rgba(0, 0, 0, 0.7)";
                if (window.innerWidth < 480) {
                }
            }

            if (window.scrollY === 0) {
                navbar.style.backgroundColor = "transparent";
            }

            lastScrollY = window.scrollY;

            isScrolling = setTimeout(() => {
                navbar.style.transform = "translateY(0)";
            }, 100);
        };

        window.addEventListener("scroll", handleScroll);
    });
</script>
