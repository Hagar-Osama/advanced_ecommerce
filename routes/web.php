<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AdminProfileController;
use App\Http\Controllers\EndUser\HomeController;
use App\Http\Controllers\EndUser\UserProfileController;
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

// Route::get('/', function () {
//     return view('welcome');
// });

//////////////////EndUser Routes///////////////////////////
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::group(['prefix' => 'user', 'middleware' => ['auth'], 'as' => 'user.'], function () {
    Route::get('/logout', [UserProfileController::class, 'logout'])->name('logout');
    Route::put('/profile/update/password', [UserProfileController::class, 'updatePassword'])->name('profile.updatePassword');
    Route::prefix('/{userId}')->group(function () {
        Route::get('/profile/edit', [UserProfileController::class, 'edit'])->name('profile.edit');
        Route::put('/profile/update', [UserProfileController::class, 'update'])->name('profile.update');
    });
});


Route::group(['prefix' => 'admin', 'as' => 'admin.', 'middleware' => ['admin']], function () {
    Route::get('/login', [AdminController::class, 'showLoginForm']);
    Route::post('/login', [AdminController::class, 'store'])->name('login');
    Route::get('/logout', [AdminController::class, 'logout'])->name('logout');
    Route::get('/profile', [AdminProfileController::class, 'index'])->name('profile');
    Route::put('/profile/update/password', [AdminProfileController::class, 'updatePassword'])->name('profile.updatePassword');
    Route::prefix('/{adminId}')->group(function () {
        Route::get('/profile/edit', [AdminProfileController::class, 'edit'])->name('profile.edit');
        Route::put('/profile/update', [AdminProfileController::class, 'update'])->name('profile.update');
    });



    // Route::get('/dashboard', [AdminController::class, 'index'])->name('admin.index');;



});

Route::middleware(['auth:sanctum,admin', 'verified'])->group(function () {
    Route::get('/admin/dashboard', function () {
        return view('admin.index');
    })->name('admin.index')->middleware('auth:admin');
});


Route::middleware(['auth:sanctum,web', 'verified'])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});
