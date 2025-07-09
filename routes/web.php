<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\LoanController;
use App\Http\Controllers\RatingController;
use App\Http\Controllers\RecommendationController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProfileController;

/*
|--------------------------------------------------------------------------
| Rute Web
|--------------------------------------------------------------------------
*/

Route::get('/', function () {
    return redirect()->route('login');
});

require __DIR__.'/auth.php';

Route::middleware(['auth'])->group(function () {
    
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    
    // Rute publik untuk user biasa melihat daftar buku
    Route::get('/books', [BookController::class, 'index'])->name('books.index');

    Route::get('/api/books/search', [BookController::class, 'search'])->name('books.search');
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    
    Route::get('loans', [LoanController::class, 'index'])->name('loans.index');
    Route::get('loans/create', [LoanController::class, 'create'])->name('loans.create');
    Route::post('loans', [LoanController::class, 'store'])->name('loans.store');
    Route::post('loans/preview', [LoanController::class, 'preview'])->name('loans.preview');
    Route::get('loans/print', [LoanController::class, 'print'])->name('loans.print');
    Route::get('loans/{id}/receipt', [LoanController::class, 'printReceipt'])->name('loans.receipt');
    Route::post('loans/print-preview', [LoanController::class, 'printPreview'])->name('loans.printPreview');

    Route::resource('ratings', RatingController::class)->only(['index', 'store']);
    Route::get('recommendations', [RecommendationController::class, 'index'])->name('recommendations.index');

});


Route::middleware(['auth', 'role:admin'])->prefix('admin')->name('admin.')->group(function () {
    
    
    Route::resource('books', BookController::class)->except(['index', 'show']);
    Route::get('books', [BookController::class, 'index'])->name('books.index'); 

    Route::resource('categories', CategoryController::class);
    Route::resource('users', UserController::class);
});