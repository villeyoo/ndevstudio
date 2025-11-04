<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\LowonganController;
use App\Http\Controllers\DaftarController;
use App\Http\Controllers\ContentController;
use App\Http\Controllers\ScripterController;
use App\Http\Controllers\PolisiController;
use App\Http\Controllers\StatusController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\BugController;
use App\Http\Controllers\RobuxController;

/*
|--------------------------------------------------------------------------
| Public routes (bisa diakses siapa saja)
|--------------------------------------------------------------------------
*/
Route::get('/', fn() => view('home'));
Route::get('/cekstatus', fn() => view('cek-status'));

Route::get('/daftar/form', [DaftarController::class, 'index'])->name('daftar.form');
Route::post('/daftar/submit', [DaftarController::class, 'submit'])->name('daftar.submit');

Route::get('/hire', [LowonganController::class, 'index'])->name('hire.index');

Route::get('/cek-status', [StatusController::class, 'showForm'])->name('cek-status.form');
Route::post('/cek-status', [StatusController::class, 'checkStatus'])->name('cek-status.check');

/*
|--------------------------------------------------------------------------
| Public forms for pelamar (these must remain public so users can submit)
|--------------------------------------------------------------------------
*/
// Form police (public)
Route::get('/polisi', [PolisiController::class, 'showForm'])->name('polisi.form');
// Submit police application (public POST)
Route::post('/polisi', [PolisiController::class, 'store'])->name('pelamar.polisi.store');

// Submit scripter application (public POST)
Route::post('/scripter', [ScripterController::class, 'store'])->name('pelamar.scripter.store');


/*
|--------------------------------------------------------------------------
| Auth routes
|--------------------------------------------------------------------------
*/
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.submit');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

/*
|--------------------------------------------------------------------------
| Common authenticated routes (bugs creation available to any authenticated user)
|--------------------------------------------------------------------------
*/
Route::middleware(['auth'])->group(function () {
    // allow any authenticated user to create a bug report
    Route::post('/bug/create', [BugController::class, 'store'])->name('bug.create');
});

/*
|--------------------------------------------------------------------------
| OWNER routes (owner bisa akses SEMUA + robux management)
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'role:owner'])->group(function () {

    // Dashboard Owner
    Route::get('/dashboard', [AdminController::class, 'index'])->name('dashboard');

    // Lowongan management (owner)
    Route::prefix('dashboard')->group(function () {
        Route::get('/tambah-lowongan', [LowonganController::class, 'create'])->name('lowongan.create');
        Route::post('/tambah-lowongan', [LowonganController::class, 'store'])->name('lowongan.store');
        Route::get('/list-lowongan', [LowonganController::class, 'list'])->name('lowongan.list');
        Route::get('/lowongan/{id}/edit', [LowonganController::class, 'edit'])->name('lowongan.edit');
        Route::put('/lowongan/{id}', [LowonganController::class, 'update'])->name('lowongan.update');
        Route::delete('/lowongan/{id}', [LowonganController::class, 'destroy'])->name('lowongan.destroy');
    });

    // Content Creator management (owner)
  Route::post('/content-creator', [ContentController::class, 'store'])->name('content-creator.store');
Route::get('/content-creator', [ContentController::class, 'index'])->name('content-creator.index');
    Route::get('/content-creator/{id}', [ContentController::class, 'show'])->name('content-creator.show');
    Route::delete('/content-creator/{id}', [ContentController::class, 'destroy'])->name('content-creator.destroy');
    Route::get('/content-creator/{id}/verify', [ContentController::class, 'verify'])->name('content-creator.verify');
    Route::put('/content-creator/{id}/verify', [ContentController::class, 'updateStatus'])->name('content-creator.updateStatus');

    // Polisi management (owner/admin view)
    // admin list for owner
    Route::get('/admin/pelamar/polisi', [PolisiController::class, 'showPolisi'])->name('pelamar.polisi');
    Route::get('/polisi/index', [PolisiController::class, 'index'])->name('polisi.index');
    Route::get('/polisi/{id}', [PolisiController::class, 'show'])->name('polisi.show');
    Route::get('/polisi/{id}/verifikasi', [PolisiController::class, 'verifyPage'])->name('polisi.verify');
    Route::put('/polisi/{id}/verifikasi', [PolisiController::class, 'updateStatus'])->name('polisi.updateStatus');
    Route::delete('/polisi/{id}', [PolisiController::class, 'destroy'])->name('polisi.destroy');

    // Scripter management (owner)
    Route::get('/admin/pelamar/scripter', [ScripterController::class, 'showScripter'])->name('pelamar.scripter'); // owner view
    Route::get('/pelamar/scripter', [ScripterController::class, 'index'])->name('scripter.index'); // owner view list
    Route::get('/scripter/{id}', [ScripterController::class, 'show'])->name('scripter.show');
    Route::get('/scripter/{id}/verifikasi', [ScripterController::class, 'verifyPage'])->name('scripter.verify');
    Route::put('/scripter/{id}/verifikasi', [ScripterController::class, 'updateStatus'])->name('scripter.updateStatus');
    Route::delete('/scripter/{id}', [ScripterController::class, 'destroy'])->name('scripter.destroy');

    // BUG management (owner)
    Route::get('/bug', [BugController::class, 'index'])->name('bug.index');
    Route::get('/bug/{id}/download', [BugController::class, 'download'])->name('bugs.download');

    // Robux management (owner)
    Route::get('/robux/requests', [RobuxController::class, 'index'])->name('robux.index');
    Route::get('/robux/requests/{id}/verify', [RobuxController::class, 'verifyForm'])->name('robux.verifyForm');
    Route::put('/robux/requests/{id}/verify', [RobuxController::class, 'updateVerification'])->name('robux.updateVerification');
    Route::delete('/robux/requests/{id}', [RobuxController::class, 'destroy'])->name('robux.destroy');
});

/*
|--------------------------------------------------------------------------
| ADMIN routes (admin/staff can request robux, access admin dashboard & bugs)
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'role:admin'])->group(function () {
    // Dashboard admin
    Route::get('/dashboardAdmin', [AdminController::class, 'adminIndex'])->name('dashboardAdmin');

    // Bug routes (admin)
    Route::get('/bug', [BugController::class, 'index'])->name('bug.index'); // admin/owner both can view
    Route::delete('/bugs/{id}', [AdminController::class, 'deleteBug'])->name('bugs.delete');
    Route::get('/bug/{id}/download', [BugController::class, 'download'])->name('bugs.download');

    // Robux: staff/admin form & request
    Route::get('/minta-robux', function () {
        return view('mintaRobux');
    })->name('robux.form');

    Route::post('/robux/request', [RobuxController::class, 'requestRobux'])->name('robux.request');

    // Track Robux (admin)
    Route::get('/track-robux', [RobuxController::class, 'trackForm'])->name('robux.track.form');
    Route::post('/track-robux', [RobuxController::class, 'track'])->name('robux.track');
});


