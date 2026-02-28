<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CatalogController;

/* ADMIN */
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\BookController;
use App\Http\Controllers\Admin\BorrowingController;
use App\Http\Controllers\Admin\SettingController;
use App\Http\Controllers\Admin\CategoriesController;
use App\Http\Controllers\Admin\UserManagementController;
use App\Http\Controllers\Admin\UlasanController;

/* AUTH */
use App\Http\Controllers\Auth\AuthenticatedSessionController;

/* SISWA */
use App\Http\Controllers\Siswa\DashboardController as SiswaDashboardController;
use App\Http\Controllers\Siswa\PeminjamanController;
use App\Http\Controllers\Siswa\ProfileController;
use App\Http\Controllers\Siswa\ReviewController;

/* PETUGAS */
use App\Http\Controllers\Petugas\DashboardController as PetugasDashboard;
use App\Http\Controllers\Petugas\BookController as PetugasBook;
use App\Http\Controllers\Petugas\CategoriesController as PetugasCategories;
use App\Http\Controllers\Petugas\UlasanController as PetugasUlasan;
use App\Http\Controllers\Petugas\BorrowingController as PetugasBorrowing;

/*
|--------------------------------------------------------------------------
| AUTH
|--------------------------------------------------------------------------
*/
Route::get('/', [CatalogController::class, 'landing'])->name('landing'); // ✅ diubah
Route::get('/login', [AuthenticatedSessionController::class, 'create'])->name('login');
Route::get('/register', [App\Http\Controllers\Auth\RegisterController::class, 'create'])->name('register');
Route::post('/register', [App\Http\Controllers\Auth\RegisterController::class, 'store']);
Route::post('/login', [AuthenticatedSessionController::class, 'store']);
Route::post('/logout', [AuthenticatedSessionController::class, 'destroy'])->name('logout');

/*
|--------------------------------------------------------------------------
| CATALOG GLOBAL
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'role:admin,petugas,siswa'])->group(function () {
    Route::get('/catalog', [CatalogController::class, 'index'])->name('catalog.index');
    Route::get('/catalog/{book}', [CatalogController::class, 'show'])->name('catalog.show');
});

/*
|--------------------------------------------------------------------------
| ADMIN
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'role:admin'])
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {
        Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
        Route::get('/books/validasi', [BookController::class, 'validasi'])->name('books.validasi');
        Route::put('/books/{id}/approve', [BookController::class, 'approve'])->name('books.approve');
        Route::put('/books/{id}/reject', [BookController::class, 'reject'])->name('books.reject');
        Route::resource('/books', BookController::class);
        Route::resource('/categories', CategoriesController::class);
        Route::get('/borrowings', [BorrowingController::class, 'index'])->name('borrowings.index');
        Route::get('/borrowings/pdf', [BorrowingController::class, 'exportPdf'])->name('borrowings.pdf');
        Route::delete('/borrowings/{id}', [BorrowingController::class, 'destroy'])->name('borrowings.destroy');
        Route::put('/borrowings/{id}/approve', [BorrowingController::class, 'approve'])->name('borrowings.approve');
        Route::put('/borrowings/{id}/reject', [BorrowingController::class, 'reject'])->name('borrowings.reject');
        Route::get('/review', [UlasanController::class, 'index'])->name('review.index');
        Route::get('/users', [UserManagementController::class, 'index'])->name('users.index');
        Route::post('/users', [UserManagementController::class, 'store'])->name('users.store');
        Route::delete('/users/{id}', [UserManagementController::class, 'destroy'])->name('users.destroy');
        Route::get('/settings', [SettingController::class, 'index'])->name('settings');
        Route::put('/settings', [SettingController::class, 'update'])->name('settings.update');
    });

/*
|--------------------------------------------------------------------------
| SISWA
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'role:siswa'])
    ->prefix('siswa')
    ->group(function () {
        Route::get('/dashboard', [SiswaDashboardController::class, 'index'])->name('siswa.dashboard');
        Route::get('/borrow', [PeminjamanController::class, 'index'])->name('siswa.borrow');
        Route::post('/borrow/{buku}', [PeminjamanController::class, 'store'])->name('siswa.borrow.store');
        Route::put('/return/{id}', [PeminjamanController::class, 'return'])->name('siswa.return');
        Route::get('/history', [PeminjamanController::class, 'history'])->name('siswa.history');
        Route::get('/detail/{id}', [PeminjamanController::class, 'detail'])->name('siswa.detail');
        Route::post('/review/{buku}', [PeminjamanController::class, 'review'])->name('siswa.review.store');
        Route::get('/reviews', [ReviewController::class, 'index'])->name('siswa.ulasans');
        Route::delete('/review/{id}', [ReviewController::class, 'destroy'])->name('siswa.review.destroy');
        Route::get('/profile', [ProfileController::class, 'index'])->name('siswa.profile');
        Route::post('/profile/update', [ProfileController::class, 'update'])->name('siswa.profile.update');
        Route::post('/password/update', [ProfileController::class, 'updatePassword'])->name('siswa.password.update');
        Route::get('/validasi', [PeminjamanController::class, 'validasi'])->name('siswa.validasi');
    });

/*
|--------------------------------------------------------------------------
| PETUGAS
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'role:petugas'])
    ->prefix('petugas')
    ->name('petugas.')
    ->group(function () {
        Route::get('/dashboard', [PetugasDashboard::class, 'index'])->name('dashboard');
        Route::get('/books/validasi', [PetugasBook::class, 'validasi'])->name('books.validasi');
        Route::resource('/books', PetugasBook::class);
        Route::resource('/categories', PetugasCategories::class);
        Route::get('/review', [PetugasUlasan::class, 'index'])->name('review.index');
        Route::get('/borrowings', [PetugasBorrowing::class, 'index'])->name('borrowings.index');
        Route::get('/borrowings/pdf', [PetugasBorrowing::class, 'exportPdf'])->name('borrowings.pdf');
        Route::get('/borrowings/validasi', [PetugasBorrowing::class, 'validasi'])->name('petugas.borrowings.validasi');
        Route::put('/borrowings/{id}/approve', [PetugasBorrowing::class, 'approve'])->name('borrowings.approve');
        Route::put('/borrowings/{id}/reject', [PetugasBorrowing::class, 'reject'])->name('borrowings.reject');
        Route::put('/borrowings/{id}/return', [PetugasBorrowing::class, 'return'])->name('return');
    });