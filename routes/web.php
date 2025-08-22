<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\HomeController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\Admin\PageController as AdminPageController;
use App\Http\Controllers\Admin\SubcategoryController;
use App\Http\Controllers\Admin\BannerController;
use App\Http\Controllers\Admin\ProductController as AdminProductController;
use App\Http\Controllers\Admin\CategoryController as AdminCategoryController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController as PublicProductController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\WishlistController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Admin\OrderController;
/*
|--------------------------------------------------------------------------
| Public
|--------------------------------------------------------------------------
*/
Route::get('/', [HomeController::class, 'home'])->name('home');
Route::get('/page/{slug}', [HomeController::class, 'page'])->name('page.show');

Route::get('/products', [HomeController::class, 'products'])->name('products');
Route::get('/products/{id}', [PublicProductController::class, 'productDetail'])->name('product.detail');

Route::get('/categories', [HomeController::class, 'categories'])->name('categories');
Route::get('/categories/{id}', [CategoryController::class, 'categoryDetail'])->name('category.detail');

Route::get('/offers', [HomeController::class, 'offers'])->name('offers');
Route::get('/about', [HomeController::class, 'about'])->name('about');
Route::get('/contact', [HomeController::class, 'contact'])->name('contact');
Route::post('/contact', [HomeController::class, 'sendContact'])->name('contact.send');

/*
|--------------------------------------------------------------------------
| Cart / Wishlist / Checkout
|--------------------------------------------------------------------------
*/
Route::post('/cart/add', [CartController::class, 'add'])->name('cart.add');
Route::post('/cart/remove', [CartController::class, 'remove'])->name('cart.remove');
Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
Route::post('/cart/update', [CartController::class, 'update'])->name('cart.update');

Route::post('/wishlist/add', [WishlistController::class, 'add'])->name('wishlist.add');
Route::post('/wishlist/remove', [WishlistController::class, 'remove'])->name('wishlist.remove');
Route::get('/wishlist', [WishlistController::class, 'index'])->name('wishlist.index');

Route::post('/buy-now', [CheckoutController::class, 'buyNow'])->name('buy.now');
Route::get('/checkout', [CheckoutController::class, 'index'])->name('checkout.index');
Route::post('/checkout', [CheckoutController::class, 'store'])->name('checkout.store');

Route::post('/checkout/buy-now', [CheckoutController::class, 'buyNow'])->name('checkout.buyNow');


Route::get('/profile', fn () => view('user.profile'))->middleware('auth');
Route::get('/profile', [ProfileController::class, 'index'])
    ->name('profile')
    ->middleware('auth');
/*
|--------------------------------------------------------------------------
| Auth
|--------------------------------------------------------------------------
*/
Route::get('/login', [AuthController::class, 'showLogin'])->name('login')->middleware('guest');
Route::post('/login', [AuthController::class, 'login'])->name('login.post')->middleware('guest');
Route::get('/register', [AuthController::class, 'showRegister'])->name('register')->middleware('guest');
Route::post('/register', [AuthController::class, 'register'])->name('register.post')->middleware('guest');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout')->middleware('auth');

/*
|--------------------------------------------------------------------------
| Dashboard
|--------------------------------------------------------------------------
*/
Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard')->middleware('auth');

/*
|--------------------------------------------------------------------------
| Admin
|--------------------------------------------------------------------------
*/
Route::middleware(['auth','role:admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', fn () => view('admin.dashboard'))->name('dashboard');
    Route::resource('pages', AdminPageController::class);
    Route::resource('products', AdminProductController::class);
    Route::resource('subcategories', SubcategoryController::class);
    Route::resource('categories', AdminCategoryController::class);
    Route::resource('banners', BannerController::class);
     Route::resource('orders', OrderController::class)->only(['index', 'show', 'update']);
});
