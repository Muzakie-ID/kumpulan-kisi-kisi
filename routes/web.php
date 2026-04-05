<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\MapelController;
use App\Http\Controllers\SearchController;

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

Route::get('/', [HomeController::class, 'index'])->name('home.index');
Route::get('/cari', [SearchController::class, 'index'])->name('search.index');
Route::get('/upload', [AdminController::class, 'index'])->name('admin.upload');
Route::post('/upload', [AdminController::class, 'store'])->name('admin.store');
Route::post('/admin/mapel', [AdminController::class, 'storeMapel'])->name('admin.storeMapel');
Route::delete('/admin/mapel/{id}', [AdminController::class, 'destroyMapel'])->name('admin.destroyMapel');
Route::delete('/admin/dokumen/{id}', [AdminController::class, 'destroyDokumen'])->name('admin.destroyDokumen');

Route::get('/mapel', [MapelController::class, 'index'])->name('mapel.index');
Route::get('/mapel/{slug}', [MapelController::class, 'show'])->name('mapel.show');
