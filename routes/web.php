<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\AuthorController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\SupportController;
use App\Http\Middleware\IsAuthor;
use App\Http\Middleware\IsCustomer;
use Illuminate\Support\Facades\Route;

// Public Paths
Route::get('/', [BookController::class, 'home'])->name('home');
Route::get('/viewBook/{id}', [BookController::class, 'viewBook'])->name('book.view');

// Auth Paths
Route::middleware('guest')->group(function () {
    Route::get('/user/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/user/login', [AuthController::class, 'login']);
    Route::get('/user/register', [AuthController::class, 'showRegister'])->name('register');
    Route::post('/user/register', [AuthController::class, 'register']);
});

// Authenticated Paths
Route::middleware('auth')->group(function () {
    Route::post('/user/logout', [AuthController::class, 'logout'])->name('logout');
    Route::get('/user/profile', [AuthController::class, 'profile'])->name('profile');
    
    // Notifications & Support & Reviews (All Auth Users)
    Route::post('/support/ticket', [SupportController::class, 'submitSupport'])->name('support.submit');
    Route::get('/contactSupport', [SupportController::class, 'showSupport'])->name('support.view');
    Route::get('/notifications', [SupportController::class, 'notifications'])->name('notifications.view');
    Route::post('/addRanking', [BookController::class, 'submitSiteReview'])->name('review.site');
    Route::post('/addComment/{id}', [BookController::class, 'addComment'])->name('review.book');

    // Customer Paths
    Route::middleware(IsCustomer::class)->group(function () {
        Route::get('/viewCart', [CartController::class, 'viewCart'])->name('cart.view');
        Route::post('/cart/add/{id}', [CartController::class, 'addToCart'])->name('cart.add');
        Route::post('/cart/remove/{id}', [CartController::class, 'removeFromCart'])->name('cart.remove');
        Route::get('/checkout', [CartController::class, 'showCheckout'])->name('cart.checkout');
        Route::post('/checkout', [CartController::class, 'processCheckout'])->name('cart.process');
        Route::get('/user/books', [CartController::class, 'myBooks'])->name('user.books');
    });

    // Author Paths
    Route::middleware(IsAuthor::class)->group(function () {
        Route::get('/author/dashboard', [AuthorController::class, 'dashboard'])->name('author.dashboard');
        Route::get('/author/addBook', [AuthorController::class, 'showPublishForm'])->name('author.publish.form');
        Route::post('/author/addBook', [AuthorController::class, 'publishBook'])->name('author.publish');
    });
});
