<nav id="nav-bottom" class="fixed bottom-3 left-3 right-3 bg-black opacity-90 rounded-full shadow-lg sm:flex md:hidden z-50 font-caros">
    <div class="container px-4 py-1">
        <div class="flex justify-around items-center">
            <a href="{{ route('home') }}" class="flex flex-col items-center py-1 px-4 rounded-full transition-colors duration-300 {{ request()->routeIs('home') ? 'bg-gray-200 text-slate-800' : 'text-gray-200' }}">
                <i class="fas fa-home text-lg"></i>
            </a>
            <a href="{{ route('film') }}" class="flex flex-col items-center py-1 px-4 rounded-full transition-colors duration-300 {{ request()->routeIs('film', 'detail.film') ? 'bg-gray-200 text-slate-800' : 'text-gray-200' }}">
                <i class="fas fa-film text-lg"></i>
            </a>
        </div>
    </div>
</nav>

