<!doctype html>
<html lang="en" :class="{ 'theme-dark': dark }" x-data="data()">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        @vite(['resources/css/app.css','resources/js/app.js'])
        <title>LocatorGIS | {{$title}} </title>
        <link id="favicon" rel="shortcut icon" href="{{ asset('assets/img/excavator.png') }}" type="image/x-icon">
        
        <!-- Font -->
        <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet"/>

        <!-- CSS -->
        <link rel="stylesheet" href="./assets/css/tailwind.output-2.css"/>
        <link rel="stylesheet" href="./assets/css/Chart.min.css"/>

        <!-- JS -->

        <script src="./assets/js/alpine.min.js"></script>
        <script src="./assets/js/init-alpine.js"></script>
        <script src="./assets/js/Chart.min.js"></script>
        <script src="./assets/js/charts-lines.js"></script>
        <script src="./assets/js/charts-pie.js"></script>
        <script src="./assets/js/focus-trap.js" defer></script>

    </head>
    <body> 
        <div class="flex h-screen bg-gray-50 dark:bg-gray-900" :class="{ 'overflow-hidden': isSideMenuOpen }">
            <x-sidebar></x-sidebar>
            <div class="flex flex-col flex-1 w-full">
                <x-navbar></x-navbar>
                <main class="h-full overflow-y-auto">
                    <!-- Section/Content -->
                    <div class="container px-6 mx-auto grid">
                        <x-header>{{$title}}</x-header>                  
                        {{$slot}}
                        <br>
                    </div>
                </main>
            </div>
        </div>


        <script>
            function scrollToTop() {
                window.scrollTo({ top: 0, behavior: 'smooth' });
            }
            function applyTheme() {
                const theme = document.body.classList.contains('dark') ? 'dark' : 'light';
                const icons = document.querySelectorAll('.invert-icon img');

                icons.forEach(icon => {
                    icon.style.filter = theme === 'light' ? 'invert(1)' : 'invert(0)';
                });
            }
            document.addEventListener("DOMContentLoaded", function() {
                applyTheme();
                const themeToggleButton = document.getElementById('theme-toggle');
                if (themeToggleButton) {
                    themeToggleButton.addEventListener('click', function() {
                        document.body.classList.toggle('dark');
                        applyTheme();
                    });
                }

                const modalToggleBtns = document.querySelectorAll('[data-modal-toggle]');
                const modalHideBtns = document.querySelectorAll('[data-modal-hide]');

                modalToggleBtns.forEach(btn => {
                    btn.addEventListener('click', () => {
                        const modalId = btn.getAttribute('data-modal-toggle');
                        const modal = document.getElementById(modalId);
                        if (modal) {
                            modal.classList.toggle('hidden');
                        } else {
                            console.error(`Modal with ID ${modalId} not found`);
                        }
                    });
                });
                modalHideBtns.forEach(btn => {
                    btn.addEventListener('click', () => {
                        const modalId = btn.getAttribute('data-modal-hide');
                        const modal = document.getElementById(modalId);
                        if (modal) {
                            modal.classList.add('hidden');
                        }
                        // Reset form di dalam modal
                        const form = modal.querySelector('form');
                        if (form) {
                            form.reset();
                        }
                    });
                });
                // Mengubah favicon berdasarkan halaman saat ini
                const currentPage = window.location.pathname;
                const favicon = document.getElementById("favicon");
                const iconMap = {
                    "maps": 'maps.png',
                    "dashboard": 'excavator.png',
                    "exca": 'excavator.png',
                    "dump": 'dump-truck.png',
                    "weather": 'cloud.png',
                    "waterdepth": 'water-waves.png'
                };

                for (const [key, value] of Object.entries(iconMap)) {
                    if (currentPage.includes(key)) {
                        favicon.href = `{{ asset('assets/img/${value}') }}?v=${new Date().getTime()}`;
                        break;
                    }
                }
            });

            function submitForm() {
                const form = document.getElementById('createForm');
                const modal = document.getElementById('defaultModal');
                
                if (modal) {
                    modal.classList.add('hidden');
                }

                document.getElementById('defaultModalButton').click();
                document.getElementById('deleteButton').click();
                document.getElementById('updateProductButton').click();
            }

            function ubahGambarCuaca() {
                const selectElement = document.getElementById('cuaca');
                const cuacaTerpilih = selectElement.value;
                const gambarCuaca = document.getElementById('cuaca-icon');
                
                // Ubah path gambar sesuai dengan value dari select
                gambarCuaca.src = 'assets/img/cuaca-icons/' + cuacaTerpilih + '.png'; 
            }

            // Chart .js untuk menampilkan grafik LocatorGIS
        </script>    
    </body>
</html>