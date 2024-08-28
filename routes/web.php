<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AddController;
use App\Http\Controllers\AuthController;

Route::group(['middleware' => 'auth'], function () {
    Route::get('/home', [AddController::class, 'dashboard']);
    Route::get('/dashboard', [AddController::class, 'dashboard']);
    Route::get('/addbook', [AddController::class, 'addbook']);
    Route::get('/addkategori', [AddController::class, 'addkategori']);
    Route::post('/submitbook', [AddController::class, 'store']);
    Route::post('/submitkategori', [AddController::class, 'storekategori']);
    Route::delete('/book/{id}', [AddController::class, 'destroy'])->name('book.destroy');
    Route::delete('/kategori/{id}', [AddController::class, 'destroykategori'])->name('kategori.destroy');
    Route::delete('/deleteall', [AddController::class, 'deleteall']);
    Route::post('/logout', [AuthController::class, 'logout']);
});

Route::group(['middleware' => 'guest'], function () {
    Route::get('/login', [AuthController::class, 'loginview'])->name('login'); 
    Route::get('/register', [AuthController::class, 'registerview']);
    Route::post('/postregister', [AuthController::class, 'register']);
    Route::post('/postlogin', [AuthController::class, 'login']);
});
