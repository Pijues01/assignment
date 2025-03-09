<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AudioController;
// use PhpParser\Node\Expr\Assign;
use App\Http\Controllers\DistanceController;
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
Route::view('/welcome', 'welcome')->name('welcome');

Route::get('/', [UserController::class, 'showLoginForm'])->name('login');
Route::post('/register', [UserController::class, 'registeruser'])->name('register');
Route::post('/loginuser', [UserController::class, 'loginuser'])->name('loginuser');


Route::middleware(['auth'])->group(function () {
Route::get('/dashboard', [UserController::class, 'dashboard'])->name('dashboard');
Route::get('/logout', [UserController::class, 'logout'])->name('logout');
Route::get('/export', [UserController::class, 'exportCSV'])->name('users.export');
Route::post('/users/create', [UserController::class, 'create'])->name('users.create');
Route::post('/users/update', [UserController::class, 'update'])->name('users.update');
Route::post('/users/delete', [UserController::class, 'delete'])->name('users.delete');


// Assignment-2
Route::view('/audio', 'assignment/audio')->name('audio');
Route::post('/get-audio-duration', [AudioController::class, 'getDuration']);

// Assignment-3
Route::post('/calculate-distance', [DistanceController::class, 'getDistance'])->name('distance.calculate');
});
