<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Rinema</title>
        <link rel="preconnect" href="https://fonts.bunny.net">
        <script src="https://cdn.tailwindcss.com"></script> 
        <link rel="icon" href="{{ asset('favicon.ico') }}" type="image/x-icon">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" integrity="sha512-9usAa10IRO0HhonpyAIVpjrylPvoDwiPUiKdWk5t3PyolY1cOd4DSE0Ga+ri4AuTroPR5aQvXU9xC6qOPnzFeg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
        <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600" rel="stylesheet" />
        @vite('resources/js/app.js')
        @vite('resources/css/app.css')


        <!-- Swiper js -->
        <link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.css">
        <script src="https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.js"></script>

        <!-- Owl Carousel -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.theme.default.min.css">
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"></script>

        <!-- hero icon -->
        <script src="https://cdn.jsdelivr.net/npm/heroicons@1.0.5/dist/heroicons.min.js"></script>

        <!-- Data Aos Transition -->
        <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">

    </head>
    <body class="bg-black">
    
    @include('komponen.navbar')
    
    
    
    <main class="pt-20 px-5 md:px-20 relative font-caros overflow-x-hidden">
        @yield('home')
        @yield('film')
        @yield('detailfilm')
        @yield('profile')
        @yield('login')
        @yield('register')
    </main>
    
    @include('komponen.footer')
    

    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script>
        AOS.init({
    once: true,
    });


    // filmterbaru-section.blade.php
    // Swiper
    document.addEventListener("DOMContentLoaded", function () {
        var swiper = new Swiper(".filmSwiper", {
            slidesPerView: 1.4,
            spaceBetween: 15,
            grabCursor: true,
            navigation: {
                nextEl: ".swiper-next",
                prevEl: ".swiper-prev",
            },
            breakpoints: {
                640: { slidesPerView: 2 },
                1024: { slidesPerView: 4 },
            },
            on: {
                update: function () {
                    updateNavButtons();
                },
            },
        });

        var container = document.querySelector(".film-terbaru");
        var prevButton = document.querySelector(".swiper-prev");
        var nextButton = document.querySelector(".swiper-next");

        function applyHoverEffect() {
            if (window.innerWidth >= 768) {
                // Misalnya, 768px adalah breakpoint untuk desktop
                container.addEventListener("mouseover", handleMouseOver);
                container.addEventListener("mouseout", handleMouseOut);
            } else {
                container.removeEventListener("mouseover", handleMouseOver);
                container.removeEventListener("mouseout", handleMouseOut);
                prevButton.style.opacity = "1";
                nextButton.style.opacity = "1";
                prevButton.style.pointerEvents = "auto";
                nextButton.style.pointerEvents = "auto";
            }
        }

        function handleMouseOver() {
            prevButton.style.opacity = "1";
            nextButton.style.opacity = "1";
            prevButton.style.pointerEvents = "auto";
            nextButton.style.pointerEvents = "auto";
            updateNavButtons();
        }

        function handleMouseOut() {
            prevButton.style.opacity = "0";
            nextButton.style.opacity = "0";
            prevButton.style.pointerEvents = "none";
            nextButton.style.pointerEvents = "none";
        }

        function updateNavButtons() {
            if (swiper.isBeginning) {
                prevButton.classList.add("swiper-button-disabled");
            } else {
                prevButton.classList.remove("swiper-button-disabled");
            }

            if (swiper.isEnd) {
                nextButton.classList.add("swiper-button-disabled");
            } else {
                nextButton.classList.remove("swiper-button-disabled");
            }
        }

        applyHoverEffect();
        window.addEventListener("resize", applyHoverEffect);
        updateNavButtons();
    });

    // Hover Card
    document.addEventListener("DOMContentLoaded", function () {
        const hoverEffects = document.querySelectorAll(".hover-effect");

        hoverEffects.forEach((hoverEffect) => {
            hoverEffect.style.opacity = "0";
            hoverEffect.style.transition = "opacity 0.3s ease-in-out";

            hoverEffect.parentElement.addEventListener("mouseenter", function () {
                hoverEffect.style.opacity = "1";
            });

            hoverEffect.parentElement.addEventListener("mouseleave", function () {
                hoverEffect.style.opacity = "0";
            });
        });
    });

    // Film.Blade.php
    document
        .getElementById("dropdownButton")
        .addEventListener("click", function () {
            document.getElementById("dropdownMenu").classList.toggle("hidden");
        });

    document.addEventListener("click", function (event) {
        if (!document.getElementById("dropdownButton").contains(event.target)) {
            document.getElementById("dropdownMenu").classList.add("hidden");
        }
    });

    // detailfilm.blade.php
    document.addEventListener("DOMContentLoaded", function () {
        const buttons = {
            "default-btn": ".div1",
            "div2-btn": ".div2",
            "div3-btn": ".div3",
        };
        const divs = document.querySelectorAll('div[class^="div"]');

        Object.keys(buttons).forEach((buttonId) => {
            const button = document.getElementById(buttonId);
            button.addEventListener("click", function () {
                const divToShow = document.querySelector(buttons[this.id]);

                divs.forEach((div) => {
                    div.classList.add("hidden");
                });

                if (divToShow) {
                    divToShow.classList.remove("hidden");
                }

                // Tambahkan/Hapus class active
                Object.keys(buttons).forEach((btnId) => {
                    const currentBtn = document.getElementById(btnId);
                    if (btnId === this.id) {
                        currentBtn.classList.add("text-gray-200");
                        currentBtn.classList.remove("text-gray-400");
                    } else {
                        currentBtn.classList.remove("text-gray-200");
                        currentBtn.classList.add("text-gray-400");
                    }
                });
            });
        });
    });

    function toggleDropdown(replyId) {
        // Ambil dropdown yang sesuai dengan ID
        const dropdown = document.getElementById(`dropdown-${replyId}`);

        // Sembunyikan semua dropdown lain sebelum membuka yang ini
        document.querySelectorAll("[id^='dropdown-']").forEach((el) => {
            if (el !== dropdown) el.classList.add("hidden");
        });

        // Toggle visibilitas dropdown
        dropdown.classList.toggle("hidden");
    }

    // Tutup dropdown jika klik di luar
    document.addEventListener("click", function (event) {
        if (!event.target.closest(".relative")) {
            document
                .querySelectorAll("[id^='dropdown-']")
                .forEach((el) => el.classList.add("hidden"));
        }
    });

    function showEditForm(replyId) {
        const editForm = document.getElementById("editForm" + replyId);
        editForm.classList.toggle("hidden");
    }

    // Profile.blade.php
    const dataContainer = document.getElementById("data-container");
    const loadMoreBtn = document.getElementById("load-more-btn");
    const itemsToLoad = 3; // Jumlah item yang dimuat setiap kali tombol diklik

    loadMoreBtn.addEventListener("click", function () {
        const hiddenItems = dataContainer.querySelectorAll(".data-item.hidden");
        let loadedCount = 0;

        for (let i = 0; i < hiddenItems.length && loadedCount < itemsToLoad; i++) {
            hiddenItems[i].classList.remove("hidden");
            loadedCount++;
        }

        // Sembunyikan tombol jika tidak ada lagi item tersembunyi
        if (dataContainer.querySelectorAll(".data-item.hidden").length === 0) {
            loadMoreBtn.style.display = "none";
        }
    });

    // Sembunyikan item awal (opsional, jika Anda ingin menampilkan 3 pertama saja)
    const initialHidden = Array.from(
        dataContainer.querySelectorAll(".data-item")
    ).slice(2);
    initialHidden.forEach((item) => item.classList.add("hidden"));

    </script>
</body>
</html>




