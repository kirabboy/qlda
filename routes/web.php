<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AccountController;
use App\Http\Controllers\EmployeeController;

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
    return view('welcome');
});



Route::prefix('account')->group(function(){
        Route::get('', [AccountController::class, 'index'])
            ->name('account.index');

        Route::get('create', [AccountController::class, 'create'])
            ->name('account.create');

        Route::post('store', [AccountController::class, 'store'])
            ->name('account.store');

        Route::get('edit/{id}', [AccountController::class, 'edit'])
            ->name('account.edit');
            
        Route::put('update/{id}', [AccountController::class, 'update'])
            ->name('account.update');

        Route::get('delete/{id}', [AccountController::class, 'delete'])
            ->name('account.delete');

    });
Route::prefix('employee')->group(function(){
        Route::get('', [AccountController::class, 'index'])
            ->name('employee.index');

        Route::get('create', [AccountController::class, 'create'])
            ->name('employee.create');

        Route::post('store', [AccountController::class, 'store'])
            ->name('employee.store');

        Route::get('edit/{id}', [AccountController::class, 'edit'])
            ->name('employee.edit');
            
        Route::put('update/{id}', [AccountController::class, 'update'])
            ->name('employee.update');

        Route::get('delete/{id}', [AccountController::class, 'delete'])
            ->name('employee.delete');
    });