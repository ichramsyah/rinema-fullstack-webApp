<div id="preloader" class="fixed inset-0 flex items-center justify-center bg-black z-50 transition-opacity duration-500">
    <div class="relative flex flex-col items-center space-y-3">
        <div class="w-14 h-14 border-4 border-black border-t-blue-700 rounded-full animate-spin"></div>
        <p class="text-white text-sm animate-pulse">Loading...</p>
    </div>
</div>

<style>
    .fade-out {
        opacity: 0;
        visibility: hidden;
        transition: opacity 0.5s ease-out, visibility 0.5s ease-out;
    }
</style>

<script>
    window.onload = function() {
        setTimeout(function() {
            document.getElementById("preloader").classList.add("fade-out");
            document.getElementById("content").classList.remove("hidden");
        }, 1200); 
    };
</script>