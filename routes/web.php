<?php

use App\Http\Controllers\DumpingController;
use App\Http\Controllers\ExcaController;
use App\Http\Controllers\MapsController;
use App\Http\Controllers\WaterdepthController;
use App\Http\Controllers\WeatherController;
use App\Http\Controllers\TestController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\RegisterController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/admin', function () {
    return view('admin/admin');
});

//Login
Route::get('/login', [LoginController::class, 'login'])->name('login') -> middleware('guest');
Route::post('/login', [LoginController::class, 'authenticate']);

//logout
Route::post('/logout', [LoginController::class, 'logout']);

//Register
Route::get('/register', [RegisterController::class, 'create']) -> middleware('guest');
Route::post('/register', [RegisterController::class, 'store']);

//User LocatorGIS
// Route::get('/user', function () {
//     return view('user', ['title' => 'Operator Lapangan']);
// });
Route::get('/', function () {
    return view('user',  ['title' => 'Operator Lapangan']);
});


//Route Group
Route::middleware(['auth'])->group(function(){
    Route::get('/dashboard', [DashboardController::class, 'dashboard'])->name('Dashboard');
    // Route::get('/maps', [MapsController::class, 'maps'])->name('Maps');

    Route::resource('/maps', MapsController::class);
    Route::resource('/exca', ExcaController::class);
    Route::resource('/dumping', DumpingController::class);
    Route::resource('/weather', WeatherController::class);
    Route::resource('/waterdepth', WaterdepthController::class);
    Route::resource('/test', TestController::class);
});



    // Route::get('/exca', [ExcaController::class, 'exca'])->name('Excavactor');
    // Route::post('/exca', [ExcaController::class, 'store']);
    // Route::get('/dump-point', [DumpingController::class, 'dump'])->name('Dump-Point');
    // Route::get('/weather', [WeatherController::class, 'weather'])->name('Weather');
    // Route::get('/waterdepth', [WaterdepthController::class, 'waterdepth'])->name('Water Depth');

// Route::get('/dashboard', function () {
//     return view('dashboard', ['title' => 'Dashboard']) -> middleware('auth');
// }) -> name('dashboard');

// Route::get('/exca', function () {
//     return view('excavator', ['title' => 'Excavator'])-> middleware('auth');
// });

// Route::get('/dump-point', function () {
//     return view('dump-point', ['title' => 'Dumping Point'])-> middleware('auth');
// });

// Route::get('/weather', function () {
//     return view('weather', ['title' => 'Weather'])-> middleware('auth');
// });

// Route::get('/waterdepth', function () {
//     return view('waterdepth', ['title' => 'Water Depth'])-> middleware('auth');
// });

// Route::get('/maps', function () {
//     return view('maps', ['title' => 'Maps'])-> middleware('auth');
// });

// Route::get('/user', function () {
//     return view('user', ['title' => 'Operator Lapangan'])-> middleware('guest');
// });