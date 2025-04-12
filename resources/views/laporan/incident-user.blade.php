<x-layouts>
    <x-slot:title>{{$title}}</x-slot:title>
    <!-- Table -->
    <!-- Container Search + Filter + Export -->
    <div class="flex items-center justify-between flex-wrap gap-2 p-4 bg-gray-50 dark:bg-gray-800 border-t dark:border-gray-700">

        <!-- Search bar (dipendekin) -->
        <div class="flex-1 max-w-md">
            <div class="relative">
                <div class="absolute inset-y-0 left-0 flex items-center pl-2">
                    <svg class="w-5 h-5 text-gray-500 dark:text-gray-400" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z" clip-rule="evenodd" />
                    </svg>
                </div>
                <input type="text" id="simple-search" class="w-full pl-8 pr-2 text-sm text-gray-900 placeholder-gray-600 bg-gray-100 border-0 rounded-md dark:placeholder-gray-400 dark:bg-gray-700 focus:placeholder-gray-500 dark:focus:placeholder-gray-600 focus:bg-white dark:focus:bg-gray-600 focus:border-purple-300 focus:outline-none form-input" placeholder="Cari..." required>
            </div>
        </div>

        <!-- Filter + Export -->
        <div class="flex items-center gap-2">
            <!-- Dropdown Filter -->
            <form method="GET" action="{{ route('incident-user.index') }}">
                <select name="filter" onchange="this.form.submit()" class="text-sm rounded-lg border border-gray-300 focus:ring-purple-500 focus:border-purple-500 p-2 bg-gray-100 dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                    <option value="daily" {{ request('filter') == 'daily' ? 'selected' : '' }}>Hari Ini</option>
                    <option value="weekly" {{ request('filter') == 'weekly' ? 'selected' : '' }}>Minggu Ini</option>
                    <option value="monthly" {{ request('filter') == 'monthly' ? 'selected' : '' }}>Bulan Ini</option>
                    <option value="all" {{ request('filter') == 'all' ? 'selected' : '' }}>Semua</option>
                </select>
            </form>

            <!-- Tombol Export -->
            <a href="#">
                <button type="button" class="flex items-center justify-center text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-4 py-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="h-3.5 w-3.5 mr-2" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M3 16.5v2.25A2.25 2.25 0 0 0 5.25 21h13.5A2.25 2.25 0 0 0 21 18.75V16.5M16.5 12 12 16.5m0 0L7.5 12m4.5 4.5V3" />
                    </svg>
                    Export
                </button>
            </a>
        </div>
    </div>


        <div class="max-w-screen-lg mx-auto">
            <div class="w-full overflow-x-auto">
                <table class="whitespace-normal table-auto min-w-full">
                    <thead>
                        <!-- Baris Pertama -->
                        <tr class="text-xs font-semibold tracking-wide text-left text-gray-500 uppercase border-b dark:border-gray-700 bg-gray-50 dark:text-gray-400 dark:bg-gray-800">
                            <th class="px-2 py-1 text-center break-words">No</th>
                            <th class="px-2 py-1 text-center break-words">victim Name</th>
                            <th class="px-2 py-1 text-center break-words">Incident Type</th>
                            <th class="px-2 py-1 text-center break-words">Incident Date and Time</th>
                            <th class="px-2 py-1 text-center break-words">Incident Location</th>
                            <th class="px-2 py-1 text-center break-words">Incident Description</th>
                            <th class="px-2 py-1 text-center break-words">Reported By</th>
                            <th class="px-2 py-1 text-center break-words">Status</th>
                            <th class="px-2 py-1 text-center break-words">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y dark:divide-gray-700 dark:bg-gray-800">
                        @if ($incident_users->isEmpty())
                        <tr class="text-gray-700 dark:text-gray-400">
                            <td colspan="10" class="px-2 py-1 text-center text-gray-500">Tidak Ada Data Insiden Hari ini</td>
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
                                    <td class="px-2 py-1 text-xs text-center">
                                        {{ $incident_user->user_report->incident_description ?? 'Data tidak tersedia'}}
                                    </td>
                                    <td class="px-2 py-1 text-xs text-center">
                                        {{ $incident_user->user_report->report_by ?? 'Data tidak tersedia'}}
                                    </td>
                                    <!-- Status -->
                                    <td class="px-2 py-1 text-xs text-center">
                                        @if ($incident_user->status === 'pending')
                                            <span class="relative group inline-block">
                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6 text-yellow-500 inline">
                                                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6h4.5m4.5 0a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                                                </svg>
                                                <div class="absolute z-10 bottom-full left-1/2 -translate-x-1/2 mb-1 
                                                            hidden group-hover:block bg-black text-white text-[10px] 
                                                            px-2 py-1 rounded shadow-lg">
                                                    Pending
                                                </div>
                                            </span>
                                        @elseif ($incident_user->status === 'in_progress')
                                            <span class="relative group inline-block">
                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6 text-blue-500 animate-spin inline">
                                                    <path stroke-linecap="round" stroke-linejoin="round" d="M16.023 9.348h4.992v-.001M2.985 19.644v-4.992m0 0h4.992m-4.993 0 3.181 3.183a8.25 8.25 0 0 0 13.803-3.7M4.031 9.865a8.25 8.25 0 0 1 13.803-3.7l3.181 3.182m0-4.991v4.99" />
                                                </svg>
                                                <div class="absolute z-10 bottom-full left-1/2 -translate-x-1/2 mb-1 
                                                            hidden group-hover:block bg-black text-white text-[10px] 
                                                            px-2 py-1 rounded shadow-lg">
                                                    In Progress
                                                </div>
                                            </span>
                                        @elseif ($incident_user->status === 'closed')
                                            <span class="relative group inline-block">
                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6 text-green-500 inline">
                                                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75 11.25 15 15 9.75M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                                                </svg>
                                                <div class="absolute z-10 bottom-full left-1/2 -translate-x-1/2 mb-1 
                                                            hidden group-hover:block bg-black text-white text-[10px] 
                                                            px-2 py-1 rounded shadow-lg">
                                                    Done
                                                </div>
                                            </span>
                                        @else
                                            <span class="relative group inline-block">
                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6 text-gray-500 inline">
                                                    <path stroke-linecap="round" stroke-linejoin="round" d="m11.25 11.25.041-.02a.75.75 0 0 1 1.063.852l-.708 2.836a.75.75 0 0 0 1.063.853l.041-.021M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Zm-9-3.75h.008v.008H12V8.25Z" />
                                                </svg>  
                                                <div class="absolute z-10 bottom-full left-1/2 -translate-x-1/2 mb-1 
                                                            hidden group-hover:block bg-black text-white text-[10px] 
                                                            px-2 py-1 rounded shadow-lg">
                                                    None
                                                </div>
                                            </span>
                                        @endif
                                    </td>
                                    <!-- Actions -->
                                     <td class="px-2 py-1 text-xs text-center">
                                        <div class="flex justify-center space-x-2">
                                            <!-- Show Details -->
                                            <a href="#"
                                            class="inline-block text-gray-500 hover:text-blue-600 transition-colors duration-200">
                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-5">
                                                    <path stroke-linecap="round" stroke-linejoin="round" d="M2.036 12.322a1.012 1.012 0 0 1 0-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178Z" />
                                                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                                                </svg>
                                            </a>
                                            <!-- Edit -->
                                            <button class="inline-block text-gray-500 hover:text-yellow-600 transition-colors duration-200">
                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-5">
                                                    <path stroke-linecap="round" stroke-linejoin="round" d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L10.582 16.07a4.5 4.5 0 0 1-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 0 1 1.13-1.897l8.932-8.931Zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0 1 15.75 21H5.25A2.25 2.25 0 0 1 3 18.75V8.25A2.25 2.25 0 0 1 5.25 6H10" />
                                                </svg>
                                            </button>
                                            <!-- Delete -->
                                            <button class="inline-block text-gray-500 hover:text-red-600 transition-colors duration-200">
                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-5">
                                                    <path stroke-linecap="round" stroke-linejoin="round" d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0" />
                                                </svg>
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        @endif
                    </tbody>
                </table>
            </div>
            <!-- Pagination & Showing -->
            <div class="grid px-4 py-3 text-xs font-semibold tracking-wide text-gray-500 uppercase border-t dark:border-gray-700 bg-gray-50 sm:grid-cols-9 dark:text-gray-400 dark:bg-gray-800">
                <!--  Showing -->
                <span class="flex items-center col-span-3">
                    Showing {{ $incident_users->firstItem() }} to {{ $incident_users->lastItem() }} of {{ $incident_users->total() }} Entries
                </span>
                <span class="col-span-2"></span>
                <!-- Pagination -->
                <div class="col-span-4 flex items-center justify-end space-x-2">
                    @if ($incident_users->onFirstPage())
                        <span class="px-4 py-2 text-gray-500 bg-gray-700 rounded-md cursor-not-allowed">Previous</span>
                    @else
                        <a href="{{ $incident_users->previousPageUrl() }}" class="px-4 py-2 text-gray-500 bg-gray-200 rounded-md hover:bg-gray-300">Previous</a>
                    @endif
                        <span class="text-gray-300">Page {{ $incident_users->currentPage() }} of {{ $incident_users->lastPage() }}</span>
                    @if ($incident_users->hasPages())
                        <a href="{{ $incident_users->nextPageUrl() }}" class="px-4 py-2 text-gray-500 bg-gray-200 rounded-md hover:bg-gray-300">Next</a>
                    @else
                        <span class="px-4 py-2 text-gray-500 bg-gray-700 rounded-md cursor-not-allowed">Next</span>
                    @endif
                 </div>
            </div>
        </div>
    </div>
    <br>
</x-layouts>