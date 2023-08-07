<?php

use Illuminate\Support\Facades\Route;
use App\Models\Consultant;
use App\Http\Controllers\API\GuestController;
use App\Http\Controllers\API\QueueController;
use App\Http\Controllers\API\EditController;
use App\Http\Controllers\API\ConsultantController;
use App\Http\Controllers\API\LoginController;
use App\Http\Controllers\API\RegisterController;
use App\Http\Controllers\API\LandingpageController;
use App\Http\Controllers\API\Auth\EmailVerificationController;
use App\Http\Middleware\CheckRole;

// use Illuminate\Auth\Listeners\EmailVerificationController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::middleware(['checkRole:VIP,NONVIP'])->group(function () {
    // guest
    Route::get('guest-home', [QueueController::class, 'index'])->name('guest-home');
    Route::get('guest-create', [QueueController::class, 'create'])->name('guest-create');
    Route::post('guest-store', [QueueController::class, 'store'])->name('guest-store');
    Route::get('guest-detail/{id} ', [QueueController::class, 'show'])->name('guest-queue-show');
    Route::delete('guest-queue-del/{id} ', [QueueController::class, 'destroy'])->name('guest-queue-del');

    // edit password
    Route::get('account', [EditController::class, 'editPass'])->name('edit-pass');
    Route::post('account', [EditController::class, 'changePass'])->name('change-pass');

    // upload foto profil
    Route::get('foto', [GuestController::class, 'upload'])->name('foto-profil');
    Route::post('foto', [GuestController::class, 'fileUpload'])->name('foto-upload');

    // update biodata
    Route::get('biodata', [GuestController::class, 'edit'])->name('biodata');
    Route::post('biodata', [GuestController::class, 'update'])->name('biodata-update');
});

Route::middleware('checkRole:consultant')->group(function () {
    // consultant
    Route::get('consultant-home', [QueueController::class, 'indexConsultant'])->name('consultant-home');
    Route::get('consultant-detail/{id}', [QueueController::class, 'showConsultant'])->name('consultant-queue-show');

    // search
    Route::get('search', [QueueController::class, 'search'])->name('search');
});

Route::middleware('checkRole:admin')->group(function () {
    // request
    Route::get('request', [QueueController::class, 'requestAdmin'])->name('admin-request');
    Route::post('request-filter', [QueueController::class, 'handleFilter'])->name('admin-request-filter');
    Route::delete('delete/{id} ', [QueueController::class, 'destroy'])->name('admin-queue-del');

    // update
    Route::get('edit/{id}', [QueueController::class, 'edit'])->name('admin-request-edit');
    Route::post('edit', [QueueController::class, 'update'])->name('admin-request-update');

    // history
    Route::get('history', [QueueController::class, 'history'])->name('admin-history');

    // export
    Route::get('admin-export', [QueueController::class, 'exportQueue'])->name('admin-export');

    // set consultant
    Route::get('setting', [ConsultantController::class, 'index'])->name('admin-set-index');
});

Route::get('/verify-email', [EmailVerificationController::class, 'show'])
    ->middleware('auth')
    ->name('verification.notice'); // <-- don't change the route name

Route::post('/verify-email/request', [EmailVerificationController::class, 'request'])
    ->middleware('auth')
    ->name('verification.request');

Route::get('/verify-email/{id}/{hash}', [EmailVerificationController::class, 'verify'])
    ->middleware(['auth', 'checkRole:VIP,NONVIP', 'signed']) // <-- don't remove "signed"
    ->name('verification.verify'); // <-- don't change the route name

// logout
Route::post('logout', [LoginController::class, 'logout'])->name('logout');

// login
Route::post('login', [LoginController::class, 'authenticate'])->name('login');

// login admin
Route::post('login-admin', [LoginController::class, 'authenticateAdmin'])->name('login-admin');

// register
Route::post('register', [RegisterController::class, 'store'])->name('register');

// landingpage
Route::get('/', [LandingpageController::class, 'landingpage']);
Route::post('/', [LandingpageController::class, 'storeContactForm'])->name('send-contact-form');




// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });
