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
                
                <!-- Notifications Operator -->
                <li class="relative" x-data="{ open: false }">
                    <button id="operator-bell-icon" id="operator-bell-icon" @click="open = !open" class="relative p-2 rounded-full text-gray-600 hover:text-purple-600 focus:outline-none">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15 17h5l-1.405-1.405M19 13V8a7 7 0 10-14 0v5L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"/>
                        </svg>
                        @php
                            $latest = Auth::user()->unreadNotifications->first();
                            $status = $latest->data['status'] ?? null;

                            switch ($status) {
                                case 'pending':
                                    $badgeClass = 'bg-yellow-500 text-yellow-100';
                                    break;
                                case 'in_progress':
                                    $badgeClass = 'bg-blue-500 text-blue-100';
                                    break;
                                case 'closed':
                                    $badgeClass = 'bg-green-500 text-green-100';
                                    break;
                                default:
                                    $badgeClass = 'bg-gray-300 text-gray-700'; // none / default
                            }
                        @endphp
                        <span id="operator-unread-count"
                            class="absolute top-0 right-0 inline-flex items-center justify-center px-2 py-1 text-xs font-bold 
                            leading-none rounded-full {{ $badgeClass }}">
                            {{ Auth::user()->unreadNotifications->count() }}
                        </span>
                    </button>

                    <!-- Dropdown -->
                    <div x-show="open" @click.away="open=false" class="absolute right-0 mt-2 w-80 bg-white border rounded shadow-lg z-50">
                        <ul class="divide-y divide-gray-200 max-h-64 overflow-y-auto" id="operator-notification-list">
                            @forelse(auth()->user()->notifications as $notification)
                                @php $status = $notification->data['status'] ?? 'none'; @endphp

                                <li class="flex items-start justify-between p-3 hover:bg-gray-100 gap-2">
                                    {{-- Link area (title, waktu, body) --}}
                                    <a href="{{ $notification->data['url'] }}" class="flex-1 flex items-start gap-2">
                                        {{-- Status Icon --}}
                                        <span class="mt-1">
                                            @if ($status === 'pending')
                                                <svg class="w-5 h-5 text-yellow-500" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6h4.5m4.5 0a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z"/>
                                                </svg>
                                            @elseif ($status === 'in_progress')
                                                <svg class="w-5 h-5 text-blue-500 animate-spin" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" d="M16.023 9.348h4.992v-.001M2.985 19.644v-4.992m0 0h4.992m-4.993 0 3.181 3.183a8.25 8.25 0 0 0 13.803-3.7M4.031 9.865a8.25 8.25 0 0 1 13.803-3.7l3.181 3.182m0-4.991v4.99"/>
                                                </svg>
                                            @elseif ($status === 'closed')
                                                <svg class="w-5 h-5 text-green-500" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75 11.25 15 15 9.75M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z"/>
                                                </svg>
                                            @else
                                                <svg class="w-5 h-5 text-gray-500" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" d="m11.25 11.25.041-.02a.75.75 0 0 1 1.063.852l-.708 2.836a.75.75 0 0 0 1.063.853l.041-.021M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Zm-9-3.75h.008v.008H12V8.25Z"/>
                                                </svg>
                                            @endif
                                        </span>

                                        {{-- Konten notif --}}
                                        <div class="flex-1">
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
                                        </div>
                                    </a>

                                    {{-- Tombol hapus --}}
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
                                                let badge = document.getElementById('operator-unread-count');
                                                badge.innerText = parseInt(badge.innerText) - 1;
                                                if (badge.innerText == '0') badge.classList.add('hidden');
                                            });
                                        "
                                        class="ml-2 text-gray-400 hover:text-red-500">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12"/>
                                        </svg>
                                    </button>
                                </li>
                            @empty
                                <li class="p-4 text-center text-gray-600 mb-1">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6 text-gray-600 mb-1">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="m11.25 11.25.041-.02a.75.75 0 0 1 1.063.852l-.708 2.836a.75.75 0 0 0 1.063.853l.041-.021M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Zm-9-3.75h.008v.008H12V8.25Z" />
                                    </svg>
                                    Tidak ada notifikasi untuk saat ini.<br>
                                </li>
                            @endforelse
                        </ul>
                    </div>
                </li>

                @php
                $user = Auth::user();
                @endphp
                
                <!-- Profile menu -->
                <li class="relative">
                    <button @click="toggleProfileMenu" @keydown.escape="closeProfileMenu" aria-label="Account" aria-haspopup="true" class="relative align-middle rounded-full focus:outline-none focus:shadow-outline-purple">
                        <img class="object-cover w-8 h-8 rounded-full" src="{{ asset('assets/img/profile-operator.jpg') }}" alt="" aria-hidden="true">
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

<script>
    Echo.private('App.Models.User.{{ $user->id }}')
        .notification((notification) => {
            let list = document.getElementById('operator-notification-list');
            let count = document.getElementById('operator-unread-count');
            let bell = document.getElementById('operator-bell-icon');

            // tambahkan data-status
            let item = `<li class="p-3 hover:bg-gray-100" data-status="${notification.status ?? 'none'}">
                            <a href="${notification.url}">
                                <div class="text-sm font-medium text-gray-700">${notification.title ?? 'Notifikasi'}</div>
                                <div class="text-xs text-gray-500">${notification.body ?? notification.message}</div>
                            </a>
                            <button type="button" class="ml-2 text-gray-400 hover:text-red-500"
                                    onclick="deleteNotification('${notification.id}', this)">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12"/>
                                </svg>
                            </button>
                        </li>`;
            list.insertAdjacentHTML('afterbegin', item);

            // update badge count
            count.innerText = parseInt(count.innerText) + 1;
            count.classList.remove('hidden');

            // update bell color
            bell.classList.remove('text-yellow-500','text-blue-500','text-green-500','text-gray-300');
            switch(notification.status){
                case 'pending': bell.classList.add('text-yellow-500'); break;
                case 'in_progress': bell.classList.add('text-blue-500'); break;
                case 'closed': bell.classList.add('text-green-500'); break;
                default: bell.classList.add('text-gray-300'); break;
            }
        });

    // delete via fetch
    function deleteNotification(id, el) {
        fetch(`/notifications/${id}`, {
            method: 'DELETE',
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                'Accept': 'application/json'
            }
        }).then(() => {
            let li = el.closest('li');
            li.remove();

            // update badge
            let badge = document.getElementById('operator-unread-count');
            badge.innerText = parseInt(badge.innerText) - 1;
            if(badge.innerText == '0') badge.classList.add('hidden');

            // update bell color ke notif terbaru
            let latest = document.querySelector('#operator-notification-list li:first-child')?.dataset.status || 'none';
            let bell = document.getElementById('operator-bell-icon');
            bell.classList.remove('text-yellow-500','text-blue-500','text-green-500','text-gray-300');
            switch(latest){
                case 'pending': bell.classList.add('text-yellow-500'); break;
                case 'in_progress': bell.classList.add('text-blue-500'); break;
                case 'closed': bell.classList.add('text-green-500'); break;
                default: bell.classList.add('text-gray-300'); break;
            }
        });
    }
</script>
