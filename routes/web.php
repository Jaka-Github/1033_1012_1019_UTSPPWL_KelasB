<?php

use App\Http\Controllers\BookController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;

/*
|-------------------------------------------------------------------------
-
| Web Routes
|-------------------------------------------------------------------------
-
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/


Route::get('/', function () {
    return view('welcome');
});
Auth::routes();
Route::middleware('auth')->group(function () {
    Route::get('/home', [
        App\Http\Controllers\HomeController::class,
        'index'
    ])->name('home');
    Route::resources([
        'roles' => RoleController::class,
        'users' => UserController::class,
        'books' => BookController::class,
        // 'permissions' => PermissionController::class,
    ]);
});
