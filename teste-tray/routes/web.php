<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\VendaController;

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

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/login/{message?}', [HomeController::class, 'enter'])->name('home.enter');
Route::post('/auth', [UserController::class, 'auth'])->name('user.auth');
Route::get('/create', [UserController::class, 'create'])->name('home.create');
Route::post('/store', [UserController::class, 'store'])->name('user.store');

Route::group(['middleware'=>'auth'],function() {
    Route::get('/dashboard/{message?}', [VendaController::class, 'index'])->name('dashboard');

    Route::get('/edit/{id}', [UserController::class, 'edit'])->name('user.edit');
    Route::put('/update/{id}', [UserController::class, 'update'])->name('user.update');
    Route::get('/delete/{id}', [UserController::class, 'destroy'])->name('user.destroy');
    
    Route::post('/store-venda', [VendaController::class, 'store'])->name('venda.store');

    Route::get('/logout', [UserController::class, 'logout'])->name('user.logout');
});
