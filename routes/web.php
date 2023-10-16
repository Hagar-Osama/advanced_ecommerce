<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AdminProfileController;
use App\Http\Controllers\BrandController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ColorController;
use App\Http\Controllers\EndUser\HomeController;
use App\Http\Controllers\EndUser\UserProfileController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\SizeController;
use Illuminate\Support\Facades\App;
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
    return redirect(App::getLocale());
});

//////////////////EndUser Routes///////////////////////////
Route::group(['prefix' => '{locale}', 'where' => ['locale' => '[a-zA-Z]{2}'], 'middleware' => 'setLocale'], function () {
    Route::get('/', [HomeController::class, 'index'])->name('home');
    Route::post('/user/login', [UserProfileController::class, 'login'])->name('user.login');
    Route::group(['prefix' => 'user', 'middleware' => ['auth'], 'as' => 'user.'], function () {
        Route::get('/dashboard', [UserProfileController::class, 'userDashboard'])->name('dashboard')->middleware('auth:sanctum,web', 'verified');
        Route::get('/logout', [UserProfileController::class, 'logout'])->name('logout');
        Route::put('/profile/update/password', [UserProfileController::class, 'updatePassword'])->name('profile.updatePassword');
        Route::prefix('/{userId}')->group(function () {
            Route::get('/profile/edit', [UserProfileController::class, 'edit'])->name('profile.edit');
            Route::put('/profile/update', [UserProfileController::class, 'update'])->name('profile.update');
        });
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
    ///////Brands Route///////
    Route::group(['prefix' => 'brands', 'as' => 'brands.'], function () {
        Route::get('/', [BrandController::class, 'index'])->name('index');
        Route::get('/create', [BrandController::class, 'create'])->name('create');
        Route::post('/store', [BrandController::class, 'store'])->name('store');
        Route::prefix('{brandId}')->group(function () {
            Route::get('/edit', [BrandController::class, 'edit'])->name('edit');
            Route::put('/update', [BrandController::class, 'update'])->name('update');
            Route::get('/delete', [BrandController::class, 'destroy'])->name('destroy');
        });
    });

    ///////Categories Route///////
    Route::group(['prefix' => 'categories', 'as' => 'categories.'], function () {
        Route::get('/', [CategoryController::class, 'index'])->name('index');
        Route::get('/create', [CategoryController::class, 'create'])->name('create');
        Route::post('/store', [CategoryController::class, 'store'])->name('store');
        Route::prefix('{categoryId}')->group(function () {
            Route::get('/edit', [CategoryController::class, 'edit'])->name('edit');
            Route::put('/update', [CategoryController::class, 'update'])->name('update');
            Route::get('/delete', [CategoryController::class, 'destroy'])->name('destroy');
        });
        Route::get('/subcategory/ajax/{category_id}', [CategoryController::class, 'getChildCategory']);
    });

    ///////PRODUCTS Route///////
    Route::group(['prefix' => 'products', 'as' => 'products.'], function () {
        Route::get('/', [ProductController::class, 'index'])->name('index');
        Route::get('/create', [ProductController::class, 'create'])->name('create');
        Route::post('/store', [ProductController::class, 'store'])->name('store');
        Route::prefix('{productId}')->group(function () {
            Route::get('/edit', [ProductController::class, 'edit'])->name('edit');
            Route::put('/update', [ProductController::class, 'update'])->name('update');
            Route::get('/delete', [ProductController::class, 'destroy'])->name('destroy');
        });
        Route::put('image', [ProductController::class, 'updateImages'])->name('updateImage');
        Route::get('image/{imageId}/delete', [ProductController::class, 'deleteImage'])->name('deleteImage');
    });
    ///////Colors Route///////
    Route::group(['prefix' => 'colors', 'as' => 'colors.'], function () {
        Route::get('/', [ColorController::class, 'index'])->name('index');
        Route::post('/store', [ColorController::class, 'store'])->name('store');
        Route::prefix('{colorId}')->group(function () {
            Route::put('/update', [ColorController::class, 'update'])->name('update');
            Route::get('/delete', [ColorController::class, 'destroy'])->name('destroy');
        });
    });
    ///////Sizes Route///////
    Route::group(['prefix' => 'sizes', 'as' => 'sizes.'], function () {
        Route::get('/', [SizeController::class, 'index'])->name('index');
        Route::post('/store', [SizeController::class, 'store'])->name('store');
        Route::prefix('{sizeId}')->group(function () {
            Route::put('/update', [SizeController::class, 'update'])->name('update');
            Route::get('/delete', [SizeController::class, 'destroy'])->name('destroy');
        });
    });

    // Route::get('/dashboard', [AdminController::class, 'index'])->name('admin.index');;



});

Route::middleware(['auth:sanctum,admin', 'verified'])->group(function () {
    Route::get('/admin/dashboard', function () {
        return view('admin.index');
    })->name('admin.index')->middleware('auth:admin');
});

// Route::group(['prefix' => '{locale}', 'where' => ['locale' => '[a-zA-Z]{2}'], 'middleware' => 'setLocale'], function () {
//     Route::middleware(['auth:sanctum,web', 'verified'])->group(function () {
//         Route::get('/dashboard', function () {
//             return view('dashboard');
//         })->name('user.dashboard');
//     });
// });
