<x-admin.layouts>
    <x-slot:title>{{$title}}</x-slot:title>

    <!-- Table -->
    <h4 class="mb-4 text-lg font-semibold text-gray-600 dark:text-gray-300">
        Table {{$title}}
    </h4>
    <div class="w-full overflow-hidden rounded-lg shadow-xs">
        <div class="flex items-center justify-between flex-wrap gap-2 p-4 bg-gray-50 dark:bg-gray-800 border-t dark:border-gray-700">
            <!-- Bagian Pencarian -->
            <div class="flex flex-1 lg:mr-32">
                <div class="relative w-full max-w-xl">
                    <!-- Ikon Search di kiri -->
                    <div class="absolute inset-y-0 left-0 flex items-center pl-2">
                        <svg class="w-5 h-5 text-gray-500 dark:text-gray-400" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd" d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z" clip-rule="evenodd" />
                        </svg>
                    </div>

                    <!-- Input -->
                    <input id="search-input" type="text"
                        value="{{ request('search') }}"
                        data-url="{{ route('admin.operasional.dumping.index') }}"
                        data-target="dumping-tbody"
                        class="w-full pl-8 pr-8 text-sm text-gray-100 placeholder-gray-600 bg-gray-100 border-0 rounded-md dark:placeholder-gray-400 dark:bg-gray-700 focus:placeholder-gray-500 dark:focus:placeholder-gray-600 focus:bg-white dark:focus:bg-gray-600 focus:border-purple-300 focus:outline-none form-input"
                        placeholder="Search for {{ $title }}..." />

                    <!-- Ikon Refresh di kanan -->
                    <div id="refresh-button" class="absolute inset-y-0 right-0 flex items-center pr-2 cursor-pointer" onclick="location.reload()">
                        <svg class="w-5 h-5 text-gray-500 dark:text-gray-400" xmlns="http://www.w3.org/2000/svg" fill="none"
                            viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M16.023 9.348h4.992v-.001M2.985 19.644v-4.992m0 0h4.992m-4.993 0 3.181 3.183a8.25 8.25 0 0 0 13.803-3.7M4.031 9.865a8.25 8.25 0 0 1 13.803-3.7l3.181 3.182m0-4.991v4.99" />
                        </svg>
                    </div>
                </div>
            </div>

            <!-- Bagian Tombol -->
            <div class="flex gap-2">
                <!-- Tombol Create -->
                <button id="defaultModalButton" data-modal-target="defaultModal" data-modal-toggle="defaultModal" type="button" class="flex items-center justify-center text-white bg-amber-700 hover:bg-amber-800 focus:ring-4 focus:ring-amber-300 font-medium rounded-lg text-sm px-4 py-2 dark:bg-amber-600 dark:hover:bg-amber-700 focus:outline-none dark:focus:ring-amber-800">
                    <svg class="h-3.5 w-3.5 mr-2" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                        <path clip-rule="evenodd" fill-rule="evenodd" d="M10 3a1 1 0 011 1v5h5a1 1 0 110 2h-5v5a1 1 0 11-2 0v-5H4a1 1 0 110-2h5V4a1 1 0 011-1z" />
                    </svg>
                    Create
                </button>
            </div>
        </div>
        <div class="w-full overflow-x-auto">
            <table class="w-full whitespace-no-wrap">
                <thead>
                    <tr class="text-xs font-semibold tracking-wide text-left text-gray-500 uppercase border-b dark:border-gray-700 bg-gray-50 dark:text-gray-400 dark:bg-gray-800">
                        <th class="px-4 py-3 text-center" rowspan="2">No</th>
                        <th class="px-4 py-3 text-center" rowspan="2">Disposial</th>
                        <th class="px-4 py-3 text-center" rowspan="2">Easting</th>
                        <th class="px-4 py-3 text-center" rowspan="2">Northing</th>
                        <th class="px-4 py-3 text-center" colspan="2">Elevation</th>
                        <th class="px-4 py-3 text-center" rowspan="2">Date</th>
                        <th class="px-4 py-3 text-center" rowspan="2">Actions</th>
                    </tr>
                    <tr class="text-xs font-semibold tracking-wide text-left text-gray-500 uppercase border-b dark:border-gray-700 bg-gray-50 dark:text-gray-400 dark:bg-gray-800">
                        <th class="px-4 py-3 text-center">RL</th>
                        <th class="px-4 py-3 text-center">Actual</th>
                    </tr>
                </thead>
                <tbody id="dumping-tbody" class="bg-white divide-y dark:divide-gray-700 dark:bg-gray-800">
                    @include('admin.operasional.dumping.partials.table_body')
                </tbody>
            </table>
        </div>
        <!-- Pagination & Showing-->
        <div class="grid px-4 py-3 text-xs font-semibold tracking-wide text-gray-500 uppercase border-t dark:border-gray-700 bg-gray-50 sm:grid-cols-9 dark:text-gray-400 dark:bg-gray-800">
            <!-- Showing -->
            <span class="flex items-center col-span-3">
                Showing {{ $dumpings->firstItem() }} - {{ $dumpings->lastItem() }} out of {{ $dumpings->total() }}
            </span>
            <span class="col-span-2"></span>
            <!-- Pagination -->
            <div class="col-span-4 flex items-center justify-end space-x-2">
                @if ($dumpings->onFirstPage())
                <span class="px-4 py-2 text-gray-500 bg-gray-700 rounded-md cursor-not-allowed">Previous</span>
                @else
                <a href="{{ $dumpings->previousPageUrl() }}" class="px-4 py-2 text-gray-500 bg-gray-200 rounded-md hover:bg-gray-300">Previous</a>
                @endif
                <span class="text-gray-300">Page {{ $dumpings->currentPage() }} of {{ $dumpings->lastPage() }}</span>
                @if ($dumpings->hasMorePages())
                <a href="{{ $dumpings->nextPageUrl() }}" class="px-4 py-2 text-gray-500 bg-gray-200 rounded-md hover:bg-gray-300">Next</a>
                @else
                <span class="px-4 py-2 text-gray-500 bg-gray-700 rounded-md cursor-not-allowed">Next</span>
                @endif
            </div>
        </div>
        <!-- Modals Create & Update -->
        @include('admin.operasional.dumping.create')
        @include('admin.operasional.dumping.update')
    </div>
    </div>
</x-admin.layouts>