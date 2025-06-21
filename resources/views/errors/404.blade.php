<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>404</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="shortcut icon" href="{{ asset('images/logo-black.webp') }}" type="image/x-icon">
    @vite('resources/js/app.js')
    @vite('resources/css/app.css')

</head>
<body class="bg-black">
    <div class="text-center mt-[150px] font-caros">
        <h1 class="gradient-text font-bold text-9xl">404</h1>
        <p class="text-gray-300  pt-4">Halaman Tidak Ditemukan</p>
    </div>

    <style>
    .gradient-text {
    font-weight: bold;
    background: linear-gradient(to right, white, darkblue);
    -webkit-background-clip: text; 
    background-clip: text;
    color: transparent; 
    }
    </style>
</body>
</html>