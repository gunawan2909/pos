<?php

use App\Models\Menu;
use App\Jobs\StuckJob;
use App\Models\Pesanan;
use GuzzleHttp\Middleware;
use App\Events\PesananPaid;
use Illuminate\Auth\Events\Login;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\JabatanController;
use App\Http\Controllers\PesananController;
use App\Http\Controllers\WilayahController;
use App\Http\Controllers\BendaharaController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ReservasiController;
use App\Http\Controllers\TransaksiController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\DataSantriController;
use App\Http\Controllers\PersediaanController;
use App\Http\Controllers\Auth\RegisterController;
use App\Jobs\StruckJob;
use App\Mail\SendStruk;

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
    return view('LandingPage', [
        'menu' => Menu::where('status', true)->get()
    ]);
})->name('home');
Route::get('/karyawan', function () {
    return view('Auth.Karyawan');
})->name('karyawan');
Route::get('/tes', function () {
    // Mail::to('gunawan@gmail.com')->send(new SendStruk(1));
    // $email = Pesanan::where('id', 1)->get()[0]->email;
    // $id = Pesanan::where('id', 1)->get()[0]->id;
    // Mail::to($email)->send(new SendStruk($id));
    dispatch(new StruckJob(16));
    return "sukses";
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

    //Dashboard 
});

Route::middleware('auth', 'karyawan')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/email/verify', [LoginController::class, 'verifyEmail'])->name('verification.notice');
    Route::get('/email/verify/{id}/{hash}', [LoginController::class, 'verificationEmail'])->middleware(['auth', 'signed'])->name('verification.verify');
    Route::post('/email/verification-notification', [LoginController::class, 'verifyEmailSend'])->middleware(['throttle:6,1'])->name('verification.send');
    Route::post('/logout', [LoginController::class, 'logout'])->name('logout');


    //persediaan
    Route::get('/persediaan', [PersediaanController::class, 'index'])->name('persediaan');
    Route::post('/persediaan/add', [PersediaanController::class, 'store'])->name('persediaan.store');
    Route::get('/persediaan/edit/{id}', [PersediaanController::class, 'edit'])->name('persediaan.edit');
    Route::post('/persediaan/edit/{id}', [PersediaanController::class, 'update']);
    Route::get('/persediaan/restock/{id}', [PersediaanController::class, 'restock'])->name('persediaan.resetock');
    Route::post('/persediaan/restock/{id}', [PersediaanController::class, 'restockStore']);
    Route::post('/persediaan/delete/{id}', [PersediaanController::class, 'delete'])->name('persediaan.delete');
    Route::get('/persediaan/riwayat', [PersediaanController::class, 'riwayat'])->name('persediaan.riwayat');
    Route::get('/persediaan/riwayat/edit/{id}', [PersediaanController::class, 'riwayatEdit'])->name('persediaan.riwayat.edit');
    Route::post('/persediaan/riwayat/edit/{id}', [PersediaanController::class, 'riwayatUpdate']);
    Route::post('/persediaan/riwayat/delete/{id}', [PersediaanController::class, 'riwayatDelete'])->name('persediaan.riwayat.delete');


    //menu
    Route::get('/menu', [MenuController::class, 'index'])->name('menu');
    Route::post('menu/create', [MenuController::class, 'create'])->name('menu.cretae');
    Route::get('/menu/add/{id}', [MenuController::class, 'add'])->name('menu.add');
    Route::post('/menu/add/{id}', [MenuController::class, 'store']);
    Route::get('/menu/addPersediaan/{id}', [MenuController::class, 'addPersediaan'])->name('menu.addPersediaan');
    Route::post('/menu/addPersediaan/persediaan', [MenuController::class, 'storePersediaan'])->name('menu.add.persediaan');
    Route::post('/menu/addPersediaan/delete{id}', [MenuController::class, 'deletePersediaan'])->name('menu.add.persediaan.delete');
    Route::get('/menu/detele{id}', [MenuController::class, 'delete'])->name('menu.delete');


    Route::get('/pesanan/pay/seller/{id}', [PesananController::class, 'invoiceSeller'])->name('pesanan.pay.seller');
    Route::post('/pesanan/pay/seller/{id}', [PesananController::class, 'pay']);
    Route::get('/pesanan/pesanan/', [PesananController::class, 'index'])->name('pesanan.pesanan.index');

    Route::get('/pesanan/reservasi/', [ReservasiController::class, 'index'])->name('pesanan.reservasi.index');
    Route::get('/pesanan/reservasi/pay/{id}', [ReservasiController::class, 'reservasi'])->name('pesanan.reservasi.pay');
    Route::post('/pesanan/pay/reservasi/{id}', [ReservasiController::class, 'pay'])->name('pesanan.pay.reservasi');

    Route::get('/pesanan/monitoring', [PesananController::class, 'monitoring'])->name('pesanan.monitoring');
    Route::post('/pesanan/status/complited/{id}', [PesananController::class, 'complited'])->name('pesanan.status.complited');


    //Laporan 
    Route::get('/laporan', [TransaksiController::class, 'index'])->name('laporan.index');


    //user
    Route::get('/user', [UserController::class, 'index'])->name('user.index');
    Route::get('/user/edit/{id}', [UserController::class, 'edit'])->name('user.edit');
    Route::post('/user/edit/{id}', [UserController::class, 'update']);
    Route::post('/user/delete/{id}', [UserController::class, 'delete'])->name('user.detele');
    Route::get('/user/setting', [UserController::class, 'setting'])->name('user.setting');
    Route::post('/user/setting', [UserController::class, 'settingStore']);

    //jabatan 
    Route::get('/jabatan', [JabatanController::class, 'index'])->name('jabatan.index');
    Route::get('/jabatan/add', [JabatanController::class, 'add'])->name('jabatan.add');
    Route::post('/jabatan/add', [JabatanController::class, 'store']);
    Route::get('/jabatan/edit/{id}', [JabatanController::class, 'edit'])->name('jabatan.edit');
    Route::post('/jabatan/edit/{id}', [JabatanController::class, 'store']);
    Route::post('/jabatan/delete/{id}', [JabatanController::class, 'delete'])->name('jabatan.delete');
});
//Pesanan 
Route::get('/pesanan/add', [PesananController::class, 'add'])->name('pesanan.add');
Route::post('/pesanan/add', [PesananController::class, 'store']);
Route::get('/pesanan/list/{id}', [PesananController::class, 'create'])->name('pesanan.list');
Route::post('/pesanan/list/{id}', [PesananController::class, 'listStore']);
Route::get('/pesanan/deleteList/{id}', [PesananController::class, 'listDelete'])->name('pesanan.list.delete');
Route::post('/pesanan/addList/{id}', [PesananController::class, 'listAdd'])->name('pesanan.list.add');
Route::post('/pesanan/minList/{id}', [PesananController::class, 'listminus'])->name('pesanan.list.min');
Route::get('/pesanan/invoice/{id}', [PesananController::class, 'invoice'])->name('pesanan.invoice');
Route::get('/pesanan/status/{id}', [PesananController::class, 'status'])->name('pesanan.status');
Route::get('/pesanan/pay/customer/{id}', [PesananController::class, 'payCustomer'])->name('pesanan.pay.customer');

