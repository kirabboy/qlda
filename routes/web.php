<?php

use App\Http\Controllers\AccountController;
use App\Http\Controllers\AccountController_ton;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DownloadFileController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\LibraryController;
use App\Http\Controllers\LocalizedController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\ProjectReportController;
use App\Models\Employee;
use CKSource\CKFinder\Command\DownloadFile;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\App;

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

Route::get('locale/{lang}', [LocalizedController::class, 'setLang'])->name('setLang');

Route::middleware(['auth'])->group(function () {
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
    Route::post('sign-out', [AuthController::class, 'sign_out'])->name('sign.out');

    Route::middleware(['employee'])->group(function () {
        /* Project Report*/
        Route::get('project-report', [ProjectReportController::class, 'index'])->name('project.report.index');
        Route::get('project-report/add', [ProjectReportController::class, 'add'])->name('project.report.add');
        Route::post('project-report/store', [ProjectReportController::class, 'store'])->name('project.report.store');
        Route::get('project-report/edit/{id}', [ProjectReportController::class, 'edit'])->name('project.report.edit');
        Route::put('project-report/update/{id}', [ProjectReportController::class, 'update'])->name('project.report.update');
        Route::delete('project-report/destroy/{id}', [ProjectReportController::class, 'destroy'])->name('project.report.destroy');
       

        /* File download */
        Route::get('file-download', [DownloadFileController::class, 'index'])->name('file_download.index');
        Route::get('file-download/{id}', [LibraryController::class, 'downloadFile'])->name('download.file');
        Route::delete('file-download/destroy/{id}', [DownloadFileController::class, 'destroy'])->name('file_download.destroy');
    });

    Route::middleware(['admin_project'])->group(function () {
        /* Project */
        Route::get('project', [ProjectController::class, 'index'])->name('project.index');
        Route::get('project/add', [ProjectController::class, 'add'])->name('project.add');
        Route::post('project/store', [ProjectController::class, 'store'])->name('project.store');
        Route::get('project/edit/{id}', [ProjectController::class, 'edit'])->name('project.edit');
        Route::put('project/update/{id}', [ProjectController::class, 'update'])->name('project.update');
        Route::delete('project/destroy/{id}', [ProjectController::class, 'destroy'])->name('project.destroy');
        Route::get('project/add-employee', [ProjectController::class, 'loadEmployee'])->name('load.employee');

        /* Library */
        Route::get('library', [LibraryController::class, 'index'])->name('library.index');
        Route::put('library-status/{id}' ,[LibraryController::class, 'library_status']);
        Route::post('file_download/store', [LibraryController::class, 'store_file_download']);
        Route::delete('library/destroy/{id}' ,[LibraryController::class, 'destroy'])->name('library.destroy');
        Route::get('library/edit/{id}' ,[LibraryController::class, 'edit'])->name('library.edit');
        Route::put('library/update/{id}', [LibraryController::class, 'update'])->name('library.update');
        Route::get('library/download/{id}', [LibraryController::class, 'downloadFile'])->name('download.file');

        /* Employee */
        Route::get('employee', [EmployeeController::class, 'index'])->name('employee.index');
        Route::get('employee/add', [EmployeeController::class, 'add'])->name('employee.add');
        Route::post('employee/store', [EmployeeController::class, 'store'])->name('employee.store');
        Route::get('employee/edit/{id}', [EmployeeController::class, 'edit'])->name('employee.edit');
        Route::put('employee/update/{id}', [EmployeeController::class, 'update'])->name('employee.update');
        Route::delete('employee/destroy/{id}', [EmployeeController::class, 'destroy'])->name('employee.destroy');
    });

    Route::middleware(['supper_admin'])->group(function () {
        /* Account */
        Route::get('account', [AccountController::class, 'index'])->name('account.index');
        Route::get('account/detail/{id}', [AccountController::class, 'detail'])->name('account.detail');
        Route::put('account/update/{id}', [AccountController::class, 'update'])->name('account.update');
        Route::get('account/add', [AccountController::class, 'add'])->name('account.add');
        Route::post('account/store', [AccountController::class, 'store'])->name('account.store');
        Route::delete('account/destroy/{id}', [AccountController::class, 'destroy'])->name('account.destroy');
    });

    /* Profile */
    Route::get('profile', [ProfileController::class, 'index'])->name('profile.index');
    Route::put('update-profile/{id}', [ProfileController::class, 'updateProfile'])->name('update.profile');
    Route::get('change-password', [ProfileController::class, 'change_password'])->name('change.password');
    Route::put('updatePassword', [ProfileController::class, 'updatePassword'])->name('update.password');
});

Route::middleware(['guest'])->group(function () {
    Route::get('sign-in', [AuthController::class, 'sign_in'])->name('sign-in');
    Route::post('sign-in', [AuthController::class, 'sign_in_action'])->name('sign-in.action');

    Route::get('sign-up', [AuthController::class, 'sign_up'])->name('sign-up');
    Route::post('sign-up/store', [AuthController::class, 'sign_up_action'])->name('sign-up.action');

    Route::get('forgotpassword', [AuthController::class, 'forgot_password'])->name('forgot.password');
    Route::post('postforgotpassword', [AuthController::class, 'send_gmail'])->name('post.forgot.password');
    Route::get('get-password/{user}', [AuthController::class, 'get_password'])->name('get.password');
    Route::post('get-password/{user}', [AuthController::class, 'post_get_password'])->name('get.password');
});


/* Ckfinder */
Route::any('/ckfinder/connector', '\CKSource\CKFinderBridge\Controller\CKFinderController@requestAction')
    ->name('ckfinder_connector');

Route::any('/ckfinder/browser', '\CKSource\CKFinderBridge\Controller\CKFinderController@browserAction')
    ->name('ckfinder_browser');
