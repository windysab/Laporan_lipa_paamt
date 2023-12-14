<?php

use App\Models\PerkaraPns;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\GaibController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\DirputController;
use App\Http\Controllers\PerkaraController;
use App\Http\Controllers\SubjectController;
use App\Http\Controllers\ScheduleController;
use App\Http\Controllers\PerkaraPnsController;
use App\Http\Controllers\JadwalSidangController;
use App\Http\Controllers\PerkaraLipa1Controller;
use App\Http\Controllers\PerkaraMasukController;
use App\Http\Controllers\PerkaraEcourtController;
use App\Http\Controllers\DispensasiKawinController;
use App\Http\Controllers\PerkaraMasukControllerBlg;

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

// Route::get('/', function () {
//     return view('pages.auth.auth-login');
// });

// Route::middleware(['auth'])->group(function () {
//     Route::get('home', function () {
//         return view('pages.app.dashboard-siakad', ['type_menu' => '']);
//     })->name('home');
//     Route::resource('user', UserController::class);
// });


Route::get('/', function () {
    return view('pages.app.dashboard-siakad', ['type_menu' => '']);
})->name('home');

Route::resource('perkara-masuk', PerkaraMasukController::class);
Route::resource('perkara-masuk-blg', PerkaraMasukControllerBlg::class);

// Route::resource('jadwal-sidang', JadwalSidangController::class);

// Route::get('/perkara', [PerkaraController::class, 'index'])->name('perkara.index');
// Route::get('/perkara', [PerkaraController::class, 'getPerkaraData'])->name('perkara.index');
Route::get('/perkara', [PerkaraController::class, 'index'])->name('perkara.index');
Route::get('/perkara-gaib', [GaibController::class, 'index'])->name('perkara-gaib.index');

Route::get('/perkara-pns', [PerkaraPnsController::class, 'index'])->name('perkara-pns.index');
Route::get('/perkara-lipa1', [PerkaraLipa1Controller::class, 'index'])->name('perkara-lipa1.index');






Route::get('/perkara-ecourt', [PerkaraEcourtController::class, 'index'])->name('perkara-ecourt.index');
Route::get('/perkara-diska', [DispensasiKawinController::class, 'index'])->name('perkara-diska.index');
Route::get('/jadwal-sidang', [JadwalSidangController::class, 'index'])->name('jadwal-sidang.index');
Route::get('/dirput', [DirputController::class, 'index'])->name('dirput.index');

Route::get('/export-lipa1', [PerkaraLipa1Controller::class, 'exportLipa1'])->name('export-lipa1');

// Route::get('/jadwal-sidang', 'JadwalSidangController@index')->name('jadwal-sidang.index');
// Route::get('/perkara-ecourt', 'PerkaraEcourtController')->name('perkara-ecourt.index');

// Route::get('/perkara-masuk', [PerkaraMasukController::class, 'index'])->name('perkara-masuk.index');

// // resource route for subject with middleware auth
// Route::middleware(['auth'])->group(function () {
//     Route::resource('subject', SubjectController::class);
// });

// resource route for schedule with middleware auth
// Route::middleware(['auth'])->group(function () {
//     Route::resource('schedule', ScheduleController::class);
// });

// // get route for generate qrcode with param schedule and with middleware auth
// Route::middleware(['auth'])->group(function () {
//     Route::get('generate-qrcode/{schedule}', [ScheduleController::class, 'generateQrCode'])->name('generate-qrcode');
// });

// // Route::middleware(['auth'])->group(function () {
// //     Route::get('generate-qrcode', [ScheduleController::class, 'generateQrCode'])->name('generate-qrcode');
// // });

// // put route for generate qrcode with middleware auth
// Route::middleware(['auth'])->group(function () {
//     Route::put('generate-qrcode-update/{schedule}', [ScheduleController::class, 'generateQrCodeUpdate'])->name('generate-qrcode-update');
// });

// Route::get('/login', function () {
//     return view('pages.auth.auth-login');
// })->name('login');

// Route::get('/register', function () {
//     return view('pages.auth.auth-register');
// })->name('register');

// Route::get('/forgot', function () {
//     return view('pages.auth.auth-forgot-password');
// })->name('forgot');

// Route::get('/reset-password', function () {
//     return view('pages.auth.auth-reset-password');
// })->name('reset-password');
