<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\BendaharaController;
use App\Http\Controllers\DataSantriController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\WilayahController;
use GuzzleHttp\Middleware;
use Illuminate\Auth\Events\Login;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/



Route::get('/', function () {
    return redirect(route('daftarulang'));
});

Route::middleware('guest')->group(function () {
    Route::get('/login', [LoginController::class, 'index'])->name('login');
    Route::post('/login', [LoginController::class, 'store']);
    Route::get('/registrasi', [RegisterController::class, 'index'])->name('registrasi');
    Route::post('/registrasi', [RegisterController::class, 'registrasi']);
    Route::get('/forgot-password', [LoginController::class, 'forgetPassword'])->name('password.request');
    Route::post('/forgot-password', [LoginController::class, 'forgetPasswordStore']);
    Route::get('/reset-password/{token}', [LoginController::class, 'resetPassword'])->name('password.reset');
    Route::post('/reset-password/{token}', [LoginController::class, 'resetPasswordStore']);
});

Route::middleware('auth')->group(function () {
    Route::get('/email/verify', [LoginController::class, 'verifyEmail'])->name('verification.notice');
    Route::get('/email/verify/{id}/{hash}', [LoginController::class, 'verificationEmail'])->middleware(['auth', 'signed'])->name('verification.verify');
    Route::post('/email/verification-notification', [LoginController::class, 'verifyEmailSend'])->middleware(['throttle:6,1'])->name('verification.send');
    Route::get('/registrasi/otp/{nik}', [RegisterController::class, 'otp'])->name('otp');
    Route::post('/registrasi/otp/{nik}', [RegisterController::class, 'storeotp']);
    Route::get('/sendotp/{nik}', [RegisterController::class, 'sendotpback'])->name('sendotp');
    Route::post('/sendotp/{nik}', [RegisterController::class, 'sendotpbackupdate']);
    Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
});


Route::middleware(['auth', 'otp', 'verified'])->group(function () {
    Route::get('/datasantri/daftarulang', [DataSantriController::class, 'daftarulang'])->name('daftarulang');
    Route::get('/datasantri/daftarulang/s/form', [DataSantriController::class, 'formdaftarulang'])->name('formdaftarulang')->middleware('daftarulang');
    Route::post('/datasantri/daftarulang/s/form', [DataSantriController::class, 'updateformdaftarulang'])->middleware('daftarulang');
    Route::get('/user/profile', [UserController::class, 'index'])->name('user.profile');
    Route::get('/wifi', [UserController::class, 'wifi'])->name('user.wifi');
    Route::post('/wifi/add', [UserController::class, 'addWiFi'])->name('user.wifi.add');
    Route::post('/wifi/update', [UserController::class, 'updateWiFi'])->name('user.wifi.update');
    Route::post('/wifi/aktif/delete', [UserController::class, 'deleteAktifWiFi'])->name('user.wifi.aktif.delete');
    Route::get('/keuangan/tagihan', [BendaharaController::class, 'tagihan'])->name('bendahara.tagihan');
    Route::middleware('bendahara')->group(function () {
        Route::get('/datasantri/datadaftarulang', [DataSantriController::class, 'datadaftarulang'])->name('datadaftarulang');
        Route::get('/datasantri', [DataSantriController::class, 'datasantri'])->name('datasantri');
        Route::get('/datasantri/daftarulang/e/{nik}', [DataSantriController::class, 'editDataDaful'])->name('editDataDaful');
        Route::post('/datasantri/daftarulang/e/{nik}', [DataSantriController::class, 'UpdateDataDaful']);
        Route::get('/datasantri/daftarulang/d/{nik}', [DataSantriController::class, 'deleteDataDaful'])->name('deleteDataDaful');
        Route::get('/keuangan/tagihan/manajer', [BendaharaController::class, 'tagihanManeger'])->name('bendahara.tagihan.menejer');
        Route::get('/keuangan/tagihan/create', [BendaharaController::class, 'add'])->name('bendahara.add');
        Route::post('/keuangan/tagihan/create', [BendaharaController::class, 'store']);
        Route::get('/keuangan/tagihan/edit/{id}', [BendaharaController::class, 'edit'])->name('bendahara.edit');
        Route::post('/keuangan/tagihan/edit/{id}', [BendaharaController::class, 'update']);
        Route::get('/keuangan/tagihan/delete/{id}', [BendaharaController::class, 'delete'])->name('bendahara.delete');
    });
    Route::middleware('admin')->group(function () {
        Route::get('/admin', [AdminController::class, 'police'])->name('police');
        Route::get('/removeadmin/{nis}', [AdminController::class, 'remove'])->name('removeAdmin');
        Route::post('/addadmin', [AdminController::class, 'add'])->name('addAdmin');
        Route::get('/whatsapp', [AdminController::class, 'whatsapp'])->name('whatsapp');
    });
});



Route::post('/cities', [WilayahController::class, 'kabupaten'])->name('cities');
Route::post('/districts', [WilayahController::class, 'kecamatan'])->name('districts');
Route::post('/villages', [WilayahController::class, 'desa'])->name('villages');
