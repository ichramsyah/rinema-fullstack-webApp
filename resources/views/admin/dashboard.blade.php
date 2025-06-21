<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="shortcut icon" href="{{ asset('images/logo-01.png') }}" type="image/x-icon">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" integrity="sha512-9usAa10IRO0HhonpyAIVpjrylPvoDwiPUiKdWk5t3PyolY1cOd4DSE0Ga+ri4AuTroPR5aQvXU9xC6qOPnzFeg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="https://fonts.googleapis.com/css2?family=Noto+Sans+KR:wght@100&family=Poppins:wght@400;500;600;700&family=Raleway:ital,wght@0,400;1,300&family=Wix+Madefor+Display&display=swap" rel="stylesheet">
    @vite('resources/css/app.css')
  </head>   
</head>
<body class="bg-gray-100 h-screen font-Nexa">



<div class="flex h-full">

    <div class="bg-white text-white flex flex-col">
        <div class="w-60 bg-white">
            <div class="text-center ml-[-9px] py-6">
                <h2 class="text-xl font-semibold text-red-600 flex items-center justify-center">
                    Dashboard
                </h2>
            </div>
        </div>
        <nav class="flex-grow  ">

            <div class="px-3 {{ request()->routeIs(['admin.users.tampil', 'admin.users.tambah', 'admin.users.edit']) ? 'border-l-4 border-red-500 w-58' : '' }}"> 
                <a 
                href="{{ route('admin.users.tampil') }}" 
                class="block py-3 px-7 font-[nexa] rounded-xl mb-1 transition-all text-gray-500 hover:text-red-500 text-[16px] font-bold items-center 
                {{ request()->routeIs(['admin.users.tampil', 'admin.users.tambah', 'admin.users.edit']) ? 'bg-red-200 text-red-500' : '' }}">
                    <i class="fas fa-users mr-1"></i> Users
                </a>
            </div>

            <div class="px-3 px-3 {{ request()->routeIs(['admin.films.tampil', 'admin.films.tambah', 'admin.films.edit']) ? 'border-l-4 border-red-500 w-58' : '' }} ">
                <a 
                href="{{ route('admin.films.tampil') }}"
                class="block py-3 font-[nexa] px-7 rounded-xl mb-1 transition-all text-gray-500 text-[16px] font-bold items-center hover:text-red-500 
                {{ request()->routeIs(['admin.films.tampil', 'admin.films.tambah', 'admin.films.edit']) ? 'bg-red-200 text-red-500' : '' }}">
                    <i class="fas fa-film mr-1"></i> Films
                </a>
            </div>

            <div class="px-3 {{request()->routeIs(['admin.genres.tampil', 'admin.genres.tambah']) ? 'border-l-4 border-red-500' : '' }}">
                <a 
                href="{{ route('admin.genres.tampil') }}"
                class="block py-3 font-[nexa] px-7 rounded-xl mb-1 transition-all text-gray-500 text-[16px] font-bold items-center hover:text-red-500 {{request()->routeIs(['admin.genres.tampil', 'admin.genres.tambah']) ? 'bg-red-200 text-red-500' : '' }}
                ">
                    <i class="fas fa-tags mr-1"></i> Genre
                </a>
            </div>

            <div class="px-3 {{request()->routeIs(['admin.filmgenre.tampil', 'admin.filmgenre.tambah' ,'admin.filmgenre.edit']) ? 'border-l-4 border-red-500' : '' }}">
                <a 
                href="{{ route('admin.filmgenre.tampil') }}"
                class="block py-3 font-[nexa] px-7 rounded-xl mb-1 transition-all text-gray-500 text-[16px] font-bold items-center hover:text-red-500 {{request()->routeIs(['admin.filmgenre.tampil','admin.filmgenre.tambah' ,'admin.filmgenre.edit']) ? 'bg-red-200 text-red-500' : '' }}
                ">
                    <i class="fas fa-tags mr-1"></i> Film Genre
                </a>
            </div>

            <div class="px-3 {{request()->routeIs(['admin.ratings.index', 'admin.ratings.create', 'admin.ratings.edit']) ? 'border-l-4 border-red-500' : '' }}">
                <a 
                href="{{ route('admin.ratings.index') }}"
                class="block py-3 font-[nexa] px-7 rounded-xl mb-1 transition-all text-gray-500 text-[16px] font-bold items-center hover:text-red-500 {{request()->routeIs(['admin.ratings.index', 'admin.ratings.create', 'admin.ratings.edit']) ? 'bg-red-200 text-red-500' : '' }}"
                >
                    <i class="fas fa-star mr-1"></i> Ratings
                </a>
            </div>

            <div class="px-3 {{request()->routeIs(['admin.forums.index', 'admin.forums.create', 'admin.forums.edit']) ? 'border-l-4 border-red-500' : '' }}">
                <a 
                href="{{ route('admin.forums.index') }}"
                class="block py-3 font-[nexa] px-7 rounded-xl mb-1 transition-all text-gray-500 text-[16px] font-bold items-center hover:text-red-500 {{ request()->routeIs(['admin.forums.index', 'admin.forums.create', 'admin.forums.edit']) ? 'bg-red-200 text-red-500' : '' }}"
                >
                    <i class="fas fa-comments mr-1"></i> Forums
                </a>
            </div>
            
            <div class="px-3 {{request()->routeIs(['admin.forumreply.index', 'admin.forumreply.edit', 'admin.forumreply.create']) ? 'border-l-4 border-red-500' : '' }}">
                <a 
                href="{{ route('admin.forumreply.index') }}"
                class="block py-3 font-[nexa] px-7 rounded-xl mb-1 transition-all text-gray-500 text-[16px] font-bold items-center hover:text-red-500 {{ request()->routeIs(['admin.forumreply.index', 'admin.forumreply.edit', 'admin.forumreply.create']) ? 'bg-red-200 text-red-500' : '' }}"
                >
                    <i class="fas fa-comments mr-1"></i> Forum Reply
                </a>
            </div>
        </nav>
    </div>

    <div class="flex-grow flex flex-col overflow-hidden ">
        <header class="bg-white shadow-md py-4 px-6 z-50">
            <div class="flex justify-between items-center ">
                <h1 class="text-xl font-semibold">
                    {{ isset($pageTitle) ? $pageTitle : 'Dashboard' }} Management
                   
                </h1>

                <div class="flex items-center">
                    @if(Auth::check())
                        <form method="post" action="{{ route('logout') }}">
                            @csrf
                            <button class="cursor-pointer text-gray-500 px-5 py-1 flex items-center justify-center">
                                <h1 class="font-bold">
                                <i class="fas fa-sign-out-alt"></i>   Logout
                                </h1>
                            </button>
                        </form>
                  
                    @endif
                </div>
                
            </div>
        </header>

        <main class="flex-grow overflow-y-auto">
            <div class="px-10 py-8">
                @yield('userkonten')
                @yield('usertambah')
                @yield('useredit')

                @yield('filmkonten')
                @yield('filmtambah')
                @yield('filmedit')

                @yield('genrekonten')
                @yield('genretambah')
                @yield('genreedit')

                @yield('filmgenrekonten')
                @yield('filmgenretambah')
                @yield('filmgenreedit')

                @yield('ratingkonten')
                @yield('ratingcreate')
                @yield('ratingedit')

                @yield('forumkonten')
                @yield('forumcreate')
                @yield('forumedit')

                @yield('forumreplykonten')
                @yield('forumreplycreate')
                @yield('forumreplyedit')
            </div>
        </main>
    </div>

</div>

</body>
<style>
    *{
        font-family: 'Nexa';
    }

/* Untuk scrollbar secara keseluruhan */
::-webkit-scrollbar {
    width: 6px; /* Lebar scrollbar */
    height: 6px;
}

/* Untuk track scrollbar (latar belakang) */
::-webkit-scrollbar-track {
  background:rgb(243, 244, 246); /* Warna latar belakang track */
}

/* Untuk thumb scrollbar (bagian yang digeser) */
::-webkit-scrollbar-thumb {
  background:rgb(255, 168, 168); /* Warna thumb */
  border-radius: 6px; /* Bentuk thumb (opsional) */
}

/* Untuk thumb saat di-hover */
::-webkit-scrollbar-thumb:hover {
  background: rgb(253, 123, 123); /* Warna thumb saat di-hover */
}
</style>


</html>