//reservasi 
Route::get('/pesanan/reservasi/add', [ReservasiController::class, 'add'])->name('pesanan.reservasi.add');
Route::post('/pesanan/reservasi/add', [ReservasiController::class, 'store']);
Route::get('/pesanan/reservasi/list/{id}', [ReservasiController::class, 'create'])->name('pesanan.reservasi.list');
Route::post('/pesanan/reservasi/list/{id}', [ReservasiController::class, 'listStore']);
Route::get('/pesanan/reservasi/kuota/{id}', [ReservasiController::class, 'kuota'])->name('pesanan.reservasi.kuota');
Route::post('/pesanan/reservasi/kuota/{id}', [ReservasiController::class, 'kuotaStore']);
Route::get('/pesanan/reservasi/deleteList/{id}', [ReservasiController::class, 'listDelete'])->name('pesanan.reservasi.list.delete');
Route::post('/pesanan/reservasi/addList/{id}', [ReservasiController::class, 'listAdd'])->name('pesanan.reservasi.list.add');
Route::post('/pesanan/reservasi/minList/{id}', [ReservasiController::class, 'listminus'])->name('pesanan.reservasi.list.min');

Route::get('/pesanan/reservasi/status/{id}', [ReservasiController::class, 'status'])->name('pesanan.reservasi.status');
Route::get('/pesanan/reservasi/DownPayment/{id}', [ReservasiController::class, 'DP'])->name('pesanan.reservasi.downpayment');
