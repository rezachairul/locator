<?php

use App\Models\Operasional;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\auth\LoginController;
use App\Http\Controllers\auth\RegisterController;

use App\Http\Controllers\admin\dashboard\DashboardController;

use App\Http\Controllers\admin\maps\MapsController;

use App\Http\Controllers\admin\operator\OperatorController;

use App\Http\Controllers\admin\Operasional\OperasionalController;
use App\Http\Controllers\admin\Operasional\ExcaController;
use App\Http\Controllers\admin\Operasional\DumpingController;
use App\Http\Controllers\admin\Operasional\WeatherController;
use App\Http\Controllers\admin\Operasional\WaterdepthController;
use App\Http\Controllers\admin\Operasional\MaterialController;

use App\Http\Controllers\admin\Laporan\IncidentUserController;

use App\Http\Controllers\Lapangan\LapanganController;
use App\Http\Controllers\Lapangan\UserReportController;

// Testing 401 error
Route::get('/test-401', function () {
    abort(401); // Menampilkan halaman 401
});

// Testing 403 error
Route::get('/test-403', function () {
    abort(403); // Menampilkan halaman 403
});

// Testing 404 error
Route::get('/test-404', function () {
    abort(404); // Menampilkan halaman 404
});

// Testing 419 error
Route::get('/test-419', function () {
    abort(419); // Menampilkan halaman 419
});

// Testing 500 error
Route::get('/test-500', function () {
    abort(500); // Menampilkan halaman 500
});


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
Route::middleware(['auth', 'role:operator'])->group(function(){
    // OP Lapangan
    Route::get('/', [LapanganController::class, 'index']);
    // User Report
    Route::resource('/user-report', UserReportController::class);
});

//Route Group Dashboard Admin
Route::middleware(['auth', 'role:admin'])->group(function(){
    
    // Rute untuk export
    Route::get('/exca/export', [ExcaController::class, 'export'])->name('exca.export');
    
    // Rute untuk import
    // Route::post('/exca/import', [ExcaController::class, 'import'])->name('exca.import');
    Route::match(['get', 'post'], '/exca/import', [ExcaController::class, 'import'])->name('exca.import');
    
    Route::resource('/dashboard', DashboardController::class);
    Route::resource('/maps', MapsController::class);


    // Route untuk Kelola data user
    Route::controller(OperatorController::class)->group(function () {
        // Rute untuk halaman index
        Route::get('/operator',[OperatorController::class, 'index'])->name('operator.index');
        // Rute untuk menyimpan data baru
        Route::post('/operator',[OperatorController::class, 'store'])->name('operator.store');
        // Rute untuk memperbarui data
        Route::put('/operator/{id}',[OperatorController::class, 'update'])->name('operator.update');
        // Rute untuk menghapus data
        Route::delete('/operator/{id}',[OperatorController::class, 'destroy'])->name('operator.destroy');
        
    });
    
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
    });
        

    // Route Informasi
    // Route::prefix('Informasi')->group(function () {
    //     Route::resource('/tentang-sistem', IncidentUserController::class);
    //     Route::resource('/bantuan', LaporanHarianController::class);
    //     Route::resource('/kontak', LaporanBulananController::class);
    // });
});
