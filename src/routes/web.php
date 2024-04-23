<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\FavoriteController;
use App\Http\Controllers\NavigateController;
use App\Http\Controllers\ReseController;
use App\Http\Controllers\ReservationController;
use App\Http\Controllers\ReviewController;
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

Route::get('/', [ReseController::class, 'home']);
Route::get('/search', [ReseController::class, 'search']);
Route::get('/reservation/list', [ReseController::class, 'listReservation']);

Route::get('/nav', [NavigateController::class, 'nav']);
Route::post('/back', [NavigateController::class, 'previousPage']);

Route::get('/detail/{id}', [ReservationController::class, 'detailById'])->name('shopId');
Route::post('/detail/store', [ReservationController::class, 'storeReservation']);
Route::delete('/reservation/delete', [ReservationController::class, 'deleteReservation']);
Route::get('/reservation/edit', [ReservationController::class, 'editReservation']);
Route::post('/reservation/update', [ReservationController::class, 'updateReservation']);

Route::get('/review', [ReviewController::class, 'review']);
Route::post('/review/store', [ReviewController::class, 'store']);
Route::get('/review/detail', [ReviewController::class, 'reviewDetail']);

Route::middleware('auth')->group(function () {
    Route::get('/mypage', [ReseController::class, 'myPage']);
    Route::post('/favorite/toggle/{id}', [FavoriteController::class, 'toggleFavorite'])->name('toggleFavorite');
});

Route::get('/restaurant/edit', [AdminController::class, 'editRestaurant']);
Route::post('/restaurant/update', [AdminController::class, 'updateRestaurant']);
Route::post('/register/representative', [AdminController::class, 'storeRepresentative']);
Route::get('/admin', [AdminController::class, 'admin']);
Route::get('/admin/representative', [AdminController::class, 'representative']);
Route::delete('/representative/delete', [AdminController::class, 'deleteRepresentative']);