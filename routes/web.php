<?php

use App\Http\Controllers\Controller;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\StockController;
use App\Http\Controllers\FavoritesController;
use App\Http\Controllers\PurchaseController;
use App\Http\Controllers\TagController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AdminLoginController;
use App\Http\Controllers\AdminRegisterController;
use App\Http\Controllers\ReviewController;


Route::get('/home', [StockController::class, 'index'])->name('stock.index');

Route::get('/detail/{id}', [StockController::class, 'detail'])->name('stock.detail');
Route::post('/addMyCart', [StockController::class, 'addMyCart'])->name('stock.addMyCart');
Route::get('/cart/checkout', [StockController::class, 'checkout'])->name('cart.checkout');
    Route::post('/cart/purchaseComplete', [StockController::class, 'purchaseComplete'])->name('cart.purchaseComplete');
    Route::get('/search', [StockController::class, 'search'])->name('stock.search');
    Route::get('/stocks/search', [StockController::class, 'search'])->name('stocks.search');
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {

    Route::post('/stockAdd', [StockController::class, 'stockAdd'])->name('stockAdd');
    Route::delete('/stock/delete', [StockController::class, 'stockDelete'])->name('stock.delete');
    Route::get('/tags', [TagController::class, 'index'])->name('tags.index');
    Route::post('/tags', [TagController::class, 'store'])->name('tags.store');

    Route::get('/myCart', [StockController::class, 'myCart'])->name('stock.myCart');
    
    Route::put('/cart/update/{id}', [StockController::class, 'updateCart'])->name('cart.update');
    Route::delete('/cart/delete/{id}', [StockController::class, 'deleteCart'])->name('cart.delete');
    


    Route::get('/purchase_history', [PurchaseController::class, 'showPurchaseHistory'])->name('purchase.history');
    Route::post('/purchase', [PurchaseController::class, 'purchaseCart'])->name('cart.purchase');
    Route::post('/favorite/add/{stock_id}', [FavoritesController::class, 'addfavorite'])->name('favorite.add');
    Route::delete('/favorite/remove/{stock_id}', [FavoritesController::class, 'removeFavorite'])->name('favorite.remove');
    Route::get('/favorites', [FavoritesController::class, 'index'])->name('favorites.index');
    // web.php
Route::post('/favorite/toggle/{stock_id}', [FavoritesController::class, 'toggleFavorite'])->name('favorite.toggle');



    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::get('/create', [StockController::class, 'create'])->name('stock.create');
    Route::delete('/stock/{id}', [StockController::class, 'delete'])->name('delete');

    Route::post('/reviews', [ReviewController::class, 'store'])->name('review.store');

});




 



require __DIR__.'/auth.php';
