@props(['title', 'totalExca', 'totalDumping', 'latestWeather', 'latestWaterDepth', 'hideSidebar' => false])

<!doctype html>
<html lang="en" :class="{ 'theme-dark': dark }" x-data="data()">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        @vite(['resources/css/app.css','resources/js/app.js'])
        <link id="favicon" rel="shortcut icon" href="{{ asset('assets/img/${value}') }}" type="image/x-icon">
        
        <!-- Font -->
        <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet" />
        
        <!-- Link CSS -->
        <link rel="stylesheet" href="{{ asset('assets/css/tailwind.output-2.css') }}"/>
        <link rel="stylesheet" href="{{ asset('assets/css/Chart.min.css') }}"/>
        
        <!-- JS -->
        <script src="{{ asset('assets/js/alpine.min.js') }}"></script>
        <script src="{{ asset('assets/js/init-alpine.js') }}"></script>
        <!-- <script src="{{ asset('assets/js/Chart.min.js') }}"></script>
        <script src="{{ asset('assets/js/charts-lines.js') }}"></script>
        <script src="{{ asset('assets/js/charts-pie.js') }}"></script> -->
        <script src="{{ asset('assets/js/focus-trap.js') }}" defer></script>
        <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
        <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>

    </head>

    <body> 
        <div class="flex h-screen bg-gray-50 dark:bg-gray-900" :class="{ 'overflow-hidden': isSideMenuOpen }">
            @if (!$hideSidebar)
                <x-operator.sidebar
                    :totalExca="$totalExca ?? 0"
                    :totalDumping="$totalDumping ?? 0"
                    :latestWeather="$latestWeather ?? null"
                    :latestWaterDepth="$latestWaterDepth ?? null"
                />
            @endif
            <div class="flex flex-col flex-1 w-full">
                <x-operator.navbar></x-operator.navbar>
                <main class="h-full overflow-y-auto">
                    {{$slot}}
                </main>
            </div>
        </div>

<!--    ===============================
            Script Fungsional Halaman
        ================================    -->
        <script>
            // ===============================
            // Scroll halaman ke atas dengan animasi halus
            // ===============================
            function scrollToTop() {
                window.scrollTo({
                    top: 0,
                    behavior: 'smooth'
                });
            }

            // ===============================
            // Terapkan tema (terang/gelap) dan invert ikon sesuai tema
            // ===============================
            function applyTheme() {
                const theme = document.body.classList.contains('dark') ? 'dark' : 'light';
                const icons = document.querySelectorAll('.invert-icon img');

                icons.forEach(icon => {
                    icon.style.filter = theme === 'light' ? 'invert(1)' : 'invert(0)';
                });
            }

            // ===============================
            // Setup fungsi modal (toggle & hide)
            // ===============================
            function setupModals() {
                const modalToggleBtns = document.querySelectorAll('[data-modal-toggle]');
                const modalHideBtns = document.querySelectorAll('[data-modal-hide]');

                // Tampilkan atau sembunyikan modal
                modalToggleBtns.forEach(btn => {
                    btn.addEventListener('click', () => {
                        const modalId = btn.getAttribute('data-modal-toggle');
                        const modal = document.getElementById(modalId);
                        if (modal) modal.classList.toggle('hidden');
                    });
                });

                // Sembunyikan modal saat tombol close diklik
                modalHideBtns.forEach(btn => {
                    btn.addEventListener('click', () => {
                        const modalId = btn.getAttribute('data-modal-hide');
                        const modal = document.getElementById(modalId);
                        if (modal) {
                            modal.classList.add('hidden');
                            // Reset form dalam modal jika ada
                            const form = modal.querySelector('form');
                            if (form) form.reset();
                        }
                    });
                });
            }

            // ===============================
            // Ubah favicon berdasarkan halaman saat ini
            // ===============================
            function updateFavicon() {
                const currentPage = window.location.pathname;
                const favicon = document.getElementById("favicon");
                const baseUrl = favicon.dataset.baseUrl || "{{ asset('assets/img') }}";

                const iconMap = {
                    "/operator/user-report": 'menu-icons/user-report.png',
                    "/operator": 'logo-locatorgis/locatorgis-logo.png',
                };

                for (const [key, value] of Object.entries(iconMap)) {
                    if (currentPage.includes(key)) {
                        favicon.href = `${baseUrl}/${value}?v=${new Date().getTime()}`;
                        break;
                    }
                }
            }

            // ===============================
            // Eksekusi ketika DOM telah siap
            // ===============================
            document.addEventListener("DOMContentLoaded", function () {
                applyTheme();           // Terapkan tema awal
                setupModals();          // Inisialisasi modal
                updateFavicon();        // Ubah favicon sesuai halaman

                // Fungsi toggle tema saat tombol diklik
                const themeToggleButton = document.getElementById('theme-toggle');
                if (themeToggleButton) {
                    themeToggleButton.addEventListener('click', function () {
                        document.body.classList.toggle('dark');
                        applyTheme();
                    });
                }
            });

            // ===============================
            // Fungsi Search AJAX Dinamis
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

        <!-- Script User-Reports -->
        <!-- Function to scroll smoothly to the top of the page -->
        <script src="{{ asset('assets/js/scroll-smoothly.js') }}"></script>

        <!-- Function to apply theme and invert icons accordingly -->
        <script src="{{ asset('assets/js/apply-theme.js') }}"></script>

        <!-- Script untuk menampilkan create form dan preview image saat create -->
        <script src="{{ asset('assets/js/form-create.js') }}"></script>
        <script src="{{ asset('assets/js/preview-img-create.js') }}"></script>

        <!-- Script untuk menampilkan modal detail -->
        <script src="{{ asset('assets/js/show-modal.js') }}"></script>
        
        <!-- Script untuk menampilkan edit form & preview image saat edit form -->
        <script src="{{ asset('assets/js/form-edit.js') }}"></script>
        <script src="{{ asset('assets/js/preview-img-edit.js') }}"></script>

    </body>
</html>