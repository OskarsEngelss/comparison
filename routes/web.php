<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\CarController;
use App\Http\Controllers\ComputerController;
use App\Http\Controllers\ProfileController;
use App\Middleware\RedirectIfNotAuthenticated;

Route::redirect('/', '/items');

Route::resource('items', ItemController::class);
Route::post('/apply-filters', [ItemController::class, 'index'])->name('apply.filters');

Route::prefix('items')->group(function () {
    Route::resource('cars', CarController::class)->only(['create', 'store']);
    Route::resource('computers', ComputerController::class)->only(['create', 'store']);
});


// ^^ Items ^^ vv Auth vv

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');


Route::middleware('auth')->group(function () {
    //Every route inside of here will only work if user is logged in!
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/create', function () {
        return view('items.create');
    });
    Route::prefix('items')->group(function () {
        Route::resource('cars', CarController::class)->only(['create', 'store']);
        Route::resource('computers', ComputerController::class)->only(['create', 'store']);
    });
});

require __DIR__.'/auth.php';
