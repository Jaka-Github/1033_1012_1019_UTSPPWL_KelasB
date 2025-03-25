<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\BorrowController; // ✅ Import BorrowController

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

Auth::routes();

Route::middleware('auth')->group(function () {
    Route::get('/home', [HomeController::class, 'index'])->name('home');

    Route::resources([
        'roles' => RoleController::class,
        'users' => UserController::class,
        'books' => BookController::class,
        'borrow' => BorrowController::class,
    ]);

    // ✅ Add Borrow Routes
    Route::get('/borrow', [BorrowController::class, 'index'])->name('borrow.index');
    Route::get('/borrow/create', [BorrowController::class, 'create'])->name('borrow.create');
    Route::post('/borrow', [BorrowController::class, 'store'])->name('borrow.store');
    Route::post('/borrow/return/{id}', [BorrowController::class, 'returnBook'])->name('borrow.return');
});
