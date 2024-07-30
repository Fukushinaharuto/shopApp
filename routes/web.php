<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\StockController;

Route::get('/', [StockController::class, 'index'])->name('stock.index');


Route::get('/dashbord', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/create', [StockController::class, 'create'])->name('stock.create');
    Route::post('/stockAdd', [StockController::class, 'stockAdd'])->name('stockAdd');
    Route::get('/myCart', [StockController::class, 'myCart'])->name('stock.myCart');
    Route::post('/addMyCart', [StockController::class, 'addMyCart'])->name('stock.addMyCart');
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
