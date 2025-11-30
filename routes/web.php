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
    Route::get('/dashboard', App\Livewire\Admin\Dashboard::class)
        ->middleware('permission:view_dashboard')
        ->name('dashboard');

    Route::get('/admin/categories', App\Livewire\Admin\Categories\Index::class)
        ->middleware('permission:view_categories')
        ->name('admin.categories.index');
    
    Route::get('/admin/products', App\Livewire\Admin\Products\Index::class)
        ->middleware('permission:view_products')
        ->name('admin.products.index');
    
    Route::get('/admin/orders', App\Livewire\Admin\Orders\Index::class)
        ->middleware('permission:view_orders')
        ->name('admin.orders.index');
    
    Route::get('/admin/reservations', App\Livewire\Admin\Reservations\Index::class)
        ->middleware('permission:view_reservations')
        ->name('admin.reservations.index');
    
    Route::get('/admin/users', App\Livewire\Admin\Users\Index::class)
        ->middleware('permission:view_users')
        ->name('admin.users.index');
    
    Route::get('/admin/roles', App\Livewire\Admin\Roles::class)
        ->middleware('permission:view_roles')
        ->name('admin.roles.index');
});

Route::get('/', App\Livewire\Home::class)->name('home');
Route::get('/menu', App\Livewire\Menu::class)->name('menu');
Route::get('/cart', App\Livewire\Cart::class)->name('cart');
Route::get('/checkout', App\Livewire\Checkout::class)->name('checkout');
Route::get('/track-order', App\Livewire\OrderTracking::class)->name('order.track');

Route::get('profile', App\Livewire\Admin\Profile::class)
    ->middleware(['auth'])
    ->name('profile');

require __DIR__ . '/auth.php';
