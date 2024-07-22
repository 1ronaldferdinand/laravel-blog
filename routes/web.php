<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AccountController;
use App\Http\Controllers\PostController;

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

Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login.form');
Route::post('/login', [AuthController::class, 'login'])->name('login');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::get('/post', [PostController::class, 'index'])->name('posts.index');

Route::get('/akun', [AccountController::class, 'index'])->name('accounts.index');
Route::get('/akun/create', [AccountController::class, 'create'])->name('accounts.create');
Route::post('/akun', [AccountController::class, 'store'])->name('accounts.store');
Route::get('/akun/{username}', [AccountController::class, 'show'])->name('accounts.show');
Route::get('/akun/{username}/edit', [AccountController::class, 'edit'])->name('accounts.edit');
Route::put('/akun/{username}', [AccountController::class, 'update'])->name('accounts.update');
Route::delete('/akun/{username}', [AccountController::class, 'destroy'])->name('accounts.destroy');