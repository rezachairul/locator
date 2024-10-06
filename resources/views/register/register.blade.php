<!doctype html>
<html lang="en" :class="{ 'theme-dark': dark }" x-data="data()">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @vite(['resources/css/app.css','resources/js/app.js'])
    <title>LocatorGIS | {{$title}} </title>
    <link rel="shortcut icon" href="{{ asset('assets/img/excavator.png') }}" type="image/x-icon">
    
    <!-- Font -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet"/>

    <link rel="stylesheet" href="./assets/css/tailwind.output-2.css"/>
    <link rel="stylesheet" href="./assets/css/Chart.min.css"/>

    <script src="./assets/js/alpine.min.js"></script>
    <script src="./assets/js/init-alpine.js"></script>
    <script src="./assets/js/Chart.min.js"></script>
    <script src="./assets/js/charts-lines.js"></script>
    <script src="./assets/js/charts-pie.js"></script>
    <script src="./assets/js/focus-trap.js" defer></script>

</head>
<body> 
    <div class="flex items-center min-h-screen p-6 bg-gray-50 dark:bg-gray-900">
      <div class="flex-1 h-full max-w-4xl mx-auto overflow-hidden bg-white rounded-lg shadow-xl dark:bg-gray-800" >
        <div class="flex flex-col overflow-y-auto md:flex-row">
          <div class="h-32 md:h-auto md:w-1/2">
            <img aria-hidden="true" class="object-cover w-full h-full dark:hidden" src="{{ asset('assets/img/view-dump.jpg') }}" alt="exca" />
            <img
              aria-hidden="true" class="hidden object-cover w-full h-full dark:block" src="{{ asset('assets/img/view-exca.jpg') }}" alt="dump" />
          </div>
          <div class="flex items-center justify-center p-6 sm:p-12 md:w-1/2">
            <div class="w-full">
                <h1 class="mb-4 text-xl font-semibold text-gray-700 dark:text-gray-200" >
                    Registration Administrator
                </h1>
                <form action="/register" method="post">
                    @csrf
                    <div class="block text-sm mt-8">
                        <input type="text" name="name" id="name" class=" block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input" placeholder="Name" required value="{{old('name')}}">
                    </div>
                    <div class="block text-sm mt-8">
                        <input type="text" name="username" id="username" class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input" placeholder="Username" required value="{{old('username')}}">
                    </div>
                    <div class="block text-sm mt-8">
                        <input type="email" name="email" id="email" class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input" placeholder="name@example.com" required value="{{old('email')}}">
                    </div>
                    <div class="block text-sm mt-8">
                        <input type="password" name="password" id="password" class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input" placeholder="Password" required>
                    </div>
                    <button type="submit" class="block w-full px-4 py-2 mt-4 text-sm font-medium leading-5 text-center text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-lg active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple">Registration</button>
                </form>
                <p class="mt-2">
                    <a class="text-sm font-medium text-purple-600 dark:text-purple-400 hover:underline" href="/login" >
                    Already have an account? Login
                    </a>
                </p>
                <hr class="mt-2">
                <span class="text-sm text-gray-500 sm:text-center dark:text-gray-400">&copy; 2024 <a href="#">PT. Fajar Anugerah Dinamika </a></span>
            </div>
          </div>
        </div>
      </div>
    </div>
</body>
</html>
