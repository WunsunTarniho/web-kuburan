<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\GoogleController;
use App\Http\Controllers\GraveController;
use App\Http\Controllers\TrashController;
use App\Http\Controllers\UserController;
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


Route::group(['middleware' => 'auth'], function () {
    Route::resource('/grave', GraveController::class);
    Route::resource('/trash', TrashController::class)->middleware('user');
    Route::get('/logout', [AuthController::class, 'logout']);
    Route::get('/grave/{grave:slug}', [GraveController::class, 'show']);
    Route::get('/', [GraveController::class, 'index']);
});

Route::resource('/user', UserController::class);
Route::get('/register', [UserController::class, 'register'])->middleware('guest');
Route::get('/login', [AuthController::class, 'login'])->middleware('guest')->name('login');
Route::post('/login', [AuthController::class, 'auth']);

Route::get('/auth/google', [GoogleController::class, 'redirectToGoogle'])->name('auth.google');
Route::get('/auth/google/callback', [GoogleController::class, 'handleGoogleCallback'])->name('google.callback');