<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\CarController;
use App\Http\Controllers\ComputerController;


Route::redirect('/', '/items');

Route::resource('items', ItemController::class);

Route::prefix('items')->group(function () {
    Route::resource('cars', CarController::class)->only(['create', 'store']);
    Route::resource('computers', ComputerController::class)->only(['create', 'store']);
});

// ^^ Items ^^ vv Other stuff vv

Route::get('/profile', function () {
    return view('profile');
});
Route::get('/create', function () {
    return view('items.create');
});