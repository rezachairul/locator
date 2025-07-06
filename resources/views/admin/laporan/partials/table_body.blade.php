@if ($incident_users->isEmpty())
    <tr class="text-gray-700 dark:text-gray-400">
        <td colspan="10" class="px-2 py-1 text-center text-gray-500">
            @if (request()->has('search') && request()->search != '')
                🚨 Belum ada laporan {{ $title }} dari Operator Lapangan.
            @else
                🚨 Laporan {{ $title }} yang dicari nggak ketemu.
            @endif
        </td>
    </tr>
@else
    @foreach ($incident_users as $key => $incident_user)
        <tr class="text-gray-700 dark:text-gray-400">
            <td class="px-2 py-1 text-xs text-center"> {{ $incident_users->firstItem() + $key }} </td>
            <td class="px-2 py-1 text-xs text-center">
                {{ $incident_user->user_report->victim_name ?? 'Data tidak tersedia'}}
            </td>
            <td class="px-2 py-1 text-xs text-center">
                {{ $incident_user->user_report->incident_type ?? 'Data tidak tersedia'}}
            </td>
            <td class="px-2 py-1 text-xs text-center">
                {{ $incident_user->user_report->incident_date_time ?? 'Data tidak tersedia'}}
            </td>
            <td class="px-2 py-1 text-xs text-center">
                {{ $incident_user->user_report->incident_location ?? 'Data tidak tersedia'}}
            </td>
            <td class="px-2 py-1 text-xs text-justify">
                {{ \Illuminate\Support\Str::limit($incident_user->user_report->incident_description, 50, '...') ?? 'Data tidak tersedia' }}
            </td>
            <td class="px-2 py-1 text-xs text-center">
                {{ $incident_user->user_report->report_by ?? 'Data tidak tersedia'}}
            </td>
            <!-- Status -->
            <td class="px-2 py-1 text-center">
                <div x-data="{ open: false }" class="relative inline-block text-left">
                    {{-- ✅ Tombol utama yang tampil status sekarang --}}
                    <button @click="open = !open" type="button"
                            class="w-8 h-8 flex items-center justify-center rounded border border-gray-400 dark:border-gray-600 bg-white dark:bg-gray-800">
                        <x-admin.status-icons-bar :status="$incident_user->status" />
                    </button>

                    {{-- ✅ Dropdown yang muncul saat diklik --}}
                    <div x-show="open" @click.away="open = false"
                        x-transition
                        class="absolute right-0 mt-1 w-44 rounded-md shadow-lg 
                                bg-white dark:bg-gray-800 ring-1 ring-black ring-opacity-5 z-50 
                                border border-gray-200 dark:border-gray-700 p-1 space-y-1 origin-top-right">

                        <form method="POST" action="{{ route('admin.laporan-user.updateStatus', $incident_user->id) }}">
                            @csrf
                            @method('PATCH')

                            {{-- ✅ Opsi status dalam dropdown --}}
                            @foreach (['none', 'pending', 'in_progress', 'closed'] as $statusOption)
                                <button type="submit" name="status" value="{{ $statusOption }}"
                                    class="w-full px-3 py-1.5 text-sm rounded-md hover:bg-gray-100 dark:hover:bg-gray-700 
                                        flex items-center gap-2 transition-colors duration-150">
                                    <x-admin.status-icons-bar :status="$statusOption" />
                                    <span>{{ ucfirst(str_replace('_', ' ', $statusOption)) }}</span>
                                </button>
                            @endforeach
                        </form>
                    </div>
                </div>
            </td>
            <!-- Actions -->
            <td class="px-2 py-1 text-xs text-center">
                <div class="flex justify-center space-x-2">
                    <!-- Show Details -->
                    <button class="inline-block text-gray-500 hover:text-blue-600 transition-colors duration-200">
                        <a href="{{ route('admin.laporan-user.incident-user.show', $incident_user->id) }}">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-5">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M2.036 12.322a1.012 1.012 0 0 1 0-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178Z" />
                                <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                            </svg>
                        </a>
                    </button>

                    <!-- Use Future -->
                    <!-- Edit -->
                    <!-- <button class="inline-block text-gray-500 hover:text-yellow-600 transition-colors duration-200">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L10.582 16.07a4.5 4.5 0 0 1-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 0 1 1.13-1.897l8.932-8.931Zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0 1 15.75 21H5.25A2.25 2.25 0 0 1 3 18.75V8.25A2.25 2.25 0 0 1 5.25 6H10" />
                        </svg>
                    </button> -->
                    <!-- Delete -->
                    <!-- <button class="inline-block text-gray-500 hover:text-red-600 transition-colors duration-200">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0" />
                        </svg>
                    </button> -->
                </div>
            </td>
        </tr>
    @endforeach
@endif