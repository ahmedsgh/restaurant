<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('lang/{locale}', function ($locale) {
    if (in_array($locale, ['en', 'fr', 'ar', 'es'])) {
        session(['locale' => $locale]);
    }
    return redirect()->back();
})->name('lang.switch');

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    Route::get('/admin/categories', App\Livewire\Admin\Categories\Index::class)->name('admin.categories.index');
    Route::get('/admin/products', App\Livewire\Admin\Products\Index::class)->name('admin.products.index');
    Route::get('/admin/orders', App\Livewire\Admin\Orders\Index::class)->name('admin.orders.index');
    Route::get('/admin/reservations', App\Livewire\Admin\Reservations\Index::class)->name('admin.reservations.index');
});

Route::get('/', App\Livewire\Home::class)->name('home');
Route::get('/menu', App\Livewire\Menu::class)->name('menu');
Route::get('/cart', App\Livewire\Cart::class)->name('cart');
Route::get('/checkout', App\Livewire\Checkout::class)->name('checkout');
Route::get('/track-order', App\Livewire\OrderTracking::class)->name('order.track');

Route::view('profile', 'profile')
    ->middleware(['auth'])
    ->name('profile');

require __DIR__ . '/auth.php';
