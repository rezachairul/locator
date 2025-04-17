<!doctype html>
<html lang="en" :class="{ 'theme-dark': dark }" x-data="data()">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @vite('resources/css/app.css')
    <title>LocatorGIS | {{$title}} </title>
    <link rel="shortcut icon" href="{{ asset('assets/img/menu-icons/user-report.png') }}" type="image/x-icon">
    <!-- Font -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet" />
    <!-- Link CSS -->
    <link rel="stylesheet" href="{{ asset('assets/css/tailwind.output-2.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/css/Chart.min.css') }}" />
    <!-- JS -->
    <script src="{{ asset('assets/js/alpine.min.js') }}"></script>
    <script src="{{ asset('assets/js/init-alpine.js') }}"></script>
    <script src="{{ asset('assets/js/Chart.min.js') }}"></script>
    <script src="{{ asset('assets/js/charts-lines.js') }}"></script>
    <script src="{{ asset('assets/js/charts-pie.js') }}"></script>
    <script src="{{ asset('assets/js/focus-trap.js') }}" defer></script>
</head>

<body>
    <div class="flex h-screen bg-gray-50 dark:bg-gray-900" :class="{ 'overflow-hidden': isSideMenuOpen }">
        <div class="flex flex-col flex-1 w-full">
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
                            <li class="relative">
                                <button @click="toggleNotificationsMenu" @keydown.escape="closeNotificationsMenu" aria-label="Notifications" aria-haspopup="true" class="relative align-middle rounded-md focus:outline-none focus:shadow-outline-purple">
                                    <svg class="w-5 h-5" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20">
                                        <path d="M10 2a6 6 0 016 6v3.586l.707.707a1 1 0 01.293.707V14a1 1 0 01-1 1H4a1 1 0 01-1-1v-.293a1 1 0 01.293-.707L4 11.586V8a6 6 0 016-6zm-4 14a2 2 0 004 0H6z"></path>
                                    </svg>
                                    <!-- Notification badge -->
                                    <span aria-hidden="true" class="absolute top-0 right-0 inline-block w-3 h-3 transform translate-x-2 -translate-y-2 bg-red-600 border-2 border-white rounded-full"></span>
                                </button>
                                <template x-if="isNotificationsMenuOpen">
                                    <ul @click.away="closeNotificationsMenu" @keydown.escape="closeNotificationsMenu" class="absolute right-0 w-56 p-2 mt-2 space-y-2 text-gray-600 bg-white border border-gray-100 rounded-md shadow-md dark:text-gray-300 dark:border-gray-700 dark:bg-gray-800">
                                        <li class="flex">
                                            <a class="inline-flex items-center justify-between w-full px-2 py-1 text-sm font-semibold transition-colors duration-150 hover:text-gray-800 dark:hover:text-gray-200" href="#">
                                                <span>Alerts</span>
                                            </a>
                                        </li>
                                    </ul>
                                </template>
                            </li>
                            <!-- Profile menu -->
                            <li class="relative">
                                <button @click="toggleProfileMenu" @keydown.escape="closeProfileMenu" aria-label="Account" aria-haspopup="true" class="relative align-middle rounded-full focus:outline-none focus:shadow-outline-purple">
                                    <img class="object-cover w-8 h-8 rounded-full" src="{{ asset('assets/img/foto.jpg') }}" alt="" aria-hidden="true">
                                </button>
                                <template x-if="isProfileMenuOpen">
                                    <ul @click.away="closeProfileMenu" @keydown.escape="closeProfileMenu" class="absolute right-0 w-56 p-2 mt-2 space-y-2 text-gray-600 bg-white border border-gray-100 rounded-md shadow-md dark:text-gray-300 dark:border-gray-700 dark:bg-gray-800">
                                        <li class="flex">
                                            <a class="inline-flex items-center justify-between w-full px-2 py-1 text-sm font-semibold transition-colors duration-150 hover:text-gray-800 dark:hover:text-gray-200" href="#">
                                                <span>Profile</span>
                                            </a>
                                        </li>
                                        <li class="flex">
                                            <form method="POST" action="#">
                                                <button class="w-full inline-flex items-center justify-between px-2 py-1 text-sm font-semibold transition-colors duration-150 hover:text-gray-800 dark:hover:text-gray-200">
                                                    <span>Log out</span>
                                                </button>
                                            </form>
                                        </li>
                                    </ul>
                                </template>
                            </li>
                        </ul>
                    </div>
                </header>
            </div>
            <main class="h-full overflow-y-auto p-5">
                <!-- Header -->
                <div class="flex justify-between items-center mb-2">
                    <div>
                        <x-header>{{$title}}</x-header>
                    </div>
                    <div class="text-right">
                        <ol class="breadcrumb inline-flex space-x-2">
                            <li class="breadcrumb-item">
                                <a href="/" class="text-blue-500 hover:text-blue-700">Operasional Lapangan</a>
                            </li>
                            <li class="breadcrumb-item active text-gray-500"> / </li>
                            <li class="breadcrumb-item active text-gray-500">{{$title}}</li>
                        </ol>
                    </div>
                </div>
                <!-- Form Create Report User -->
                <div id="createForm" class="hidden p-4 mb-8 bg-white rounded-lg shadow-md dark:bg-gray-700">
                    <div class="flex items-start justify-between p-4 border-b rounded-t dark:border-gray-600">
                        <h3 class="text-xl font-semibold text-gray-900 dark:text-white">
                            Form Tambah {{$title}}
                        </h3>
                        <button type="button" id="exitButton" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center dark:hover:bg-gray-600 dark:hover:text-white">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 011.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path>
                            </svg>
                        </button>
                    </div>
                    <form id="reportForm" action="{{route('user-report.store')}}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="grid gap-4 mb-4 mt-4 sm:grid-cols-2">
                            <!-- Victim Name -->
                            <div>
                                <label for="victim_name" 
                                    class="block text-sm mb-2 font-medium text-gray-900 dark:text-white">
                                    Nama Korban
                                </label>
                                <input type="text" id="victim_name" name="victim_name" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white" placeholder="Nama korban yang mengalami insiden" required>
                            </div>
                            <!-- Incident Type -->
                            <div>
                                <label for="incident_type" 
                                    class="block text-sm mb-2 font-medium text-gray-900 dark:text-white">
                                    Jenis Insiden
                                </label>
                                <input type="text" id="incident_type" name="incident_type" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white" placeholder="Jenis incident (misalnya: kecelakaan, cedera, dll.)" required>
                            </div>
                            <!-- Incident Location -->
                            <div>
                                <label for="incident_location" 
                                    class="block text-sm mb-2 font-medium text-gray-900 dark:text-white">
                                    Lokasi Insiden
                                </label>
                                <input type="text" id="incident_location" name="incident_location" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white" placeholder=" Lokasi kejadian incident" required>
                            </div>
                            <!-- Incident Date and Time -->
                            <div>
                                <label for="incident_date_time" 
                                    class="block text-sm mb-2 font-medium text-gray-900 dark:text-white">
                                    Tanggal dan Waktu Insiden
                                </label>
                                <input type="datetime-local" id="incident_date_time" name="incident_date_time" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white" required>
                            </div>
                            <!-- Report by -->
                            <div>
                                <label for="report_by" 
                                    class="block text-sm mb-2 font-medium text-gray-900 dark:text-white">
                                    Dilaporkan Oleh
                                </label>
                                <input type="text" id="report_by" name="report_by" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white" placeholder="Nama Pelapor incident" required>
                            </div>
                            <!-- Report Date and Time -->
                            <div>
                                <label for="report_date_time"
                                    class="block text-sm mb-2 font-medium text-gray-900 dark:text-white">
                                    Tanggal dan Waktu Pelaporan
                                </label>
                                <input type="datetime-local" id="report_date_time" name="report_date_time" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white" required>
                            </div>
                            <!-- Incident Description -->
                            <div>
                                <label for="incident_description" 
                                    class="block text-sm mb-2 font-medium text-gray-900 dark:text-white">
                                    Deskripsi Insiden
                                </label>
                                <textarea id="incident_description" name="incident_description" rows="4"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5 
                                    dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white"
                                placeholder="Deskripsi singkat tentang incident" required></textarea>
                            </div>
                            <!-- Incident Photo -->
                            <div>
                                <label for="incident_photo" class="block text-sm mb-2 font-medium text-gray-900 dark:text-white">
                                    Upload Bukti Foto
                                </label>
                                <input type="file" id="incident_photo" name="incident_photo[]" accept="image/*"
                                    class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 
                                        dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400">
                                <p class="mt-1 text-sm text-gray-500 dark:text-gray-300">Format: JPG, PNG, dll. Maks 2MB.</p>
                            </div>
                        </div>

                        <!-- Tombol Simpan dan Batal -->
                        <div class="flex justify-end space-x-2 pt-4">
                            <button type="submit" id="submit"
                                class="text-white inline-flex items-center bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                                <svg class="mr-1 -ml-1 w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd"
                                        d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z"
                                        clip-rule="evenodd"></path>
                                </svg>
                                Add new Data {{ $title }}
                            </button>
                            <button type="button" id="cancelButton"
                                class="text-red-600 inline-flex items-center hover:text-white border border-red-600 hover:bg-red-600 focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 dark:border-red-500 dark:text-red-500 dark:hover:text-white dark:hover:bg-red-600 dark:focus:ring-red-900">
                                <svg class="mr-1 -ml-1 w-5 h-5" xmlns="http://www.w3.org/2000/svg" fill="none"
                                    viewBox="0 0 24 24">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-width="2"
                                        d="m6 6 12 12m3-6a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                                </svg>
                                Cancel
                            </button>
                        </div>
                    </form>
                </div>
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
                            <!-- Tombol Create -->
                            <a href="#">
                                <button id="createButton" class="flex items-center justify-center text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-4 py-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">
                                    <svg class="h-3.5 w-3.5 mr-2" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                                        <path clip-rule="evenodd" fill-rule="evenodd" d="M10 3a1 1 0 011 1v5h5a1 1 0 110 2h-5v5a1 1 0 11-2 0v-5H4a1 1 0 110-2h5V4a1 1 0 011-1z" />
                                    </svg>
                                    Create
                                </button>
                            </a>
                            <!-- Tombol Export -->
                            <a href="#">
                                <button type="button" class="flex items-center justify-center text-white bg-green-700 hover:bg-green-800 focus:ring-4 focus:ring-green-300 font-medium rounded-lg text-sm px-4 py-2 dark:bg-green-600 dark:hover:bg-green-700 focus:outline-none dark:focus:ring-green-800">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="h-3.5 w-3.5 mr-2" aria-hidden="true">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M3 16.5v2.25A2.25 2.25 0 0 0 5.25 21h13.5A2.25 2.25 0 0 0 21 18.75V16.5M16.5 12 12 16.5m0 0L7.5 12m4.5 4.5V3" />
                                    </svg>
                                    Export
                                </button>
                            </a>
                        </div>
                    </div>
                    <div class="w-full overflow-x-auto">
                        <table class="w-full whitespace-no-wrap">
                            <thead>
                                <tr class="text-xs font-semibold tracking-wide text-left text-gray-500 uppercase border-b dark:border-gray-700 bg-gray-50 dark:text-gray-400 dark:bg-gray-800" >
                                    <th class="px-4 py-3 text-center" rowspan="2">No</th>
                                    <th class="px-4 py-3 text-center" rowspan="2">Incident Type</th>
                                    <th class="px-4 py-3 text-center" rowspan="2">Incident Date and Time</th>
                                    <th class="px-4 py-3 text-center" rowspan="2">Incident Location</th>
                                    <th class="px-4 py-3 text-center" rowspan="2">Status</th>
                                    <th class="px-4 py-3 text-center" rowspan="2">Actions</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y dark:divide-gray-700 dark:bg-gray-800">
                                @if ($user_reports->isEmpty())
                                    <tr class="text-gray-700 dark:text-gray-400">
                                        <td colspan="7" class="px-2 py-1 text-center text-gray-500">Tidak Ada Data Insiden Hari ini</td>
                                    </tr>
                                @else
                                    @foreach ($user_reports as $key =>  $user_report)
                                        <tr class="text-gray-700 dark:text-gray-400">
                                            <td class="px-4 py-3 text-sm text-center"> {{ $user_reports->firstItem() + $key }} </td>
                                            <td class="px-4 py-3 text-sm text-center"> {{ $user_report->incident_type }} </td>
                                            <td class="px-4 py-3 text-sm text-center"> {{ $user_report->incident_date_time }} </td>
                                            <td class="px-4 py-3 text-sm text-center"> {{ $user_report->incident_location }} </td>
                                            <!-- Status -->
                                            <td class="px-2 py-1 text-xs text-center">
                                                @if ($user_report->status === 'pending')
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
                                                @elseif ($user_report->status === 'in_progress')
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
                                                @elseif ($user_report->status === 'closed')
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
                                                    <button class="inline-block text-gray-500 hover:text-blue-600 transition-colors duration-200">
                                                        <a href="#">
                                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-5">
                                                                <path stroke-linecap="round" stroke-linejoin="round" d="M2.036 12.322a1.012 1.012 0 0 1 0-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178Z" />
                                                                <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                                                            </svg>                                                            
                                                        </a>
                                                    </button>
                                                    <!-- Modals Show Details -->

                                                    <!-- Edit -->
                                                    <button class="inline-block text-gray-500 hover:text-yellow-600 transition-colors duration-200">
                                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-5">
                                                            <path stroke-linecap="round" stroke-linejoin="round" d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L10.582 16.07a4.5 4.5 0 0 1-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 0 1 1.13-1.897l8.932-8.931Zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0 1 15.75 21H5.25A2.25 2.25 0 0 1 3 18.75V8.25A2.25 2.25 0 0 1 5.25 6H10" />
                                                        </svg>
                                                    </button>
                                                    <!-- Modals Edit -->

                                                    <!-- Delete -->
                                                    <button
                                                        id="deleteButton-{{$user_report->id}}"
                                                        data-modal-target="deleteModal-{{$user_report->id}}"
                                                        data-modal-toggle="deleteModal-{{$user_report->id}}"
                                                        class="inline-block text-gray-500 hover:text-red-600 transition-colors duration-200">
                                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-5">
                                                            <path stroke-linecap="round" stroke-linejoin="round" d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0" />
                                                        </svg>
                                                    </button>
                                                    <!-- Modals Delete -->
                                                     <div id="deleteModal-{{$user_report->id}}" tabindex="-1" aria-hidden="true"
                                                        class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-modal md:h-full">
                                                        <div class="relative p-4 w-full max-w-md h-full md:h-auto">
                                                            <!-- Modal content -->
                                                            <div class="relative p-4 text-center bg-white rounded-lg shadow dark:bg-gray-800 sm:p-5">
                                                                <button type="button" data-modal-toggle="deleteModal-{{ $user_report->id }}" class="text-gray-400 absolute top-2.5 right-2.5 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-toggle="deleteModal">
                                                                    <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                                                        <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path>
                                                                    </svg>
                                                                    <span class="sr-only">Close modal</span>
                                                                </button>
                                                                <svg class="text-gray-400 dark:text-gray-500 w-11 h-11 mb-3.5 mx-auto" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                                                    <path fill-rule="evenodd" d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z" clip-rule="evenodd"></path>
                                                                </svg>
                                                                <p class="mb-4 text-gray-500 dark:text-gray-300">Are you sure you want to delete this item?</p>
                                                                <div class="flex justify-center items-center space-x-4">
                                                                    @if (isset($user_report))
                                                                        <form action="{{ route('user-report.destroy', $user_report->id) }}" method="POST">
                                                                            @csrf
                                                                            @method('DELETE')
                                                                            <button data-modal-toggle="deleteModal-{{ $user_report->id }}" type="button" class="mr-2 py-2 px-3 text-sm font-medium text-gray-500 bg-white rounded-lg border border-gray-200 hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-primary-300 hover:text-gray-900 focus:z-10 dark:bg-gray-700 dark:text-gray-300 dark:border-gray-500 dark:hover:text-white dark:hover:bg-gray-600 dark:focus:ring-gray-600">
                                                                                No, cancel
                                                                            </button>
                                                                            <button type="submit" class="py-2 px-3 text-sm font-medium text-center text-white bg-red-600 rounded-lg hover:bg-red-700 focus:ring-4 focus:outline-none focus:ring-red-300 dark:bg-red-500 dark:hover:bg-red-600 dark:focus:ring-red-900">
                                                                                Yes, I'm sure
                                                                            </button>    
                                                                        </form>
                                                                    @else
                                                                        <p>Data Tidak Ditemukan</p>
                                                                    @endif
                                                                </div>
                                                            </div>
                                                        </div>
                                                     </div>
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
                        <!-- Showing -->
                        <span class="flex items-center col-span-3">
                            Showing {{$user_reports->firstItem()}} - {{$user_reports->lastItem()}} of {{ $user_reports->total() }} Entries
                        </span>
                        <span class="col-span-2"></span>
                        <!-- Pagination -->
                        <div class="col-span-4 flex items-center justify-end space-x-2">
                            @if ($user_reports->onFirstPage())
                                <span class="px-4 py-2 text-gray-500 bg-gray-700 rounded-md cursor-not-allowed">Previous</span>
                            @else
                                <a href="{{ $user_reports->previousPageUrl() }}" class="px-4 py-2 text-gray-300 bg-gray-800 border border-gray-600 rounded-md hover:bg-gray-700">Previous</a>
                            @endif
                            <span class="text-gray-300">Page {{ $user_reports->currentPage() }} of {{ $user_reports->lastPage() }}</span>
                            @if ($user_reports->hasMorePages())
                                <a href="{{ $user_reports->nextPageUrl() }}" class="px-4 py-2 text-gray-300 bg-gray-800 border border-gray-600 rounded-md hover:bg-gray-700">Next</a>
                            @else
                                <span class="px-4 py-2 text-gray-500 bg-gray-700 rounded-md cursor-not-allowed">Next</span>
                            @endif
                        </div>
                    </div>
                </div>
            </main>
        </div>
    </div>
    <!-- Script -->
    <script>
        // Function to scroll smoothly to the top of the page
        function scrollToTop() {
            window.scrollTo({
                top: 0,
                behavior: 'smooth'
            });
        }

        // Function to apply theme and invert icons accordingly
        function applyTheme() {
            const theme = document.body.classList.contains('dark') ? 'dark' : 'light';
            const icons = document.querySelectorAll('.invert-icon img');

            icons.forEach(icon => {
                icon.style.filter = theme === 'light' ? 'invert(1)' : 'invert(0)';
            });
        }
        const createButton = document.getElementById('createButton');
        const createForm = document.getElementById('createForm');
        const cancelButton = document.getElementById('cancelButton');
        const exitButton = document.getElementById('exitButton');
        const reportForm = document.getElementById('reportForm');
        // Tampilkan form saat tombol Create diklik
        createButton.addEventListener('click', () => {
            createForm.classList.remove('hidden');
            createForm.classList.remove('animate-fade-out'); // Jika ada animasi keluar sebelumnya
            createForm.classList.add('animate-fade-in');
        });
        // Sembunyikan form dengan animasi fade-out
        cancelButton.addEventListener('click', () => {
            createForm.classList.remove('animate-fade-in');
            createForm.classList.add('animate-fade-out');
            setTimeout(() => {
                createForm.classList.add('hidden');
            }, 200); // Waktu sesuai dengan durasi animasi
        });
        exitButton.addEventListener('click', () => {
            createForm.classList.remove('animate-fade-in');
            createForm.classList.add('animate-fade-out');
            setTimeout(() => {
                createForm.classList.add('hidden');
            }, 200); // Waktu sesuai dengan durasi animasi
        });
        // Form submit handling
        reportForm.addEventListener('submit', () => {
            createForm.classList.remove('animate-fade-in');
            createForm.classList.add('animate-fade-out');
            setTimeout(() => {
                createForm.classList.add('hidden');
            }, 300);
        });

        // Functionality for modals: toggle and hide
        function setupModals() {
            const modalToggleBtns = document.querySelectorAll('[data-modal-toggle]');
            const modalHideBtns = document.querySelectorAll('[data-modal-hide]');

            // Toggle modal visibility
            modalToggleBtns.forEach(btn => {
                btn.addEventListener('click', () => {
                    const modalId = btn.getAttribute('data-modal-toggle');
                    const modal = document.getElementById(modalId);
                    if (modal) {
                        modal.classList.toggle('hidden');
                    }
                });
            });

            // Hide modal
            modalHideBtns.forEach(btn => {
                btn.addEventListener('click', () => {
                    const modalId = btn.getAttribute('data-modal-hide');
                    const modal = document.getElementById(modalId);
                    if (modal) {
                        modal.classList.add('hidden');
                    }
                });
            });
        }
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

        // Event listener for DOMContentLoaded
        document.addEventListener("DOMContentLoaded", function() {
            // Apply theme on page load
            applyTheme();

            // Theme toggle functionality
            const themeToggleButton = document.getElementById('theme-toggle');
            if (themeToggleButton) {
                themeToggleButton.addEventListener('click', function() {
                    document.body.classList.toggle('dark'); // Toggle 'dark' class
                    applyTheme(); // Apply updated theme
                });
            }

            // Setup modal functionality
            setupModals();
        });
    </script>

</body>

</html>