<!doctype html>
<html lang="en" :class="{ 'theme-dark': dark }" x-data="data()">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        @vite(['resources/css/app.css','resources/js/app.js'])
        <title>LocatorGIS | {{$title}} </title>
        <link id="favicon" rel="shortcut icon" href="{{ asset('assets/img/${value}') }}" type="image/x-icon">
        
        <!-- Font -->
        <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet"/>

        <!-- CSS -->
        <!-- <link rel="stylesheet" href="./assets/css/tailwind.output-2.css"/>
        <link rel="stylesheet" href="./assets/css/Chart.min.css"/> -->
        <link rel="stylesheet" href="{{ asset('assets/css/tailwind.output-2.css') }}"/>
        <link rel="stylesheet" href="{{ asset('assets/css/Chart.min.css') }}"/>

        <!-- JS -->
        <!-- <script src="./assets/js/alpine.min.js"></script>
        <script src="./assets/js/init-alpine.js"></script>
        <script src="./assets/js/Chart.min.js"></script>
        <script src="./assets/js/charts-lines.js"></script>
        <script src="./assets/js/charts-pie.js"></script>
        <script src="./assets/js/focus-trap.js" defer></script> -->
        <script src="{{ asset('assets/js/alpine.min.js') }}"></script>
        <script src="{{ asset('assets/js/init-alpine.js') }}"></script>
        <script src="{{ asset('assets/js/Chart.min.js') }}"></script>
        <script src="{{ asset('assets/js/charts-lines.js') }}"></script>
        <script src="{{ asset('assets/js/charts-pie.js') }}"></script>
        <script src="{{ asset('assets/js/focus-trap.js') }}" defer></script>

    </head>
    <body> 
        <div class="flex h-screen bg-gray-50 dark:bg-gray-900" :class="{ 'overflow-hidden': isSideMenuOpen }">
            <x-sidebar></x-sidebar>
            <div class="flex flex-col flex-1 w-full">
                <x-navbar></x-navbar>
                <main class="h-full p-5 overflow-y-auto">
                    <x-header>{{$title}}</x-header>                  
                    {{$slot}}
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
                    "dashboard": 'dashoard.png',
                    "exca": 'menu-icons/excavator.png',
                    "dump": 'menu-icons/dump-truck.png',
                    "weather": 'menu-icons/cloud.png',
                    "waterdepth": 'menu-icons/water-waves.png',
                    "material": 'menu-icons/mineral.png',
                    "incident-user": 'menu-icons/incident-user.png',
                    "laporan-harian": 'menu-icons/daily-report.png',
                    "laporan-bulanan": 'menu-icons/monthly-report.png',
                    "tentang-sistem": 'menu-icons/about-system.png',
                    "bantuan": 'menu-icons/panduan.png',
                    "kontak": 'menu-icons/contact.png',
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

            // Data Terbuka BMKG (Weather by BMKG) time local
            document.addEventListener('DOMContentLoaded', () => {
                function updateClock() {
                    // Ambil waktu saat ini dari sistem pengguna
                    const now = new Date();

                    // Menentukan zona waktu lokal
                    const timeZoneOffset = now.getTimezoneOffset() / -60; // Offset dalam jam
                    let timeZoneName;

                    if (timeZoneOffset === 7) {
                        timeZoneName = "WIB";
                    } else if (timeZoneOffset === 8) {
                        timeZoneName = "WITA";
                    } else if (timeZoneOffset === 9) {
                        timeZoneName = "WIT";
                    } else {
                        timeZoneName = `GMT${timeZoneOffset >= 0 ? "+" : ""}${timeZoneOffset}`;
                    }

                    // Format tanggal
                    const formattedDate = new Intl.DateTimeFormat('id-ID', {
                        day: '2-digit',
                        month: 'long',
                        year: 'numeric',
                    }).format(now);

                    // Format waktu
                    const formattedTime = new Intl.DateTimeFormat('id-ID', {
                        hour: '2-digit',
                        minute: '2-digit',
                        second: '2-digit',
                    }).format(now);

                    // Gabungan tanggal, waktu, dan zona waktu
                    const dateTimeString = `${formattedDate}, ${formattedTime} ${timeZoneName}`;

                    // Update elemen HTML dengan tanggal dan waktu lokal
                    document.getElementById('local_time').textContent = dateTimeString;
                }

                // Inisialisasi waktu
                updateClock();

                // Perbarui setiap detik
                setInterval(updateClock, 1000);
            });

            // Chart .js untuk menampilkan grafik LocatorGIS

        </script>    
    </body>
</html>