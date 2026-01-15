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
use App\Http\Controllers\HalamanController;
use App\Http\Controllers\FormController;
use App\Http\Controllers\SubmissionController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\KasusController;
use App\Http\Controllers\ReportController;




/*
|--------------------------------------------------------------------------
| PUBLIC ROUTES (Bisa diakses siapa saja tanpa login)
|--------------------------------------------------------------------------
*/

// Halaman utama & status
Route::get('/', fn() => view('home'));
Route::get('/cekstatus', fn() => view('cek-status'));
Route::get('/hire', [LowonganController::class, 'index'])->name('hire.index');
Route::get('/desaindo', [HalamanController::class, 'about'])->name('about');
Route::get('/robux', [HalamanController::class, 'robux'])->name('robux');
Route::get('/success', [HalamanController::class, 'success'])->name('success');
Route::get('/news', [HalamanController::class, 'news'])->name('news');



Route::get('/bukti', [HalamanController::class, 'case']);
Route::get('/pemenang', [HalamanController::class, 'pengumuman']);



// Form beli Robux
Route::get('/order/{id}', [OrderController::class, 'create'])->name('order.create');
Route::post('/order', [OrderController::class, 'store'])->name('order.store');

// Form daftar umum
Route::get('/daftar/form', [DaftarController::class, 'index'])->name('daftar.form');
Route::post('/daftar/submit', [DaftarController::class, 'submit'])->name('daftar.submit');

Route::post('/submit-form', [FormController::class, 'store'])->name('submit.form');


// Cek status pelamar
Route::get('/cek-status', [StatusController::class, 'showForm'])->name('cek-status.form');
Route::post('/cek-status', [StatusController::class, 'checkStatus'])->name('cek-status.check');

// --- FORM PUBLIK UNTUK PELAMAR ---

// 🔹 Form & store Content Creator (public)
Route::post('/content-creator', [ContentController::class, 'store'])->name('content-creator.store');

// 🔹 Form & store Scripter (public)
Route::post('/scripter', [ScripterController::class, 'store'])->name('pelamar.scripter.store');

// 🔹 Form & store Polisi (public)
Route::get('/polisi', [PolisiController::class, 'showForm'])->name('polisi.form');
Route::post('/polisi', [PolisiController::class, 'store'])->name('pelamar.polisi.store');

Route::get('/laporan', [ReportController::class, 'lapor']);
Route::get('/laporan', [ReportController::class, 'form'])
    ->name('laporan.form');
Route::post('/laporan', [ReportController::class, 'store'])
    ->name('laporan.kirim');

Route::get('/laporan/cek', [ReportController::class, 'cekForm'])->name('laporan.cek.form');
Route::post('/laporan/cek', [ReportController::class, 'cekProses'])->name('laporan.cek.proses');

/*
|--------------------------------------------------------------------------
| AUTH ROUTES
|--------------------------------------------------------------------------
*/
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.submit');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

/*
|--------------------------------------------------------------------------
| AUTHENTICATED ROUTES (Siapa pun yang login)
|--------------------------------------------------------------------------
*/
Route::middleware(['auth'])->group(function () {
    Route::post('/bug/create', [BugController::class, 'store'])->name('bug.create');
});

