<?php

use App\Http\Controllers\TiketController;
use App\Http\Controllers\loginController;
use App\Http\Controllers\UserController;
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

Route::get('/login', [loginController::class, 'index'])->name('login')->middleware('guest');
Route::post('/login', [loginController::class, 'authenticate']);
Route::post('/logout', [loginController::class, 'logout']);

Route::get('/', function () {
    return view('tiket');
});
Route::get('/dashboard', function () {
    return view('content.dashboard', ['title' => 'Dashboard']);
})->middleware('auth');
Route::get('/tikets', [TiketController::class, 'index'])->middleware('auth');
Route::get('master-tikets', [TiketController::class, 'getTikets']);
Route::get('master-tikets-total', [TiketController::class, 'getTotal']);
Route::get('master-tiket', [TiketController::class, 'getTiket']);
Route::get('master-tiket-chekIn', [TiketController::class, 'putTiket']);
Route::get('master-tiket-edit', [TiketController::class, 'editTiket']);
Route::post('master-tiket-save', [TiketController::class, 'postTiket']);
Route::post('master-tiket-update', [TiketController::class, 'updateTiket']);
Route::get('master-tiket-delete', [TiketController::class, 'deleteTiket']);

// route users
Route::get('/users', [UserController::class, 'index'])->middleware('auth');
Route::get('master-users', [UserController::class, 'getUsers']);
Route::get('master-user', [UserController::class, 'getUser']);
Route::post('master-user-save', [UserController::class, 'postUser']);
Route::post('master-user-update', [UserController::class, 'updateUser']);
Route::get('master-user-delete', [UserController::class, 'deleteUser']);
