{{-- components/admin/status-icons-bar.blade.php --}}

@props(['status'])

@switch($status)
    @case('pending')
        <span class="relative group inline-block">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                 stroke-width="1.5" stroke="currentColor" class="size-5 text-yellow-500 inline">
                <path stroke-linecap="round" stroke-linejoin="round"
                      d="M12 6v6h4.5m4.5 0a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
            </svg>
            <div class="absolute z-10 bottom-full left-1/2 -translate-x-1/2 mb-1 hidden group-hover:block 
                        bg-black text-white text-[10px] px-2 py-1 rounded shadow-lg">
                Pending
            </div>
        </span>
        @break

    @case('in_progress')
        <span class="relative group inline-block">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                 stroke-width="1.5" stroke="currentColor" class="size-5 text-blue-500 animate-spin inline">
                <path stroke-linecap="round" stroke-linejoin="round"
                      d="M16.023 9.348h4.992v-.001M2.985 19.644v-4.992m0 0h4.992m-4.993 0 
                         3.181 3.183a8.25 8.25 0 0 0 13.803-3.7M4.031 9.865a8.25 8.25 
                         0 0 1 13.803-3.7l3.181 3.182m0-4.991v4.99" />
            </svg>
            <div class="absolute z-10 bottom-full left-1/2 -translate-x-1/2 mb-1 hidden group-hover:block 
                        bg-black text-white text-[10px] px-2 py-1 rounded shadow-lg">
                In Progress
            </div>
        </span>
        @break

    @case('closed')
        <span class="relative group inline-block">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                 stroke-width="1.5" stroke="currentColor" class="size-5 text-green-500 inline">
                <path stroke-linecap="round" stroke-linejoin="round"
                      d="M9 12.75 11.25 15 15 9.75M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
            </svg>
            <div class="absolute z-10 bottom-full left-1/2 -translate-x-1/2 mb-1 hidden group-hover:block 
                        bg-black text-white text-[10px] px-2 py-1 rounded shadow-lg">
                Closed
            </div>
        </span>
        @break

    @default
        <span class="relative group inline-block">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                 stroke-width="1.5" stroke="currentColor" class="size-5 text-gray-400 inline">
                <path stroke-linecap="round" stroke-linejoin="round"
                      d="m11.25 11.25.041-.02a.75.75 0 0 1 1.063.852l-.708 2.836a.75.75 
                         0 0 0 1.063.853l.041-.021M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Zm-9-3.75h.008v.008H12V8.25Z" />
            </svg>
            <div class="absolute z-10 bottom-full left-1/2 -translate-x-1/2 mb-1 hidden group-hover:block 
                        bg-black text-white text-[10px] px-2 py-1 rounded shadow-lg">
                None
            </div>
        </span>
@endswitch
