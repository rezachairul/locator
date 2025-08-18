@php
    $notifications = auth()->user()->unreadNotifications;
@endphp

<div class="flex flex-col flex-1 w-full">
    <!-- It is quality rather than quantity that matters. - Lucius Annaeus Seneca -->
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

                <!-- Notifications Admin -->
                <li class="relative" x-data="{ open: false }">
                    @php
                        $latest = auth()->user()->unreadNotifications->first();
                        $color = 'text-gray-600'; // default

                        if ($latest) {
                            switch ($latest->data['injury_category'] ?? null) {
                                case 'ringan': $color = 'text-green-500'; break;
                                case 'sedang': $color = 'text-yellow-500'; break;
                                case 'berat':  $color = 'text-orange-500'; break;
                                case 'fatal':  $color = 'text-red-600'; break;
                            }
                        }
                    @endphp

                    {{-- Bell button --}}
                    <button @click="open = !open" class="relative p-2 rounded-full focus:outline-none">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" 
                            stroke-width="1.5" stroke="currentColor" 
                            class="size-5 {{ $color }}">
                            <path stroke-linecap="round" stroke-linejoin="round" 
                                d="M14.857 17.082a23.848 23.848 0 0 0 5.454-1.31A8.967 
                                    8.967 0 0 1 18 9.75V9A6 6 0 0 0 6 9v.75a8.967 
                                    8.967 0 0 1-2.312 6.022c1.733.64 3.56 
                                    1.085 5.455 1.31m5.714 0a24.255 
                                    24.255 0 0 1-5.714 0m5.714 0a3 
                                    3 0 1 1-5.714 0" />
                        </svg>

                        @php
                            $injury = $latest->data['injury_category'] ?? null;
                            $badgeClass = match($injury) {
                                'ringan' => 'bg-green-500 text-green-100',
                                'sedang' => 'bg-yellow-500 text-yellow-100',
                                'berat'  => 'bg-orange-500 text-orange-100',
                                'fatal'  => 'bg-red-600 text-red-100',
                                default  => 'bg-gray-300 text-gray-700'
                            };
                        @endphp

                        <span id="admin-unread-count"
                            class="absolute top-0 right-0 inline-flex items-center justify-center 
                                    px-2 py-1 text-xs font-bold leading-none rounded-full {{ $badgeClass }}">
                            {{ Auth::user()->unreadNotifications->count() }}
                        </span>
                    </button>

                    <!-- Dropdown -->
                    <div x-show="open" @click.away="open=false"
                        class="absolute right-0 mt-2 w-80 bg-white border rounded shadow-lg z-50">

                        @if(auth()->user()->notifications->isEmpty())
                            <div class="p-6 flex flex-col items-center justify-center text-gray-500">
                                <!-- Ikon  -->
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-8 text-yellow-600 mb-2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M10.34 15.84c-.688-.06-1.386-.09-2.09-.09H7.5a4.5 4.5 0 1 1 0-9h.75c.704 0 1.402-.03 2.09-.09m0 9.18c.253.962.584 1.892.985 2.783.247.55.06 1.21-.463 1.511l-.657.38c-.551.318-1.26.117-1.527-.461a20.845 20.845 0 0 1-1.44-4.282m3.102.069a18.03 18.03 0 0 1-.59-4.59c0-1.586.205-3.124.59-4.59m0 9.18a23.848 23.848 0 0 1 8.835 2.535M10.34 6.66a23.847 23.847 0 0 0 8.835-2.535m0 0A23.74 23.74 0 0 0 18.795 3m.38 1.125a23.91 23.91 0 0 1 1.014 5.395m-1.014 8.855c-.118.38-.245.754-.38 1.125m.38-1.125a23.91 23.91 0 0 0 1.014-5.395m0-3.46c.495.413.811 1.035.811 1.73 0 .695-.316 1.317-.811 1.73m0-3.46a24.347 24.347 0 0 1 0 3.46" />
                                </svg>
                                <p class="text-sm font-medium text-gray-600">
                                    Tidak ada notifikasi
                                </p>
                                <p class="text-xs text-gray-400">
                                    Area tambang aman, tidak ada laporan ⚒️
                                </p>
                            </div>
                        @else
                            <ul class="divide-y divide-gray-200 max-h-64 overflow-y-auto" id="admin-notification-list">
                                @foreach(auth()->user()->notifications as $notification)
                                    @php
                                        $badgeColor = match($notification->data['injury_category'] ?? '') {
                                            'ringan' => 'bg-green-500',
                                            'sedang' => 'bg-yellow-500',
                                            'berat'  => 'bg-orange-500',
                                            'fatal'  => 'bg-red-600',
                                            default  => 'bg-gray-400'
                                        };
                                    @endphp

                                    <li class="p-3 hover:bg-gray-100 flex items-start gap-2">
                                        {{-- Dot indikator --}}
                                        <span class="w-2.5 h-2.5 mt-1 rounded-full {{ $badgeColor }}"></span>

                                        {{-- Konten --}}
                                        <a href="{{ $notification->data['url'] }}" class="flex-1">
                                            <div class="flex items-center justify-between">
                                                <div class="text-sm font-medium text-gray-700">
                                                    {{ $notification->data['title'] ?? 'Notifikasi' }}
                                                </div>
                                                <span class="text-xs text-gray-400 whitespace-nowrap">
                                                    {{ $notification->updated_at->format('H:i') }}
                                                </span>
                                            </div>
                                            <div class="text-xs text-gray-500">
                                                {{ $notification->data['body'] ?? $notification->data['message'] }}
                                            </div>
                                        </a>

                                        {{-- Button hapus --}}
                                        <button type="button"
                                            @click.stop="
                                                fetch('{{ route('notifications.destroy', $notification) }}', {
                                                    method: 'DELETE',
                                                    headers: {
                                                        'X-CSRF-TOKEN': '{{ csrf_token() }}',
                                                        'Accept': 'application/json',
                                                    },
                                                }).then(() => {
                                                    $el.closest('li').remove();
                                                    let badge = document.getElementById('admin-unread-count');
                                                    badge.innerText = parseInt(badge.innerText) - 1;
                                                    if (badge.innerText == '0') badge.classList.add('hidden');
                                                });
                                            "
                                            class="ml-2 text-gray-400 hover:text-red-500">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" 
                                                viewBox="0 0 24 24" stroke-width="1.5" 
                                                stroke="currentColor" class="w-4 h-4">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12"/>
                                            </svg>
                                        </button>
                                    </li>
                                @endforeach
                            </ul>
                        @endif
                    </div>
                </li>

                @php
                $user = Auth::user();
                @endphp

                <!-- Profile menu Administrator -->
                <li class="relative">
                    <button @click="toggleProfileMenu" @keydown.escape="closeProfileMenu" aria-label="Account" aria-haspopup="true" class="relative align-middle rounded-full focus:outline-none focus:shadow-outline-purple">
                        <img class="object-cover w-8 h-8 rounded-full" src="{{ asset('assets/img/profile-admin.jpg') }}" alt="" aria-hidden="true">
                    </button>
                    <template x-if="isProfileMenuOpen">
                        <ul
                            x-data="{
                                greetingsTop: [
                                    '👷‍♂️ Halo Administrator',
                                    '⛏️ Halo Admin Tambang',
                                    '👷‍♂️ Hai Bos Tambang',
                                    '🛠️ Halo Admin',
                                    '👷‍♂️ Halo Admin',
                                    '🚧 Halo Admin',
                                    '👷 Halo Administrator',
                                    '💼 Selamat datang, Admin!',
                                    '🏗️ Halo Admin',
                                    '👷‍♂️ Halo, pejuang tambang!'
                                ],
                                greetingsBottom: [
                                    '👷‍♂️ Siap pantau alat berat hari ini?',
                                    '⛏️ Jangan lupa cek titik persebaran ya!',
                                    '👷‍♂️ Semangat ngawasin operasional hari ini!',
                                    '🛠️ Mari jaga kelancaran tambang bareng-bareng!',
                                    '👷‍♂️ Alat berat nunggu dicek tuh!',
                                    '🚧 Yuk pastikan semua titik aman dan terkendali!',
                                    '👷 Semangat terus jaga ritme tambang!',
                                    '💼 Saatnya kontrol area kerja kita.',
                                    '🏗️ Siap monitor pergerakan hari ini?',
                                    '👷‍♂️ Saatnya cek sistem dan lokasi!'
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
                                    @if ($user->role === 'admin')
                                    Administrator
                                    @elseif ($user->role === 'operator')
                                    Operator Lapangan
                                    @else
                                    {{ ucfirst($user->role) }}
                                    @endif
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

<script>
    // Admin listen
    Echo.private('App.Models.User.{{ $user->id }}')
        .notification((notification) => {
            let list = document.getElementById('admin-notification-list');
            let count = document.getElementById('admin-unread-count');

            let item = `<li class="p-3 hover:bg-gray-100">
                          <a href="${notification.url}">
                            <div class="text-sm font-medium text-gray-700">${notification.title ?? 'Notifikasi'}</div>
                            <div class="text-xs text-gray-500">${notification.body ?? notification.message}</div>
                          </a>
                        </li>`;
            list.insertAdjacentHTML('afterbegin', item);
            count.innerText = parseInt(count.innerText) + 1;
        });

    // Operator listen
    Echo.private('App.Models.User.{{ $user->id }}')
        .notification((notification) => {
            let list = document.getElementById('operator-notification-list');
            let count = document.getElementById('operator-unread-count');

            let item = `<li class="p-3 hover:bg-gray-100">
                          <a href="${notification.url}">
                            <div class="text-sm font-medium text-gray-700">${notification.title ?? 'Notifikasi'}</div>
                            <div class="text-xs text-gray-500">${notification.body ?? notification.message}</div>
                          </a>
                        </li>`;
            list.insertAdjacentHTML('afterbegin', item);
            count.innerText = parseInt(count.innerText) + 1;
        });
</script>
