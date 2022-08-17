<?php

use App\Http\Controllers\Admin\AdminController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;


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

Route::group(['middleware' => 'prevent-back-history'], function () {

    Auth::routes();

    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])
        ->middleware('auth')
        ->name('home');

    Route::post('/change-password', [UserController::class, 'changePassword'])
        ->middleware('auth')
        ->name('change-password');

    Route::post('/edit-profile', [UserController::class, 'editProfile'])
        ->middleware('auth')
        ->name('edit-profile');

    Route::post('/delete-profile', [UserController::class, 'deleteProfile'])
        ->middleware('auth')
        ->name('delete-profile');


    Route::group([
        'prefix' => 'admin', 'as' => 'admin.', 'middleware' => [
            'auth', 'role:admin'
        ]
    ], function () {

        /*
         * Show user datatable route
         */
        Route::get('', [UserController::class, 'showUsersDatatable'])
            ->name('list');

        /*
         * Get roles route
         */
        Route::get('/roles', [UserController::class, 'getRoles'])
            ->name('roles');
        /*
         * Register - Edit - Delete Routes
         */
        Route::post('/register', [AdminController::class, 'create'])
            ->name('register');

        Route::post('/edit', [AdminController::class, 'edit'])
            ->name('edit');

        Route::post('/delete', [AdminController::class, 'delete'])
            ->name('delete');
    });
});

