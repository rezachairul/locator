<!doctype html>
<html lang="en" :class="{ 'theme-dark': dark }" x-data="data()">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @vite(['resources/css/app.css','resources/js/app.js'])
    <title>LocatorGIS | {{$title}} </title>

    <!-- Favicon -->
    <link id="favicon" rel="shortcut icon" href="{{ asset('assets/img/default-favicon.png') }}" data-base-url="{{ asset('assets/img') }}" type="image/x-icon">

    <!-- Font -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet" />

    <!-- CSS -->
    <link rel="stylesheet" href="{{ asset('assets/css/tailwind.output-2.css') }}" />
    <!-- <link rel="stylesheet" href="{{ asset('assets/css/Chart.min.css') }}" /> -->

    <!-- JS -->
    <script src="{{ asset('assets/js/jquery-3.6.0.min.js') }}"></script>
    <script src="{{ asset('assets/js/alpine.min.js') }}"></script>
    <script src="{{ asset('assets/js/init-alpine.js') }}"></script>
    <script src="{{ asset('assets/js/Chart.min.js') }}"></script>
    <script src="{{ asset('assets/js/charts-lines.js') }}"></script>
    <script src="{{ asset('assets/js/charts-pie.js') }}"></script>
    <script src="{{ asset('assets/js/chart.js') }}"></script>
    <script src="{{ asset('assets/js/focus-trap.js') }}" defer></script>

</head>

<body>
    <div class="flex h-screen bg-gray-50 dark:bg-gray-900" :class="{ 'overflow-hidden': isSideMenuOpen }">
        <x-admin.sidebar></x-admin.sidebar>
        <div class="flex flex-col flex-1 w-full">
            <x-admin.navbar></x-admin.navbar>
            <main class="h-full p-5 overflow-y-auto">
                <x-admin.header>{{$title}}</x-admin.header>
                {{$slot}}
            </main>
        </div>
    </div>

    <!-- Script -->
    <script>
        // Fungsi untuk scroll halaman ke atas dengan animasi halus
        function scrollToTop() {
            window.scrollTo({
                top: 0,
                behavior: 'smooth'
            });
        }

        // Fungsi untuk menerapkan tema terang/gelap dan menyesuaikan ikon
        function applyTheme() {
            const theme = document.body.classList.contains('dark') ? 'dark' : 'light';
            const icons = document.querySelectorAll('.invert-icon img');

            icons.forEach(icon => {
                icon.style.filter = theme === 'light' ? 'invert(1)' : 'invert(0)';
            });
        }

        // Fungsi untuk menyembunyikan modal dan men-trigger beberapa tombol (submit, delete, update)
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

        // Fungsi untuk mengganti gambar cuaca sesuai dengan pilihan dropdown
        function ubahGambarCuaca() {
            const selectElement = document.getElementById('cuaca');
            const cuacaTerpilih = selectElement.value;
            const gambarCuaca = document.getElementById('cuaca-icon');

            gambarCuaca.src = 'assets/img/cuaca-icons/' + cuacaTerpilih + '.png';
        }

        // ===============================
        // Inisialisasi ketika DOM sudah siap
        // ===============================
        document.addEventListener("DOMContentLoaded", function() {
            applyTheme();

            // ===============================
            // Toggle tema (dark/light mode)
            // ===============================
            const themeToggleButton = document.getElementById('theme-toggle');
            if (themeToggleButton) {
                themeToggleButton.addEventListener('click', function() {
                    document.body.classList.toggle('dark');
                    applyTheme();
                });
            }

            // ===============================
            // Toggle dan hide modal
            // ===============================
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

            // ===============================
            // Ubah favicon berdasarkan halaman
            // ===============================
            const currentPage = window.location.pathname;
            const favicon = document.getElementById("favicon");
            const baseUrl = favicon.dataset.baseUrl; // ambil base path dari data attribute

            const iconMap = {
                "/admin/maps": 'menu-icons/maps.png',
                "/admin/operator": 'menu-icons/operator.png',
                "/admin/operasional/operasional": 'menu-icons/op_mining-2.png',
                "/admin/operasional/exca": 'menu-icons/excavator.png',
                "/admin/operasional/dump": 'menu-icons/dump-truck.png',
                "/admin/operasional/weather": 'menu-icons/cloud.png',
                "/admin/operasional/waterdepth": 'menu-icons/water-waves.png',
                "/admin/operasional/material": 'menu-icons/mineral.png',
                "/admin/laporan-user/incident-user": 'menu-icons/incident-user.png',
                "/admin/informasi/tentang-sistem": 'menu-icons/about-system.png',
                "/admin/informasi/bantuan": 'menu-icons/panduan.png',
                "/admin/informasi/kontak": 'menu-icons/contact.png',
                "/admin": 'dashboard.png',
            };

            for (const [key, value] of Object.entries(iconMap)) {
                if (currentPage.includes(key)) {
                    favicon.href = `${baseUrl}/${value}?v=${new Date().getTime()}`;
                    break;
                }
            }
        });

        // ===============================
        // Menampilkan waktu lokal sesuai zona pengguna (WIB/WITA/WIT)
        // ===============================
        document.addEventListener('DOMContentLoaded', () => {
            function updateClock() {
                const now = new Date();

                const timeZoneOffset = now.getTimezoneOffset() / -60;
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

                const formattedDate = new Intl.DateTimeFormat('id-ID', {
                    day: '2-digit',
                    month: 'long',
                    year: 'numeric',
                }).format(now);

                const formattedTime = new Intl.DateTimeFormat('id-ID', {
                    hour: '2-digit',
                    minute: '2-digit',
                    second: '2-digit',
                }).format(now);

                const dateTimeString = `${formattedDate}, ${formattedTime} ${timeZoneName}`;
                document.getElementById('local_time').textContent = dateTimeString;
            }

            updateClock();
            setInterval(updateClock, 1000);
        });

        // ===============================
        // Fungsi Search AJAX
        // ===============================
        $(document).ready(function () {
            $('#search-input').on('input', function () {
                let query = $(this).val();
                let url = $(this).data('url');
                let target = $(this).data('target');

                console.log('AJAX triggered:', query, url, target);

                $.ajax({
                    url: url,
                    type: "GET",
                    data: { search: query },
                    success: function (data) {
                        console.log('AJAX success:', data);
                        $('#' + target).html(data);
                    },
                    error: function (xhr) {
                        console.log('AJAX error:', xhr.responseText);
                    }
                });
            });
        });
    </script>

</body>

</html>