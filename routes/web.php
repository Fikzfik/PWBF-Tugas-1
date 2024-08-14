<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AddController;

Route::get('/', function () {
    return view('index');
});
Route::get('/addbook', [AddController::class, 'addbook']);
Route::post('/submitbook', [AddController::class, 'store']);
Route::delete('/book/{id}', [AddController::class, 'destroy'])->name('book.destroy');

Route::get('/addkategori', function () {
    return view('add.kategori');
});
