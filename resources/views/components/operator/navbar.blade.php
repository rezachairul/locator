<!-- Navbar -->
<div class="flex flex-col flex-1 w-full">
    <header class="z-10 py-4 bg-white shadow-md dark:bg-gray-800">
        <div class="flex items-center justify-between h-full px-6 mx-auto text-purple-600 dark:text-purple-300">
            <!-- Mobile hamburger -->
            <button @click="toggleSideMenu" class="p-1 -ml-1 mr-5 rounded-md md:hidden focus:outline-none focus:shadow-outline-purple" aria-label="Menu">
                <svg class="w-6 h-6" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M3 5a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM3 10a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM3 15a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1z" clip-rule="evenodd"></path>
                </svg>
            </button>
            <!-- Search input -->
            <div class="flex justify-center flex-1 lg:mr-32">
                <div class="relative w-full max-w-xl mr-6 focus-within:text-purple-500">
                    <div class="absolute inset-y-0 flex items-center pl-2">
                        <svg class="w-4 h-4" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z" clip-rule="evenodd"></path>
                        </svg>
                    </div>
                    <input class="w-full pl-8 pr-2 text-sm text-gray-700 placeholder-gray-600 bg-gray-100 border-0 rounded-md dark:placeholder-gray-500 dark:bg-gray-700 focus:placeholder-gray-500 dark:focus:placeholder-gray-600 focus:bg-white dark:focus:bg-gray-600 focus:border-purple-300 focus:outline-none form-input" type="text" placeholder="Search for projects" aria-label="Search" />
                </div>
            </div>
            <ul class="flex items-center flex-shrink-0 space-x-6">
                <!-- Theme toggler -->
                <li class="flex">
                    <button @click="toggleTheme" aria-label="Toggle color mode" class="rounded-md focus:outline-none focus:shadow-outline-purple" aria-label="Toggle color mode" id="theme-toggle">
                        <template x-if="!dark">
                            <svg class="w-5 h-5" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M17.293 13.293A8 8 0 016.707 2.707a8.001 8.001 0 1010.586 10.586z" />
                            </svg>
                        </template>
                        <template x-if="dark">
                            <svg class="w-5 h-5" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10 2a1 1 0 011 1v1a1 1 0 11-2 0V3a1 1 0 011-1zm4 8a4 4 0 11-8 0 4 4 0 018 0zm-.464 4.95l.707.707a1 1 0 001.414-1.414l-.707-.707a1 1 0 00-1.414 1.414zm2.12-10.607a1 1 0 010 1.414l-.706.707a1 1 0 11-1.414-1.414l.707-.707a1 1 0 011.414 0zM17 11a1 1 0 100-2h-1a1 1 0 100 2h1zm-7 4a1 1 0 011 1v1a1 1 0 11-2 0v-1a1 1 0 011-1zM5.05 6.464A1 1 0 106.465 5.05l-.708-.707a1 1 0 00-1.414 1.414l.707.707zm1.414 8.486l-.707.707a1 1 0 01-1.414-1.414l.707-.707a1 1 0 011.414 1.414zM4 11a1 1 0 100-2H3a1 1 0 000 2h1z" clip-rule="evenodd" />
                            </svg>
                        </template>
                    </button>
                </li>
                <!-- Notifications menu -->
                <li class="relative" x-data="{ isNotificationsMenuOpen: false }">
                    <button @click="isNotificationsMenuOpen = !isNotificationsMenuOpen" @keydown.escape="isNotificationsMenuOpen = false"
                        aria-label="Notifications" aria-haspopup="true"
                        class="relative align-middle rounded-md focus:outline-none focus:shadow-outline-purple">
                        
                        <!-- Bell icon -->
                        <svg class="w-5 h-5" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20">
                            <path
                                d="M10 2a6 6 0 016 6v3.586l.707.707a1 1 0 01.293.707V14a1 1 0 01-1 1H4a1 1 0 01-1-1v-.293a1 1 0 01.293-.707L4 11.586V8a6 6 0 016-6zm-4 14a2 2 0 004 0H6z">
                            </path>
                        </svg>

                        <!-- Notification badge -->
                        @if(auth()->user()->unreadNotifications->count() > 0)
                            @php
                                $badgeColor = match(optional(auth()->user()->unreadNotifications->first())->data['status'] ?? null) {
                                    'pending' => 'bg-yellow-500',
                                    'in_progress' => 'bg-blue-500',
                                    'closed' => 'bg-green-500',
                                    'none' => 'bg-gray-400',
                                    default => 'bg-red-600',
                                };
                            @endphp
                            <span aria-hidden="true"
                                class="absolute top-0 right-0 inline-block w-3 h-3 transform translate-x-2 -translate-y-2 {{ $badgeColor }} border-2 border-white rounded-full">
                            </span>
                        @endif
                    </button>

                    <!-- Dropdown menu -->
                    <template x-if="isNotificationsMenuOpen">
                        <ul @click.away="isNotificationsMenuOpen = false" @keydown.escape="isNotificationsMenuOpen = false"
                            class="absolute right-0 w-72 p-2 mt-2 space-y-2 text-sm text-gray-700 bg-white border border-gray-100 rounded-md shadow-md dark:text-gray-300 dark:border-gray-700 dark:bg-gray-800 max-h-96 overflow-y-auto z-50">
                            @forelse (auth()->user()->notifications->take(10) as $notif)
                                @php
                                    $notifId = $notif->id;
                                    $status = $notif->data['status'] ?? 'none';
                                    switch ($status) {
                                        case 'pending':
                                            $colorClass = 'text-yellow-500';
                                            $icon = '<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6 text-yellow-500 inline"><path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6h4.5m4.5 0a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" /></svg>';
                                            break;
                                        case 'in_progress':
                                            $colorClass = 'text-blue-500';
                                            $icon = '<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6 text-blue-500 animate-spin inline"><path stroke-linecap="round" stroke-linejoin="round" d="M16.023 9.348h4.992v-.001M2.985 19.644v-4.992m0 0h4.992m-4.993 0 3.181 3.183a8.25 8.25 0 0 0 13.803-3.7M4.031 9.865a8.25 8.25 0 0 1 13.803-3.7l3.181 3.182m0-4.991v4.99" /></svg>';
                                            break;
                                        case 'closed':
                                            $colorClass = 'text-green-500';
                                            $icon = '<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6 text-green-500 inline"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75 11.25 15 15 9.75M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" /></svg>';
                                            break;
                                        default:
                                            $colorClass = 'text-gray-500';
                                            $icon = '<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6 text-gray-500 inline"><path stroke-linecap="round" stroke-linejoin="round" d="m11.25 11.25.041-.02a.75.75 0 0 1 1.063.852l-.708 2.836a.75.75 0 0 0 1.063.853l.041-.021M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Zm-9-3.75h.008v.008H12V8.25Z" /></svg>';
                                    }
                                @endphp

                                <li x-data="{ show: true }" x-show="show" class="flex justify-between items-center px-2 py-1">
                                    <div class="flex flex-col">
                                        <span class="font-semibold {{ $colorClass }} dark:text-white">
                                            {!! $icon !!} Notifikasi
                                        </span>
                                        <span class="text-xs text-gray-500 dark:text-gray-400">
                                            {{ $notif->data['message'] ?? 'Status laporan Anda diperbarui.' }}
                                        </span>
                                    </div>

                                    {{-- Tombol X delete via fetch --}}
                                    <button
                                        @click="
                                            fetch('{{ route('notifications.destroy', $notifId) }}', {
                                                method: 'DELETE',
                                                headers: {
                                                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                                                    'Accept': 'application/json',
                                                },
                                            }).then(() => show = false)
                                        "
                                        type="button"
                                        class="text-red-500 hover:text-red-700 text-xs ml-2">
                                        ✕
                                    </button>
                                </li>
                            @empty
                                <li class="px-2 py-1 text-sm text-yellow-800 dark:text-yellow-200 flex items-center space-x-2">
                                    <span>⛏️</span>
                                    <span>Belum ada notifikasi dari Administrator.</span>
                                </li>
                            @endforelse
                        </ul>
                    </template>
                </li>

                @php
                $user = Auth::user();
                @endphp
                
                <!-- Profile menu -->
                <li class="relative">
                    <button @click="toggleProfileMenu" @keydown.escape="closeProfileMenu" aria-label="Account" aria-haspopup="true" class="relative align-middle rounded-full focus:outline-none focus:shadow-outline-purple">
                        <img class="object-cover w-8 h-8 rounded-full" src="{{ asset('assets/img/foto.jpg') }}" alt="" aria-hidden="true">
                    </button>
                    <template x-if="isProfileMenuOpen">
                        <ul
                            x-data="{
                                greetingsTop: [
                                    '👷‍♂️ Halo Operator Lapangan!',
                                    '🚜 Hai Pengawas Alat Berat!',
                                    '🛠️ Siap kerja keras hari ini?',
                                    '⛏️ Selamat bertugas di lapangan!',
                                    '💪 Semangat kerja, pejuang tambang!',
                                    '🔧 Hai, siap rawat alat hari ini?',
                                    '👷 Hai Operator, tetap waspada ya!',
                                    '🧱 Halo penjaga titik-titik penting!',
                                    '🌄 Pagi cerah buat yang di lapangan!',
                                    '🧢 Selamat datang, sang pengendali lapangan!'
                                ],
                                greetingsBottom: [
                                    '👷‍♂️ Jangan lupa cek kondisi alat ya!',
                                    '🚧 Pastikan area kerja aman!',
                                    '💼 Laporkan bila ada kendala ya!',
                                    '🛠️ Jaga koordinasi dengan tim lain juga ya!',
                                    '🔍 Yuk cek pergerakan alat hari ini!',
                                    '🧭 Jangan sampai titik koordinat terlewat!',
                                    '📡 Pastikan sinyal monitoring lancar!',
                                    '📋 Catat kondisi lapangan dengan teliti ya!',
                                    '🧯 Tetap utamakan keselamatan kerja!',
                                    '📦 Siap kontrol logistik alat berat?'
                                ],
                                randomTop: '',
                                randomBottom: ''
                            }"
                                                    x-init="
                                randomTop = greetingsTop[Math.floor(Math.random() * greetingsTop.length)];
                                randomBottom = greetingsBottom[Math.floor(Math.random() * greetingsBottom.length)];
                            "
                            x-transition:enter="transition ease-out duration-200"
                            x-transition:enter-start="opacity-0 scale-95"
                            x-transition:enter-end="opacity-100 scale-100"
                            x-transition:leave="transition ease-in duration-150"
                            x-transition:leave-start="opacity-100 scale-100"
                            x-transition:leave-end="opacity-0 scale-95"
                            @click.away="closeProfileMenu"
                            @keydown.escape="closeProfileMenu"
                            class="absolute right-0 w-64 p-3 mt-2 space-y-3 text-sm text-gray-600 bg-white border border-gray-100 rounded-md shadow-md dark:text-gray-300 dark:border-gray-700 dark:bg-gray-800">
                            <!-- Greeting Atas -->
                            <li>
                                <div class="px-2 py-1 font-semibold text-purple-700 dark:text-purple-300" x-text="randomTop"></div>
                            </li>

                            <!-- Username -->
                            <li class="flex items-center gap-2 px-2 py-1">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-blue-500" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0ZM4.501 20.118a7.5 7.5 0 0 1 14.998 0A17.933 17.933 0 0 1 12 21.75c-2.676 0-5.216-.584-7.499-1.632Z" />
                                </svg>
                                <span class="font-medium text-gray-800 dark:text-gray-200">{{ $user->username }}</span>
                            </li>

                            <!-- Role -->
                            <li class="flex items-center gap-2 px-2 py-1">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-purple-500" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M16.5 10.5V6.75a4.5 4.5 0 1 0-9 0v3.75m-.75 11.25h10.5a2.25 2.25 0 0 0 2.25-2.25v-6.75a2.25 2.25 0 0 0-2.25-2.25H6.75a2.25 2.25 0 0 0-2.25 2.25v6.75a2.25 2.25 0 0 0 2.25 2.25Z" />
                                </svg>
                                <span class="font-medium text-gray-800 dark:text-gray-200">
                                    Operator Lapangan
                                </span>
                            </li>

                            <!-- Greeting Bawah -->
                            <li>
                                <div class="px-2 py-1 font-semibold text-purple-700 dark:text-purple-300" x-text="randomBottom"></div>
                            </li>
                        </ul>
                    </template>
                </li>
            </ul>
        </div>
    </header>
</div>