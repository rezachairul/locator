<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MapsController;
use App\Http\Controllers\DashboardController;

use App\Http\Controllers\Lapangan\LapanganController;
use App\Http\Controllers\Lapangan\UserReportController;

use App\Http\Controllers\auth\LoginController;
use App\Http\Controllers\auth\RegisterController;

use App\Http\Controllers\Operasional\OperasionalController;
use App\Http\Controllers\Operasional\ExcaController;
use App\Http\Controllers\Operasional\DumpingController;
use App\Http\Controllers\Operasional\WeatherController;
use App\Http\Controllers\Operasional\WaterdepthController;
use App\Http\Controllers\Operasional\MaterialController;

use App\Http\Controllers\Laporan\IncidentUserController;
use App\Http\Controllers\Laporan\LaporanHarianController;
use App\Http\Controllers\Laporan\LaporanBulananController;
use App\Models\Operasional;

// Route Group Auth
Route::prefix('auth')->group(function () {
    //Login
    Route::get('/login', [LoginController::class, 'login'])->name('login') -> middleware('guest');
    Route::post('/login', [LoginController::class, 'authenticate']);
    //logout
    Route::post('/logout', [LoginController::class, 'logout']);
    //Register
    Route::get('/register', [RegisterController::class, 'create']) -> middleware('guest');
    Route::post('/register', [RegisterController::class, 'store']);
});   

// Route User Page
Route::prefix('/')->group(function(){
    // OP Lapangan
    Route::get('/', [LapanganController::class, 'index']);
    // User Report
    Route::resource('/user-report', UserReportController::class);

});

//Route Group Dashboard Admin
Route::middleware(['auth'])->group(function(){
    
    // Rute untuk export
    Route::get('/exca/export', [ExcaController::class, 'export'])->name('exca.export');
    
    // Rute untuk import
    // Route::post('/exca/import', [ExcaController::class, 'import'])->name('exca.import');
    Route::match(['get', 'post'], '/exca/import', [ExcaController::class, 'import'])->name('exca.import');
    
    Route::resource('/dashboard', DashboardController::class);
    Route::resource('/maps', MapsController::class);
    
    // Route Operasional
    Route::prefix('operasional')->group(function () {
        // Rute untuk tiap page        
        Route::resource('/operasional', OperasionalController::class);
        Route::resource('/exca', ExcaController::class);
        Route::resource('/dumping', DumpingController::class);
        Route::resource('/weather', WeatherController::class);
        Route::resource('/waterdepth', WaterdepthController::class);
        Route::resource('/material', MaterialController::class);
    });

    // Route Admin Report
     Route::prefix('laporan')->group(function () {
        Route::resource('/incident-user', IncidentUserController::class);        
        Route::resource('/laporan-harian', LaporanHarianController::class);
        Route::resource('/laporan-bulanan', LaporanBulananController::class);
    });
        

    // Route Informasi
    // Route::prefix('Informasi')->group(function () {
    //     Route::resource('/tentang-sistem', IncidentUserController::class);
    //     Route::resource('/bantuan', LaporanHarianController::class);
    //     Route::resource('/kontak', LaporanBulananController::class);
    // });
});
