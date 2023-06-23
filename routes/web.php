<?php

use App\DataTables\ProjectReportDataTable;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\ProjectReportController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AccountController;

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
    return view('index');
});


Route::middleware(['auth'])->group(function () {
    /* Project */
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('project', [ProjectController::class, 'index'])->name('project.index');
    Route::get('project/add', [ProjectController::class, 'add'])->name('project.add');
    Route::post('project/store', [ProjectController::class, 'store'])->name('project.store');
    Route::get('project/edit/{id}', [ProjectController::class, 'edit'])->name('project.edit');
    Route::put('project/update/{id}', [ProjectController::class, 'update'])->name('project.update');
    Route::delete('project/destroy/{id}', [ProjectController::class, 'destroy'])->name('project.destroy');
    Route::get('project/download/{id}', [ProjectController::class, 'downloadFile'])->name('download.file');

    /* Project Report*/
    Route::get('project-report', [ProjectReportController::class, 'index'])->name('project.report.index');
    Route::get('project-report/add', [ProjectReportController::class, 'add'])->name('project.report.add');
    Route::post('project-report/store', [ProjectReportController::class, 'store'])->name('project.report.store');
    Route::get('project-report/edit/{id}', [ProjectReportController::class, 'edit'])->name('project.report.edit');
    Route::put('project-report/update/{id}', [ProjectReportController::class, 'update'])->name('project.report.update');
    Route::delete('project-report/destroy/{id}', [ProjectReportController::class, 'destroy'])->name('project.report.destroy');


    Route::get('sign-out', [AuthController::class, 'sign_out'])->name('sign.out');
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
Route::get('/', [AdminController::class, 'index'])->name('home');

Route::get('signin', [AdminController::class, 'signinform'])->name('signin');
Route::post('/signin', [AdminController::class, 'signin'])->name('signin');

Route::get('register', [AdminController::class, 'registerform'])->name('register');
Route::post('register', [AdminController::class, 'register'])->name('register');

Route::get('forgotpw', [AdminController::class, 'forgotpw'])->name('forgotpw');
