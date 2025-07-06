<?php

use App\Models\Operasional;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

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

// =======================
// Route Group Auth
// =======================
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

// =======================
// Route untuk Operator
// =======================
Route::prefix('operator')->middleware(['auth', 'role:operator'])->name('operator.')->group(function () {
    
    // =======================
    // Dashboard atau halaman utama operator
    // =======================
    Route::get('/', [LapanganController::class, 'index'])->name('dashboard');

    // =======================
    // Laporan yang dikirim user/operator
    // =======================
    Route::get('/user-report-export', [UserReportController::class, 'export'])->name('user-report.export');
    Route::resource('/user-report', UserReportController::class);
});


// =======================
// Route untuk Administrator
// =======================
Route::prefix('admin')->middleware(['auth', 'role:admin'])->name('admin.')->group(function(){
    
    // =======================
    // Export & Import
    // =======================
    Route::get('/exca/export', [ExcaController::class, 'export'])->name('exca.export');
    Route::match(['get', 'post'], '/exca/import', [ExcaController::class, 'import'])->name('exca.import');

    
    // =======================
    // Dashboard
    // =======================
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
        
    // =======================
    // Maps
    // =======================
    Route::resource('/maps', MapsController::class);

    // ======================================
    // Kelola Data Administrator & Operator
    // ======================================
    Route::controller(OperatorController::class)->prefix('operator')->name('operator.')->group(function () {
        Route::get('/','index')->name('index');
        Route::post('/','store')->name('store');
        Route::put('/{id}','update')->name('update');
        Route::delete('/{id}','destroy')->name('destroy');
        Route::get('/export',  'export')->name('export');

    });
    
    // =======================
    // Operasional
    // =======================
    Route::prefix('operasional')->name('operasional.')->group(function () {

        // Rute untuk export data operasional
        Route::get('/operasional/export', [OperasionalController::class, 'export'])->name('operasional.export');
        
        // Rute untuk tiap page
        Route::resource('/operasional', OperasionalController::class);
        Route::resource('/exca', ExcaController::class);
        Route::resource('/dumping', DumpingController::class);
        Route::resource('/weather', WeatherController::class);
        Route::resource('/waterdepth', WaterdepthController::class);
        Route::resource('/material', MaterialController::class);
    });

    // =======================
    // Laporan (Incident User)
    // =======================
    Route::prefix('laporan-user')->name('laporan-user.')->group(function () {
        Route::get('/incident-user/export', [IncidentUserController::class, 'export'])->name('export');
        Route::patch('/{id}/update-status', [IncidentUserController::class, 'updateStatus'])->name('updateStatus');
        Route::resource('/incident-user', IncidentUserController::class);
    });
        
    // =======================
    // Informasi (future use)
    // ======================
    // Route::prefix('Informasi')->name('informasi')->group(function () {
    //     Route::resource('/tentang-sistem', IncidentUserController::class);
    //     Route::resource('/bantuan', LaporanHarianController::class);
    //     Route::resource('/kontak', LaporanBulananController::class);
    // });
});

// =======================
// Cek apakah user sudah login
// =======================
Route::get('/', function () {
    if (Auth::check()) {
        $user = Auth::user();
        // Redirect berdasarkan role
        if ($user->role === 'admin') {
            return redirect()->route('admin.dashboard');
        } elseif ($user->role === 'operator') {
            return redirect()->route('operator.dashboard');
        }
    }
    // Kalau belum login, ke halaman login
    return redirect()->route('login');
});
