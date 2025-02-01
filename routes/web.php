<?php

use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\MapsController;
use App\Http\Controllers\ExcaController;
use App\Http\Controllers\DumpingController;
use App\Http\Controllers\WaterdepthController;
use App\Http\Controllers\WeatherController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LapanganController;
use App\Http\Controllers\TestController;
use Illuminate\Support\Facades\Auth;
use App\Models\Lapangan;

//Login
Route::get('/login', [LoginController::class, 'login'])->name('login') -> middleware('guest');
Route::post('/login', [LoginController::class, 'authenticate']);

//logout
Route::post('/logout', [LoginController::class, 'logout']);

//Register
Route::get('/register', [RegisterController::class, 'create']) -> middleware('guest');
Route::post('/register', [RegisterController::class, 'store']);


// OP Lapangan
Route::get('/',[LapanganController::class, 'index']);


//Route Group
Route::middleware(['auth'])->group(function(){
    Route::resource('/dashboard', DashboardController::class);
    
    // Rute untuk export
    Route::get('/exca/export', [ExcaController::class, 'export'])->name('exca.export');
    
    // Rute untuk import
    // Route::post('/exca/import', [ExcaController::class, 'import'])->name('exca.import');
    Route::match(['get', 'post'], '/exca/import', [ExcaController::class, 'import'])->name('exca.import');

    // Rute untuk tiap page
    Route::resource('/maps', MapsController::class);
    Route::resource('/exca', ExcaController::class);
    Route::resource('/dumping', DumpingController::class);
    Route::resource('/weather', WeatherController::class);
    Route::resource('/waterdepth', WaterdepthController::class);


});
