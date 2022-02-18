<?php

use App\Http\Controllers\Web\Admin\Product\CategoryController;
use App\Http\Controllers\Web\Admin\Product\ProductController;
use App\Http\Controllers\Web\HomeController;
use App\Http\Controllers\Web\OrderController;
use Illuminate\Support\Facades\Route;

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

/**
 * Home page
 */
Route::get('/', [HomeController::class, 'index'])->name('home');

/**
 * Orders page
 */
Route::middleware(['auth:web', 'verified'])->resource('order', OrderController::class);

/**
 * Admin panel
 */
Route::group(['middleware' => ['auth:web', 'verified', 'password.confirm']], static function () {
    Route::resource('category', CategoryController::class);
    Route::resource('product', ProductController::class);
});
