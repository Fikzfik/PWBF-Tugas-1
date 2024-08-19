<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AddController;

Route::get('/home', [AddController::class, 'dashboard']);

Route::get('/dashboard', [AddController::class, 'dashboard']);
Route::get('/addbook', [AddController::class, 'addbook']);
Route::get('/addkategori', [AddController::class, 'addkategori']);
Route::post('/submitbook', [AddController::class, 'store']);
Route::post('/submitkategori', [AddController::class, 'storekategori']);
Route::delete('/book/{id}', [AddController::class, 'destroy'])->name('book.destroy');

