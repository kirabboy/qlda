<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
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

Route::get('/', [AdminController::class, 'index'])->name('home');

Route::get('signin', [AdminController::class, 'signinform'])->name('signin-form-login');
Route::post('signin', [AdminController::class, 'signin'])->name('signin');

Route::get('register', [AdminController::class, 'registerform'])->name('register');
Route::post('register', [AdminController::class, 'register'])->name('register');

Route::get('forgotpw', [AdminController::class, 'forgotpw'])->name('forgotpw');