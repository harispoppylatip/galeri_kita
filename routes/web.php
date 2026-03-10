<?php

use App\Http\Controllers\galerykitacontroller;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminUserController;
use App\Http\Controllers\AlbumController;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

route::get('/', [galerykitacontroller::class,'index'])->name('home');

Route::get('/galeri', [galerykitacontroller::class, 'galeri'])->name('galeri');

// Public Album
Route::get('/album', [AlbumController::class, 'publicIndex'])->name('album');
Route::get('/album/{id}', [AlbumController::class, 'publicShow'])->name('album.show');

// Auth Routes
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Admin Routes (protected)
Route::middleware('auth')->prefix('admin')->group(function () {

    Route::get('/upload', function () {
        return view('admin.upload');
    })->name('admin.upload');

    Route::post('/upload', [galerykitacontroller::class, 'store'])->name('admin.upload.store');

    Route::get('/bulk-upload', function () {
        return view('admin.bulk-upload');
    })->name('admin.bulk-upload');

    Route::post('/bulk-upload', [galerykitacontroller::class, 'bulkStore'])->name('admin.bulk-upload.store');
    Route::get('/config', [galerykitacontroller::class, 'config'])->name('admin.config');
    Route::put('/config/{id}', [galerykitacontroller::class, 'update'])->name('admin.config.update');
    Route::delete('/config/{id}', [galerykitacontroller::class, 'destroy'])->name('admin.config.destroy');

    // Admin User Management
    Route::get('/users', [AdminUserController::class, 'index'])->name('admin.users.index');
    Route::get('/users/create', [AdminUserController::class, 'create'])->name('admin.users.create');
    Route::post('/users', [AdminUserController::class, 'store'])->name('admin.users.store');
    Route::get('/users/{id}/edit', [AdminUserController::class, 'edit'])->name('admin.users.edit');
    Route::put('/users/{id}', [AdminUserController::class, 'update'])->name('admin.users.update');
    Route::delete('/users/{id}', [AdminUserController::class, 'destroy'])->name('admin.users.destroy');

    // Admin Album Management
    Route::get('/albums', [AlbumController::class, 'index'])->name('admin.albums.index');
    Route::get('/albums/create', [AlbumController::class, 'create'])->name('admin.albums.create');
    Route::post('/albums', [AlbumController::class, 'store'])->name('admin.albums.store');
    Route::get('/albums/{id}', [AlbumController::class, 'show'])->name('admin.albums.show');
    Route::get('/albums/{id}/edit', [AlbumController::class, 'edit'])->name('admin.albums.edit');
    Route::put('/albums/{id}', [AlbumController::class, 'update'])->name('admin.albums.update');
    Route::delete('/albums/{id}', [AlbumController::class, 'destroy'])->name('admin.albums.destroy');
    Route::post('/albums/{id}/photos', [AlbumController::class, 'addPhotos'])->name('admin.albums.addPhotos');
    Route::delete('/albums/{albumId}/photos/{photoId}', [AlbumController::class, 'removePhoto'])->name('admin.albums.removePhoto');
});

