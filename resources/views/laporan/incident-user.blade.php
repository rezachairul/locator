<x-layouts>
    <x-slot:title>{{$title}}</x-slot:title>
    <!-- Table -->
    <div class="w-full overflow-hidden rounded-lg shadow-xs">
        <div class="flex items-center justify-between flex-wrap gap-2 p-4 bg-gray-50 dark:bg-gray-800 border-t dark:border-gray-700">
            <!-- Bagian Pencarian -->
            <div class="flex flex-1 lg:mr-32">
                <div class="relative w-full max-w-xl">
                    <div class="absolute inset-y-0 left-0 flex items-center pl-2">
                        <svg class="w-5 h-5 text-gray-500 dark:text-gray-400" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd" d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z" clip-rule="evenodd" />
                        </svg>
                    </div>
                    <input type="text" id="simple-search" class="w-full pl-8 pr-2 text-sm text-gray-900 placeholder-gray-600 bg-gray-100 border-0 rounded-md dark:placeholder-gray-400 dark:bg-gray-700 focus:placeholder-gray-500 dark:focus:placeholder-gray-600 focus:bg-white dark:focus:bg-gray-600 focus:border-purple-300 focus:outline-none form-input" placeholder="Cari" required>
                </div>
            </div>
            <!-- Bagian Tombol -->
            <div class="flex gap-2">
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
                            <th class="px-2 py-1 text-center break-words">Reported Date and Time</th>
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
                                    <td class="px-2 py-1 text-xs text-center">
                                        {{ $incident_user->user_report->report_date_time ?? 'Data tidak tersedia'}}
                                    </td>
                                    <td class="px-2 py-1 text-xs text-center">{{ 'Belum Tertutup' }}</td>
                                    <td class="px-2 py-1 text-xs text-center">{{ 'Show' }}</td>
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
                    Showing 1-10 of 100
                </span>
                <span class="col-span-2"></span>
                <!-- Pagination -->
                 <div class="col-span-4 flex items-center justify-end space-x-2">
                    @if ($incident_users->onFirstPagePages())
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