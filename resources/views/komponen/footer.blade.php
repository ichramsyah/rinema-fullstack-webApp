<footer>
    <div class="box-footer pt-16">
        <div class="box-item flex justify-between md:px-12 px-6 py-4 items-center ">
            <a href="{{route('home')}}">
                <img src="{{ asset('images/logo-white.webp') }}" class="w-20 h-20" alt="">
            </a>
            <div class="flex gap-2">
                <a href="#" class="hover:-translate-y-2 ease-out duration-500 transform sticky">
                    <i class="fab fa-instagram text-2xl px-2 py-1 text-gray-100"></i>
                </a>
                <a href="#" class="hover:-translate-y-2 ease-out duration-500 transform sticky">
                    <i class="fab fa-youtube text-2xl px-2 py-1 text-gray-100 hover:text-red-500"></i>
                </a>
                <a href="#" class="hover:-translate-y-2 ease-out duration-500 transform sticky">
                    <i class="fab fa-facebook text-2xl px-2 py-1 text-gray-100 hover:text-blue-600"></i>
                </a>
                <a href="#" class="hover:-translate-y-2 ease-out duration-500 transform sticky">
                    <i class="fab fa-twitter text-2xl px-2 py-1 text-gray-100 hover:text-blue-400"></i>
                </a>
            </div>
        </div>
    
        <ul class="flex items-center justify-center font-caros gap-8 py-8">
        <li>
            <a href="{{ route('home') }}" class="text-[16px] text-gray-200 transition-all">Home</a>
        </li>
        <li>
            <a href="{{ route('film') }}" class="text-[16px] text-gray-200 transition-all">Film</a>
        </li>
            @if (Route::has('login'))
            @auth
                <li>
                    <a href="{{ url('/dashboard') }}" class="text-[16px] transition-all text-gray-100">
                    Profile
                    </a>
                </li>
            @else
                <li>
                    <a href="{{ route('login') }}" class="text-[16px] transition-all hover:text-gray-200 text-gray-100">Login</a>
                </li>
                @if (Route::has('register'))
                    <li>
                        <a href="{{ route('register') }}" class="text-[16px] transition-all hover:text-gray-200 text-gray-100">Register</a>
                    </li>
                @endif
            @endauth
            @endif
        </ul>
        <div class="text-center">
            <p class="md:text-sm text-sm text-gray-100 pb-6">Copyright &copy; 2025 - Rinema. All right reversed</p>
        </div>
    </div>
    @include('komponen.navbottom')
</footer>

<script>
// navbottom.blade.php
// Navbar Bottom

document.addEventListener("DOMContentLoaded", function () {
    const navBottom = document.getElementById("nav-bottom");
    let lastScrollY = window.scrollY;

    navBottom.style.transition =
        "transform 0.3s ease, background-color 0.3s ease, box-shadow 0.3s ease";

    const handleScrollBottom = () => {
        if (window.scrollY > lastScrollY) {
            navBottom.style.transform = "translateY(120%)";
            navBottom.style.backgroundColor = "bg-black";
        } else {
            navBottom.style.transform = "translateY(0)";
            navBottom.style.backgroundColor = "bg-black";
        }

        lastScrollY = window.scrollY;
    };

    window.addEventListener("scroll", handleScrollBottom);
});

</script>