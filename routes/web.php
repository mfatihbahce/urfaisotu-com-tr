<?php

use App\Http\Controllers\AccountController;
use App\Http\Controllers\AddressController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\FavoriteController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\Admin\CategoryController as AdminCategoryController;
use App\Http\Controllers\Admin\ContactMessageController;
use App\Http\Controllers\Admin\CouponController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\Admin\ProductController as AdminProductController;
use App\Http\Controllers\Admin\ProfileController as AdminProfileController;
use App\Http\Controllers\Admin\SettingController;
use App\Http\Controllers\Admin\UserController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// Frontend
Route::get('/', [HomeController::class, 'index'])->name('home');

Route::get('/urunler', [ProductController::class, 'index'])->name('products.index');
Route::get('/urun/{slug}', [ProductController::class, 'show'])->name('products.show');

Route::get('/kategori/{slug}', [CategoryController::class, 'show'])->name('categories.show');

Route::get('/sepet', [CartController::class, 'index'])->name('cart.index');
Route::post('/sepet/ekle', [CartController::class, 'add'])->name('cart.add');
Route::put('/sepet/guncelle', [CartController::class, 'update'])->name('cart.update');
Route::delete('/sepet/kaldir', [CartController::class, 'remove'])->name('cart.remove');

Route::post('/favoriler/ekle', [FavoriteController::class, 'add'])->name('favorites.add')->middleware('auth');
Route::delete('/favoriler/kaldir', [FavoriteController::class, 'remove'])->name('favorites.remove')->middleware('auth');

Route::middleware('auth')->group(function () {
    Route::get('/dashboard', fn () => redirect()->route('account.index'))->name('dashboard');

    Route::get('/odeme', [CheckoutController::class, 'index'])->name('checkout.index');
    Route::post('/odeme', [CheckoutController::class, 'store'])->name('checkout.store');

    Route::prefix('hesabim')->name('account.')->group(function () {
        Route::resource('adresler', AddressController::class)->parameters(['adresler' => 'address'])->names([
            'index' => 'addresses.index',
            'create' => 'addresses.create',
            'store' => 'addresses.store',
            'edit' => 'addresses.edit',
            'update' => 'addresses.update',
            'destroy' => 'addresses.destroy',
        ])->except(['show']);
        Route::get('/', [AccountController::class, 'index'])->name('index');
        Route::get('/siparisler', [AccountController::class, 'ordersIndex'])->name('orders.index');
        Route::get('/siparisler/{order}', [AccountController::class, 'orderShow'])->name('orders.show');
        Route::get('/favoriler', [AccountController::class, 'favoritesIndex'])->name('favorites.index');
        Route::get('/profil', [AccountController::class, 'profile'])->name('profile');
        Route::patch('/profil', [AccountController::class, 'profileUpdate'])->name('profile.update');
        Route::get('/sifre', [AccountController::class, 'password'])->name('password');
        Route::put('/sifre', [AccountController::class, 'passwordUpdate'])->name('password.update');
    });
});

Route::get('/iletisim', [ContactController::class, 'index'])->name('contact.index');
Route::post('/iletisim', [ContactController::class, 'store'])->name('contact.store');

// Auth routes (profile)
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Admin
Route::prefix('admin')->middleware(['auth', 'is_admin'])->name('admin.')->group(function () {
    Route::get('/', [DashboardController::class, 'index'])->name('index');

    Route::resource('products', AdminProductController::class);
    Route::resource('categories', AdminCategoryController::class);
    Route::resource('coupons', CouponController::class);

    Route::get('orders', [OrderController::class, 'index'])->name('orders.index');
    Route::get('orders/{order}', [OrderController::class, 'show'])->name('orders.show');
    Route::patch('orders/{order}/status', [OrderController::class, 'updateStatus'])->name('orders.updateStatus');

    Route::get('users', [UserController::class, 'index'])->name('users.index');

    Route::get('contact-messages', [ContactMessageController::class, 'index'])->name('contact-messages.index');
    Route::get('contact-messages/{contactMessage}', [ContactMessageController::class, 'show'])->name('contact-messages.show');
    Route::delete('contact-messages/{contactMessage}', [ContactMessageController::class, 'destroy'])->name('contact-messages.destroy');

    Route::get('settings', [SettingController::class, 'index'])->name('settings.index');
    Route::put('settings', [SettingController::class, 'update'])->name('settings.update');

    Route::get('profile', [AdminProfileController::class, 'edit'])->name('profile.edit');
    Route::put('profile', [AdminProfileController::class, 'update'])->name('profile.update');
    Route::post('profile/password', [AdminProfileController::class, 'password'])->name('profile.password');
});

require __DIR__ . '/auth.php';
