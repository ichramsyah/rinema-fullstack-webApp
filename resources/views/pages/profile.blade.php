@extends('index')

@section('profile')
<div class="flex justify-between items-center py-10">
    <h1 class="text-gray-200 md:text-4xl text-3xl font-caros w-3/4 pr-[10px] break-all">Hai {{Auth::user()->name}}!</h1>
    <form action="{{route('logout')}}" method="POST">
        @csrf
        <button type="submit" class="text-red-500 md:text-xl text-sm">
            <i class="fas fa-sign-out-alt"></i>
            Logout
        </button>
    </form>
</div>
                    
<div class="w-full bg-black border border-gray-500 rounded-[10px] md:py-8 py-4 md:px-9 px-6 font-caros">
    <!-- Profile -->
    <div class="pb-5">
        <h1 class="text-gray-200 md:text-2xl text-xl">Profile Update</h1>
        <p class="text-gray-400 pt-2 md:text-md text-sm ">Perbarui informasi nama dan alamat email anda.</p>
    </div>

    <form action="{{route('profile.update')}}" method="POST" class="md:w-1/2 w-full">
        @csrf

        <div class="grid space-y-3 mt-4">
            <label for="name" class="text-gray-300">Nama</label>
            <input id="name" name="name" type="text" value="{{ Auth::user()->name ?? '' }}" class="bg-black border border-gray-500 px-3 h-9 rounded-md focus:ring-transparent focus:outline-none focus:border-gray-500 text-gray-200">
        </div>
        <div class="grid space-y-3 mt-4">
            <label for="email" class="text-gray-300">Email</label>
            <input id="email" name="email" type="email" value="{{ Auth::user()->email ?? '' }}" class="bg-black px-3 h-9 border border-gray-500 rounded-md focus:ring-transparent focus:outline-none focus:border-gray-500 text-gray-200">
        </div>
        @error('email')
            <p class="text-red-500 text-xs italic">{{ $message }}</p>
        @enderror

       

        <button type="submit" class="mt-7 px-7 py-2 text-white bg-gradient-to-r from-blue-700 to-blue-400 rounded-md text-center">
            Update
        </button>
    </form>

    <!-- Password -->
    <div class="pb-5 pt-12">
        <h1 class="text-gray-200 md:text-2xl text-xl">Password Update</h1>
        <p class="text-gray-400 pt-2 md:text-md text-sm md:w-[400px]">Pastikan akun Anda menggunakan kata sandi yang panjang dan acak agar tetap aman.</p>
    </div>

    <form action="{{ route('password.confirm') }}" method="POST" class="md:w-1/2 w-full">
        @csrf
        <div class="grid space-y-3 mt-4">
            <label for="password" class="text-gray-300">Password Saat ini</label>
            <input id="password" name="password" type="password" class="bg-black px-3 h-9 border border-gray-500 rounded-md focus:ring-transparent focus:outline-none focus:border-gray-500 text-gray-200 @error('password') border-red-500 @enderror">
            @error('password')
                <p class="text-red-500 text-xs italic">{{ $message }}</p>
            @enderror
        </div>
        <div class="grid space-y-3 mt-4">
            <label for="current_password" class="text-gray-300">Password Baru</label>
            <input id="current_password" name="current_password" type="password" class="bg-black px-3 h-9 border border-gray-500 rounded-md focus:ring-transparent focus:outline-none focus:border-gray-500 text-gray-200 @error('current_password') border-red-500 @enderror">
            @error('current_password')
                <p class="text-red-500 text-xs italic">{{ $message }}</p>
            @enderror
        </div>


        <div class="grid space-y-3 mt-4">
            <label for="password_confirmation" class="text-gray-300">Konfirmasi Password Baru</label>
            <input id="password_confirmation" name="password_confirmation" type="password" class="bg-black px-3 h-9 border border-gray-500 rounded-md focus:ring-transparent focus:outline-none focus:border-gray-500 text-gray-200 @error('password_confirmation') border-red-500 @enderror">
            @error('password_confirmation')
                <p class="text-red-500 text-xs italic">{{ $message }}</p>
            @enderror
        </div>

        <button type="submit" class="mt-7 px-7 py-2 text-white bg-gradient-to-r from-blue-700 to-blue-400 rounded-md text-center">
            Update
        </button>
    </form>

    <!-- Rating -->
    <div class="pb-8 pt-12">
        <h1 class="text-gray-200 md:text-2xl text-xl">Rating Update</h1>
        <p class="text-gray-400 pt-2 md:text-md text-sm md:w-[400px]">Perbarui informasi rating yang sudah anda berikan.</p>
    </div>
    

    <div id="data-container" class="space-y-5">
        @forelse ($ratedFilms as $film)
        <div class="data-item flex md:flex-nowrap flex-wrap bg-black border border-gray-500 rounded-lg p-5 md:gap-3 gap-6">
            <div class="md:w-1/2 w-full flex">
                <img src="{{$film->poster}}" class="w-[40%] rounded-md">
                <div class="w-full md:pl-5 pl-3">
                    <h1 class="md:text-xl text-md text-gray-200 ">{{$film->judul}}</h1>
                    <p class="pt-3 text-gray-400 md:text-[13px] text-sm">{{$film->genres ?? 'Genre Tidak Tersedia'}}</p>
                    <div class="w-full pt-4 md:gap-7 gap-6 flex text-gray-400 md:text-[13px] text-[12px]">
                        <p>{{$film->durasi}}</p>
                        <p>{{$film->usia}}</p>
                        <p>{{Carbon\Carbon::parse($film->tahun_rilis)->format('d F Y')}}</p>
                    </div>
                </div>
            </div>
            <div class="relative md:w-1/2 w-full bg-gray-black border border-gray-500 rounded-lg md:p-5 p-5">
                <div class="flex items-center">
                    <img src="{{ Avatar::create($user->name)->toBase64() }}" class="md:w-9 md:h-9 w-8 h-8" alt="">
                    <h1 class="text-gray-200 pl-3 text-md">Anda</h1>
                </div>
                <form action="{{ route('profile.rating.update', $film->id) }}" method="POST">
                    @csrf
                    <div class="flex items-center pt-5 text-white">
                        <input type="number" step="0.1" name="rating" value="{{$film->user_rating}}" class="h-7 w-14 bg-black text-white border border-gray-500 rounded-md focus:ring-transparent focus:border-gray-500 focus:outline-none text-center" min="0" max="10" >
                        <p class="pl-2 text-gray-300">/10</p>
                        <i class="fas fa-star text-yellow-500 pl-1"></i>
                        <p class="pl-4 md:text-sm text-[13px] text-gray-500"> {{$film->created_at->diffForHumans()}} </p>
                    </div>
                    <textarea name="comment" class="w-full h-[90px] text-[15px] p-3 bg-black text-white mt-5 border border-gray-500 rounded-md focus:ring-transparent focus:border-gray-500 focus:outline-none resize-none"> {{$film->user_comment ?? ''}} </textarea>
                    <button type="submit" class="md:px-6 px-5 md:py-2 py-2 md:text-md text-[14px] mt-4 md:mb-0 mb-3 text-center rounded-md text-white bg-gray-800">Update</button>
                </form>
                <form action="{{route('profile.rating.destroy', $film->id) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="absolute md:top-5 md:right-5 top-4 right-4">
                        <i class="fas fa-trash text-white bg-red-600 md:px-3 md:py-3 px-2 py-2 rounded-full md:text-[14px] text-[12px] transition-all hover:bg-red-700"></i>
                    </button>
                </form>
            </div>
        </div>
        @empty
        <p class="text-gray-400 text-sm"><i>Anda belum memberikan rating</i></p>
        @endforelse
        
        <div class="w-full flex justify-center pt-3">
            <button id="load-more-btn" class="text-white text-[17px]">
                <p>Tampilkan Lebih Banyak</p>
                <i class="fas fa-chevron-down pr-2"></i>
            </button>
        </div>
    </div>


    <!-- Forum -->
    <div class="pb-8 pt-12">
        <h1 class="text-gray-200 md:text-2xl text-xl">Forum Reply Update</h1>
        <p class="text-gray-400 pt-2 md:text-md text-sm md:w-[400px]">Perbarui informasi komentar foum yang sudah anda berikan.</p>
    </div>

    <div id="data-container2" class="grid md:grid-cols-2 grid-cols-1 gap-4">
        @forelse($userForumReplies as $reply)
        <div class="data-item2 bg-black border border-gray-500 rounded-md p-6 relative">
            <div class="flex items-center">
                <img src="{{ Avatar::create($user->name)->toBase64() }}" class="w-8 h-8" alt="">
                <h1 class="text-gray-200 text-[18px] pl-3">Anda</h1>
            </div>
            <div class="flex items-center md:text-[14px] text-[12px] pt-5">
                <p class="text-gray-400">{{$reply->created_at->diffForHumans()}}</p>
                <p class="text-gray-200 px-3">-</p>
                <p class="text-gray-200">{{$reply->filmName}}</p>
            </div>
            <form action="{{route('profile.replies.destroy', $reply->id)}}" method="POST">
                @csrf
                @method('DELETE')
                <button type="submit">
                    <i class="fas fa-trash absolute px-2 py-2 text-[14px] rounded-full text-white bg-red-600 hover:bg-red-700 transition-all top-5 right-5"></i>
                </button>
            </form>
            <form action="{{ route('profile.replies.update', $reply->id) }}" method="POST">
                @csrf
                <textarea name="body" id="body" class="w-full h-[120px] text-[15px] p-3 bg-black text-white border border-gray-500 rounded-md focus:ring-transparent focus:border-gray-500 focus:outline-none resize-none"> {{$reply->body}} </textarea>
                <button type="submit" class="md:px-6 px-5 md:py-2 py-2 md:text-md text-[14px] mt-4 text-center rounded-md text-white bg-gray-800">Update</button>
            </form>
        </div>
        @empty
        <p class="text-gray-400 text-sm"><i>Anda belum membuat komentar</i></p>
        @endforelse
    </div>
    <div class="w-full flex justify-center pt-7">
        <button id="load-more-btn2" class="text-white text-[17px]">
            <p>Tampilkan Lebih Banyak</p>
            <i class="fas fa-chevron-down pr-2"></i>
        </button>
    </div>
    
    <!-- Delete Account -->
    <div class="pb-5 pt-12">
        <h1 class="text-gray-200 md:text-2xl text-xl">Delete Account</h1>
        <p class="text-gray-400 pt-2 md:text-md text-sm md:w-[400px]">Setelah akun anda dihapus, semua data anda akan dihapus secara permanen.</p>
    </div>

    <button id="deleteButton" class="bg-red-600 hover:bg-red-700 text-white mt-3 py-2 px-5 text-[15px] rounded">Hapus Akun</button>

    <div id="confirmationPopup" class="fixed top-0 left-0 w-full h-full bg-black bg-opacity-50 flex justify-center items-center hidden">
        <div class="bg-black border border-gray-500 rounded-lg shadow-lg p-8">
            <p class="text-lg mb-4 text-gray-100">Apakah anda yakin ingin menghapus akun anda?</p>
            <div class="flex justify-end gap-4">
                <form action=" {{ route('profile.delete.account') }} " method="POST">
                    @csrf
                    @method('DELETE')
                    <button id="confirmDelete" type="submit" class="bg-red-700 hover:bg-red-800 text-gray-100 py-2 px-4 rounded">
                        Ya, Hapus
                    </button>
                </form>
                <button id="cancelDelete" class="bg-gray-900 hover:bg-gray-800 text-gray-200 py-2 px-4 rounded">
                    Batal
                </button>
            </div>
        </div>
    </div>





    <div id="notification-container" class="fixed bottom-[20px] right-[-100px] transform -translate-x-1/2 bg-gray-800 text-white py-4 px-8 rounded-md shadow-lg z-50 opacity-0 transition-opacity duration-300">
        <p id="notification-message">
            <i class="fas fa-check text-white"></i>
        </p>
    </div>

    <div id="error-notification-container" class="fixed bottom-[20px] right-[-120px] transform -translate-x-1/2 bg-red-500 text-white py-4 px-8 rounded-md shadow-lg z-50 opacity-0 transition-opacity duration-300">
        <p id="error-notification-message"></p>
    </div>

    <img src="{{asset('images/bg.webp')}}" class="absolute md:top-[90px] top-[140px] right-0 w-[80%] z-[-1]" alt="">
    <img src="{{asset('images/bg.webp')}}" class="absolute md:top-[200px] top-[800px] md:left-[-90px] left-[-30px] w-[80%] z-[-2]" alt="">
    <img src="{{asset('images/bg.webp')}}" class="absolute bottom-0 md:left-[4px] left-[40px] w-[600px] z-[-2]" alt="">

    <script>
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

        // load more rating
        const dataContainer = document.getElementById('data-container');
        const loadMoreBtn = document.getElementById('load-more-btn');
        const itemsToLoad = 2; // Jumlah item yang ingin ditampilkan di awal

        const allDataItems = Array.from(dataContainer.querySelectorAll('.data-item'));
        const totalDataItems = allDataItems.length;

        if (totalDataItems > itemsToLoad) {
        // Sembunyikan item setelah jumlah awal
        const initialHidden = allDataItems.slice(itemsToLoad);
        initialHidden.forEach(item => item.classList.add('hidden'));

        loadMoreBtn.addEventListener('click', function() {
            const hiddenItems = dataContainer.querySelectorAll('.data-item.hidden');
            let loadedCount = 0;

            for (let i = 0; i < hiddenItems.length && loadedCount < (totalDataItems - itemsToLoad); i++) {
            hiddenItems[i].classList.remove('hidden');
            loadedCount++;
            }

            // Sembunyikan tombol jika semua item sudah ditampilkan
            if (dataContainer.querySelectorAll('.data-item.hidden').length === 0) {
            loadMoreBtn.style.display = 'none';
            }
        });
        } else {
        // Jika jumlah data tidak lebih dari jumlah awal, sembunyikan tombol
        loadMoreBtn.style.display = 'none';
        }
        
        // load more reply
        const dataContainer2 = document.getElementById('data-container2');
        const loadMoreBtn2 = document.getElementById('load-more-btn2');
        const itemsToLoad2 = 2; // Jumlah item yang ingin ditampilkan di awal

        const allDataItems2 = Array.from(dataContainer2.querySelectorAll('.data-item2'));
        const totalDataItems2 = allDataItems2.length;

        if (totalDataItems2 > itemsToLoad2) {
        // Sembunyikan item setelah jumlah awal
        const initialHidden = allDataItems2.slice(itemsToLoad2);
        initialHidden.forEach(item => item.classList.add('hidden'));

        loadMoreBtn2.addEventListener('click', function() {
            const hiddenItems = dataContainer2.querySelectorAll('.data-item2.hidden');
            let loadedCount = 0;

            for (let i = 0; i < hiddenItems.length && loadedCount < (totalDataItems2 - itemsToLoad2); i++) {
            hiddenItems[i].classList.remove('hidden');
            loadedCount++;
            }

            // Sembunyikan tombol jika semua item sudah ditampilkan
            if (dataContainer2.querySelectorAll('.data-item.hidden').length === 0) {
            loadMoreBtn2.style.display = 'none';
            }
        });
        } else {
        // Jika jumlah data tidak lebih dari jumlah awal, sembunyikan tombol
        loadMoreBtn2.style.display = 'none';
        }

        document.addEventListener('DOMContentLoaded', function() {
        const deleteButton = document.getElementById('deleteButton');
        const confirmationPopup = document.getElementById('confirmationPopup');
        const confirmDeleteButton = document.getElementById('confirmDelete');
        const cancelDeleteButton = document.getElementById('cancelDelete');

        deleteButton.addEventListener('click', function() {
            confirmationPopup.classList.remove('hidden'); // Show the pop-up
        });

        cancelDeleteButton.addEventListener('click', function() {
            confirmationPopup.classList.add('hidden'); // Hide the pop-up
        });

        confirmDeleteButton.addEventListener('click', function() {
            // User confirmed the deletion
            alert('Akun anda berhasil dihapus');
            confirmationPopup.classList.add('hidden'); // Hide the pop-up after action
            // In a real application, you would trigger the delete action here (e.g., AJAX request)
        });
    });
    </script>

    <style>
        /* Untuk Chrome, Safari, Edge, Opera */
        input::-webkit-outer-spin-button,
        input::-webkit-inner-spin-button {
        -webkit-appearance: none;
        margin: 0;
        }

        /* Untuk Firefox */
        input[type=number] {
        -moz-appearance: textfield;
        }
    </style>
</div>

@endsection