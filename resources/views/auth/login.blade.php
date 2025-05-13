@extends('index')

@section('login')
<div class="relative w-full login">
    <div class="flex mt-6 pb-[70px]  justify-center">
        <div data-aos="fade-up" data-aos-duration="700" data-aos-delay="100" class="bg-black border border-gray-500 w-full md:w-[370px] rounded-lg px-5 ">
            <h1 class="text-white text-2xl text-center py-7 font-caros">Login</h1>
            <form method="POST" action="{{ route('login') }}" class="font-caros">
                @csrf

                <div class="relative">
                    <input type="email" name="email" id="emailInput" required autofocus autocomplete="off"
                        class="w-full text-white mt-1 px-3 py-2 rounded-md bg-black border border-gray-500 focus:outline-none focus:border-blue-600 focus:ring-transparent peer placeholder-transparent @error('email') @enderror">

                    <label for="emailInput" id="emailLabel" class="absolute left-2 top-[13px] text-[15px] text-gray-500 transition-all peer-focus:-top-1 peer-focus:text-xs peer-focus:text-blue-600 bg-black px-2 peer-focus:bg-black">Email</label>
                    @error('email')
                        <p class="text-[12px] text-blue-500 mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="relative mt-3">
                    <input type="password" name="password" id="passwordInput" required 
                        class="w-full bg-black text-white mt-1 px-3 py-2 rounded-lg border border-gray-500 focus:outline-none focus:border-blue-600 focus:ring-transparent peer placeholder-transparent @error('password') @enderror">

                    <label for="passwordInput" id="passwordLabel" class="absolute bg-black text-gray-500 left-2 top-[13px] text-[15px] text-gray-500 transition-all peer-focus:-top-1 peer-focus:text-xs peer-focus:text-blue-600 px-2 peer-focus:bg-black">Password</label>
                    @error('password')
                        <p class="text-[12px] text-blue-500 mt-1">{{ $message }}</p>
                    @enderror

                    <span id="togglePassword" class="absolute inset-y-0 right-3 flex items-center cursor-pointer">
                        <i class="fas fa-eye mt-1 text-gray-400"></i> </span>
                    </div>
                    
                    <button type="submit" class="w-full py-2 mt-7 bg-gradient-to-r from-blue-700 to-blue-500 text-white rounded-lg ">
                        Login
                    </button>
            </form>
            <p class="text-gray-200 text-[12px] pt-3">
                Belum memiliki akun?
                <a href="{{route('register')}}" class="text-blue-500 hover:border-b hover:border-blue-500">Sign Up</a>
            </p>
            <p class="text-center text-gray-400 py-4 font-caros">or</p>

            <a href="{{route('login.google')}}" class="w-full flex items-center justify-center bg-black border border-gray-500 transition-all hover:bg-gray-900 py-3 rounded-md mb-6 ">
                <img src="https://www.svgrepo.com/show/355037/google.svg" alt="Google Logo" class="w-5 h-5 mr-2">
                <p class="text-white mt-[-2px]">Login with Google</p>
            </a>
        </div>
    </div>
    <img data-aos="fade-left" data-aos-duration="1200" data-aos-delay="100" src="{{asset('images/bg.webp')}}" class="absolute w-[450px] top-[-10px] left-[24%] z-[-1]">
</div>


<style>
    .login{
        overflow: hidden;
    }
</style>

<script>
    const emailInput = document.getElementById('emailInput');
    const emailLabel = document.getElementById('emailLabel');
    const passwordInput = document.getElementById('passwordInput');
    const passwordLabel = document.getElementById('passwordLabel'); 

    function updateLabelAndBorder() {
        // Logika untuk email input
        if (emailInput.value) {
            emailLabel.classList.add('-top-1', 'text-xs', 'text-blue-600');
            emailInput.classList.add('border-blue-600');
        } else {
            emailLabel.classList.remove('-top-1', 'text-xs', 'text-blue-600');
            emailInput.classList.remove('border-blue-600');
        }

        // Logika untuk password input
        if (passwordInput.value) {
            passwordLabel.classList.add('-top-1', 'text-xs', 'text-blue-600'); 
            passwordInput.classList.add('border-blue-600');
        } else {
            passwordLabel.classList.remove('-top-1', 'text-xs', 'text-blue-600'); 
            passwordInput.classList.remove('border-blue-600');
        }
    }

    emailInput.addEventListener('input', updateLabelAndBorder);
    emailInput.addEventListener('blur', updateLabelAndBorder);
    passwordInput.addEventListener('input', updateLabelAndBorder);
    passwordInput.addEventListener('blur', updateLabelAndBorder);

    updateLabelAndBorder();

    togglePassword.addEventListener('click', function() {
        const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
        passwordInput.setAttribute('type', type);
        this.querySelector('i').classList.toggle('fa-eye');
        this.querySelector('i').classList.toggle('fa-eye-slash');
    });
</script>
@endsection