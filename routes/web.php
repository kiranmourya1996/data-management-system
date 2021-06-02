<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;


/**

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

Route::get('/', function () {
    return redirect('login');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::group(['middleware' => ['auth', 'role:admin|user|sales']], function () {

    Route::resource('users', App\Http\Controllers\UserManagementController::class, [
        'names' => [
            'index'   => 'users',
            'destroy' => 'user.destroy',
        ],
        'except' => [
            'deleted',
        ],
    ]);
    
    Route::resource('categories', App\Http\Controllers\CategoryManagementController::class, [
        'names' => [
            'index'   => 'categories',
            'destroy' => 'categories.destroy',
        ],
        'except' => [
            'deleted',
        ],
    ]);
    
    Route::get('/logout', ['uses' => 'App\Http\Controllers\Auth\LoginController@logout'])->name('logout');
});

Route::group(['middleware' => ['auth', 'role:admin']], function () {

    Route::resource('roles',  App\Http\Controllers\RoleManagementController::class, [
        'names' => [
            'index'   => 'roles',
            'destroy' => 'roles.destroy',
        ],
        'except' => [
            'deleted',
        ],
    ]);
    Route::resource('products',  App\Http\Controllers\ProductManagementController::class, [
        'names' => [
            'index'   => 'products',
            'destroy' => 'products.destroy',
        ],
        'except' => [
            'deleted',
        ],
    ]);
    Route::get('/exportCsv', [App\Http\Controllers\ExportCSVController::class, 'index'])->name('exportCsv');
     
   

   
});


Route::group(['middleware' => ['auth', 'role:admin|sales']], function () {


     Route::resource('categories', App\Http\Controllers\CategoryManagementController::class, [
        'names' => [
            'index'   => 'categories',
            'destroy' => 'categories.destroy',
        ],
        'except' => [
            'deleted',
        ],
    ]);


    Route::resource('products',  App\Http\Controllers\ProductManagementController::class, [
        'names' => [
            'index'   => 'products',
            'destroy' => 'products.destroy',
        ],
        'except' => [
            'deleted',
        ],
    ]);


   

   
});


