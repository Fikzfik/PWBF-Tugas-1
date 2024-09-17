<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AddController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\MenuController;

Route::group(['middleware' => 'auth'], function () {
    Route::group(['middleware' => 'isAdmin'], function () {
        Route::get('/dashboardadmin', [AddController::class, 'dashboardadmin'])->name('dashboardadmin');
        Route::post('/usersubmit', [AddController::class, 'usersubmit']);
        Route::put('/users/{id}/update-role', [AddController::class, 'updateRole'])->name('users.updateRole');
        Route::delete('/destroyuser/{id}', [AddController::class, 'destroyuser'])->name('users.destroy');
        Route::get('/edituse/{id}', [AddController::class, 'edituser'])->name('users.edit');
        Route::post('/updateuser/{id}', [AddController::class, 'updateuser'])->name('users.update');
        Route::get('/addmenu', [MenuController::class, 'addmenu'])->name('users.addMenu');
        Route::post('/users/{id}/addMenu', [AddController::class, 'addmenuuser'])->name('users.addMenus');

    });
    Route::group(['middleware' => 'isMhs'], function () {
        Route::get('/dashboard', [AddController::class, 'dashboardadmin']);
    });
    Route::group(['middleware' => 'isDosen'], function () {
        Route::get('/dashboard', [AddController::class, 'dashboardadmin']);
        Route::get('/addbook', [AddController::class, 'addbook']);
        Route::get('/addkategori', [AddController::class, 'addkategori']);
        Route::post('/submitbook', [AddController::class, 'store']);
        Route::post('/submitkategori', [AddController::class, 'storekategori']);
        Route::delete('/book/{id}', [AddController::class, 'destroy'])->name('book.destroy');
        Route::delete('/kategori/{id}', [AddController::class, 'destroykategori'])->name('kategori.destroy');
        Route::delete('/deleteall', [AddController::class, 'deleteall']);
    });
    Route::get('/setting', [AddController::class, 'setting']);
    Route::get('/home', [AddController::class, 'dashboard']);
    Route::get('/dashboard', [AddController::class, 'dashboard']);
    Route::post('/logout', [AuthController::class, 'logout']);
   
});

Route::group(['middleware' => 'guest'], function () {
    Route::get('/login', [AuthController::class, 'loginview'])->name('login'); 
    Route::get('/register', [AuthController::class, 'registerview']);
    Route::post('/postregister', [AuthController::class, 'register']);
    Route::post('/postlogin', [AuthController::class, 'login']);
});








    Route::get('/dom1', function(){
        return view('dom');
    });
    Route::get('/dom2', function(){
        return view('dam');
    });
    Route::get('/dom3', function(){
        return view('dom');
    });
    Route::get('/dom4', function(){
        return view('dum');
    });