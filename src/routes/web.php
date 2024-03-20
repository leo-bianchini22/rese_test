<?php

use App\Http\Controllers\NavigateController;
use App\Http\Controllers\ReseController;
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

Route::get('/', [ReseController::class, 'index']);
Route::get('/thanks', [ReseController::class, 'thanks']);

Route::get('/nav', [NavigateController::class, 'nav']);
Route::post('/nav/back', [NavigateController::class, 'previousPage']);

Route::get('/mypage', [ReseController::class, 'myPage']);
Route::get('/detail', [ReseController::class, 'detail']);
Route::get('/done', [ReseController::class, 'done']);