/*
|--------------------------------------------------------------------------
| OWNER ROUTES (role:owner)
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'role:owner'])->group(function () {

    // Dashboard Owner
    Route::get('/dashboard', [AdminController::class, 'index'])->name('dashboard');
    Route::get('/semuaLaporan', [AdminController::class, 'daftarLaporan'])->name('daftarLaporan');
    Route::get('/dashboardStore', [AdminController::class, 'dashboardNdev'])->name('dashboardNdev');

    // --- Lowongan Management ---
    Route::prefix('dashboard')->group(function () {
        Route::get('/tambah-lowongan', [LowonganController::class, 'create'])->name('lowongan.create');
        Route::post('/tambah-lowongan', [LowonganController::class, 'store'])->name('lowongan.store');
        Route::get('/list-lowongan', [LowonganController::class, 'list'])->name('lowongan.list');
        Route::get('/lowongan/{id}/edit', [LowonganController::class, 'edit'])->name('lowongan.edit');
        Route::put('/lowongan/{id}', [LowonganController::class, 'update'])->name('lowongan.update');
        Route::delete('/lowongan/{id}', [LowonganController::class, 'destroy'])->name('lowongan.destroy');
    });

    // -- event
    Route::get('/submissions', [SubmissionController::class, 'index'])->name('submissions.index');
    Route::delete('/submissions/{id}', [SubmissionController::class, 'destroy'])->name('submissions.destroy');

    // --- Content Creator Management (OWNER DASHBOARD) ---
    Route::get('/content-creator', [ContentController::class, 'index'])->name('content-creator.index');
    Route::get('/content-creator/{id}', [ContentController::class, 'show'])->name('content-creator.show');
    Route::delete('/content-creator/{id}', [ContentController::class, 'destroy'])->name('content-creator.destroy');
    Route::get('/content-creator/{id}/verify', [ContentController::class, 'verify'])->name('content-creator.verify');
    Route::put('/content-creator/{id}/verify', [ContentController::class, 'updateStatus'])->name('content-creator.updateStatus');

    // --- Polisi Management ---
    Route::get('/admin/pelamar/polisi', [PolisiController::class, 'showPolisi'])->name('pelamar.polisi');
    Route::get('/polisi/index', [PolisiController::class, 'index'])->name('polisi.index');
    Route::get('/polisi/{id}', [PolisiController::class, 'show'])->name('polisi.show');
    Route::get('/polisi/{id}/verifikasi', [PolisiController::class, 'verifyPage'])->name('polisi.verify');
    Route::put('/polisi/{id}/verifikasi', [PolisiController::class, 'updateStatus'])->name('polisi.updateStatus');
    Route::delete('/polisi/{id}', [PolisiController::class, 'destroy'])->name('polisi.destroy');

    // --- Scripter Management ---
    Route::get('/admin/pelamar/scripter', [ScripterController::class, 'showScripter'])->name('pelamar.scripter');
    Route::get('/pelamar/scripter', [ScripterController::class, 'index'])->name('scripter.index');
    Route::get('/scripter/{id}', [ScripterController::class, 'show'])->name('scripter.show');
    Route::get('/scripter/{id}/verifikasi', [ScripterController::class, 'verifyPage'])->name('scripter.verify');
    Route::put('/scripter/{id}/verifikasi', [ScripterController::class, 'updateStatus'])->name('scripter.updateStatus');
    Route::delete('/scripter/{id}', [ScripterController::class, 'destroy'])->name('scripter.destroy');

    // --- BUG Management ---
    Route::get('/bug', [BugController::class, 'index'])->name('bug.index');
    Route::get('/bug/{id}/download', [BugController::class, 'download'])->name('bugs.download');

    // --- Robux Management ---
    Route::get('/robux/requests', [RobuxController::class, 'index'])->name('robux.index');
    Route::get('/robux/requests/{id}/verify', [RobuxController::class, 'verifyForm'])->name('robux.verifyForm');
    Route::put('/robux/requests/{id}/verify', [RobuxController::class, 'updateVerification'])->name('robux.updateVerification');
    Route::delete('/robux/requests/{id}', [RobuxController::class, 'destroy'])->name('robux.destroy');

    // --- 

    Route::get('/tambah-robux', [ProductController::class, 'create'])->name('product.create');
    Route::post('/tambah-robux', [ProductController::class, 'store'])->name('product.store');

    Route::get('/admin/robux', [ProductController::class, 'index'])->name('product.index');
    Route::get('/admin/robux/{id}/edit', [ProductController::class, 'edit'])->name('product.edit');
    Route::delete('/admin/robux/{id}', [ProductController::class, 'destroy'])->name('product.destroy');
    Route::resource('product', ProductController::class);
    Route::get('/orders', [OrderController::class, 'index'])->name('order.index');
    Route::delete('/order/{id}', [OrderController::class, 'destroy'])->name('order.destroy');
    Route::patch('/orders/{id}/complete', [OrderController::class, 'complete'])->name('order.complete');
    Route::patch('/orders/{order}/paid', [OrderController::class, 'paid'])->name('order.paid');

    Route::get('/showlaporan', [AdminController::class, 'laporanIndex'])
        ->name('admin.laporan');

    Route::get('/detaillaporan/{id}', [AdminController::class, 'laporanDetail'])
        ->name('admin.laporan.detail');

    Route::post('/laporan/{id}/status', [AdminController::class, 'updateStatus'])
        ->name('admin.laporan.status');
    // Tombol Hapus Laporan (hapus record + file)
    Route::delete('/admin/laporan/delete/{id}', [AdminController::class, 'deleteLaporan'])->name('admin.laporan.delete');

    Route::delete('/laporan/{id}', [AdminController::class, 'deleteLaporan'])
        ->name('admin.laporan.delete');

    Route::post('/admin/laporan/{id}/selesai', [AdminController::class, 'tandaiSelesai'])
        ->name('laporan.selesai');

    // Download attachment laporan
    Route::get('/admin/laporan/download/{id}', [AdminController::class, 'downloadLaporan'])->name('laporan.download');

    // LIST KASUS
    Route::get('/case', [KasusController::class, 'index'])->name('kasus.list');

    // FORM TAMBAH KASUS
    Route::get('/kasus/tambah', function () {
        return view('kasus'); // halaman form
    })->name('kasus.form');

    // PROSES TAMBAH KASUS
    Route::post('/kasus/tambah', [KasusController::class, 'tambahBukti'])->name('kasus.store');

    // DETAIL KASUS
    Route::get('/kasus/detail/{id}', [KasusController::class, 'detail'])->name('kasus.detail');

    // HAPUS KASUS
    Route::delete('/kasus/hapus/{id}', [KasusController::class, 'delete'])->name('kasus.hapus');


    Route::post('/shop-toggle', function () {
        $path = storage_path('app/shop_status.json');

        // baca file (atau default open=true)
        $data = ['open' => true];
        if (file_exists($path)) {
            $content = file_get_contents($path);
            $json = json_decode($content, true);
            if (is_array($json)) $data = $json;
        }

        // toggle
        $data['open'] = !($data['open'] ?? true);

        // simpan kembali
        file_put_contents($path, json_encode($data));

        return back()->with('success', 'Status toko berhasil diubah!');
    })->name('shop.toggle')->middleware(['auth']); // tambahkan middleware sesuai kebutuhan

});

/*
|--------------------------------------------------------------------------
| ADMIN ROUTES (role:admin)
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'role:admin'])->group(function () {

    Route::get('/dashboardAdmin', [AdminController::class, 'adminIndex'])->name('dashboardAdmin');

    // Bug routes (admin)
    Route::get('/bug', [BugController::class, 'index'])->name('bug.index');
    Route::delete('/bugs/{id}', [AdminController::class, 'deleteBug'])->name('bugs.delete');
    Route::get('/bug/{id}/download', [BugController::class, 'download'])->name('bugs.download');

    // Robux (admin/staff)
    Route::get('/minta-robux', fn() => view('mintaRobux'))->name('robux.form');
    Route::post('/robux/request', [RobuxController::class, 'requestRobux'])->name('robux.request');
    Route::get('/track-robux', [RobuxController::class, 'trackForm'])->name('robux.track.form');
    Route::post('/track-robux', [RobuxController::class, 'track'])->name('robux.track');
});
