<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AddController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\MhsController;
use App\Http\Controllers\MessageController;

Route::group(['middleware' => 'auth'], function () {
    Route::group(['middleware' => 'isAdmin'], function () {
        Route::get('/dashboardadmin', [AddController::class, 'dashboardadmin'])->name('dashboardadmin');
        Route::post('/usersubmit', [AddController::class, 'usersubmit'])->name('users.store');
        Route::delete('/destroyuser/{id}', [AddController::class, 'destroyuser'])->name('users.destroy');
        Route::get('/edituser/{id}', [AddController::class, 'edituser'])->name('users.edit');
        Route::put('/updateuser/{id}', [AddController::class, 'updateuser'])->name('users.update');
        Route::get('/addmenu', [MenuController::class, 'addmenu'])->name('users.addMenu');
        Route::post('/users/{id}/addMenu', [AddController::class, 'addmenuuser'])->name('users.addMenus');
        Route::get('/users/{id}/update-role', [AddController::class, 'updatemenurole'])->name('roles.addmenu');
        Route::post('/roles/{id}/savemenu', [AddController::class, 'saveMenu'])->name('roles.savemenu');

        Route::get('/addrole', [RoleController::class, 'index'])->name('admin.addrole');
        Route::post('/roles', [RoleController::class, 'store'])->name('roles.store');
        Route::get('/roles/{id}/edit', [RoleController::class, 'edit'])->name('roles.edit');
        Route::put('/roles/{id}', [RoleController::class, 'update'])->name('roles.update');
        Route::delete('/roles/{id}', [RoleController::class, 'destroy'])->name('roles.destroy');

        Route::get('roles/{id}', [RoleController::class, 'show'])->name('roles.show');

        Route::get('addmenu', [MenuController::class, 'index'])->name('menu.index');
        Route::get('menu/create', [MenuController::class, 'create'])->name('menu.create');
        Route::post('menu', [MenuController::class, 'store'])->name('menu.store');
        Route::get('menu/{id}', [MenuController::class, 'show'])->name('menu.show');
        Route::get('menu/{id}/edit', [MenuController::class, 'edit'])->name('menu.edit');
        Route::put('menu/{id}', [MenuController::class, 'update'])->name('menu.update');
        Route::delete('menu/{id}', [MenuController::class, 'destroy'])->name('menu.destroy');
    });
    Route::group(['middleware' => 'isMhs'], function () {
        Route::get('/dashboard', [AddController::class, 'dashboardadmin']);
        Route::get('/showbook', [MhsController::class, 'showbook']);
    });
    Route::group(['middleware' => 'isDosen'], function () {
        Route::get('/dashboard', [AddController::class, 'dashboardadmin']);
        Route::get('/addbook', [AddController::class, 'addbook']);
        Route::get('/addkategori', [AddController::class, 'addkategori']);
        Route::post('/submitbook', [AddController::class, 'store']);
        Route::post('/submitkategori', [AddController::class, 'storekategori']);
        Route::delete('/books/{id}', [AddController::class, 'destroy'])->name('book.destroy');
        Route::post('/deleteall', [AddController::class, 'destroys'])->name('book.destroys');
        Route::delete('/kategori/{id}', [AddController::class, 'destroykategori'])->name('kategori.destroy');
        Route::delete('/deleteall', [AddController::class, 'deleteall']);
        Route::delete('/dosenedit', [DosenController::class, 'dosenedit'])->name('dosen.edit');
    });
    Route::get('/setting', [AddController::class, 'setting']);
    Route::get('/home', [AddController::class, 'dashboard']);
    Route::get('/dashboard', [AddController::class, 'dashboard']);
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::get('/messages', [MessageController::class, 'message']);
    Route::get('/messages/create', [MessageController::class, 'create'])->name('messages.create');
    // Route::post('/messages', [MessageController::class, 'store'])->name('messages.store');
    Route::get('/messages/{id}', [MessageController::class, 'show'])->name('messages.show');
});

Route::group(['middleware' => 'guest'], function () {
    Route::get('/login', [AuthController::class, 'loginview'])->name('login');
    Route::get('/register', [AuthController::class, 'registerview']);
    Route::post('/postregister', [AuthController::class, 'register']);
    Route::post('/postlogin', [AuthController::class, 'login']);
});

Route::get('/dom1', function () {
    return view('dom');
});
Route::get('/dom2', function () {
    return view('dam');
});
Route::get('/dom3', function () {
    return view('dom');
});
Route::get('/dom4', function () {
    return view('dum');
});
