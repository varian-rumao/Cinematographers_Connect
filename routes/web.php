<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PageController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\ContactMessageController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\GalleryController;
use App\Http\Controllers\UserProfileController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ArticleController;
use Illuminate\Support\Facades\Auth;

// Redirect the root URL to /home
Route::get('/', function () {
    return redirect('/home');
});

// Authenticated home route with verified middleware
Route::get('/home', [HomeController::class, 'index'])->middleware(['auth', 'verified'])->name('home');

// User profile routes with auth middleware
Route::middleware(['auth'])->group(function () {
    Route::put('/user/profile', [UserProfileController::class, 'update'])->name('user.profile.update');
    Route::get('/profile/{id}/edit', [UserProfileController::class, 'edit'])->name('profile.edit');
    Route::put('/profile/{id}', [UserProfileController::class, 'update'])->name('profile.update');
    Route::get('/user/profile', [UserProfileController::class, 'show'])->name('user.profile.show');
});

// About page
Route::get('/about', function () {
    return view('about');
})->name('about');

// Contact page and message saving
Route::get('/contact', function () {
    return view('contact');
})->name('contact');
Route::post('/save-message', [ContactMessageController::class, 'store'])->name('save.message');

// Blog routes with verified middleware
Route::middleware(['verified'])->group(function () {
    Route::get('/blogs', [BlogController::class, 'index'])->name('blogs.index');
    Route::get('/blogs/create', [BlogController::class, 'create'])->name('blogs.create');
    Route::post('/blogs', [BlogController::class, 'store'])->name('blogs.store');
    Route::get('/blogs/{id}', [BlogController::class, 'show'])->name('blogs.show');
});

// Authentication routes
Auth::routes(['verify' => true]);
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

// Registration routes
Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [RegisterController::class, 'register']);

// Gallery route
Route::get('/gallery', [GalleryController::class, 'index'])->name('gallery.index');

// Works page route
Route::get('/works/{id}', [UserProfileController::class, 'showWorks'])->name('works.show');

Route::get('/articles', [ArticleController::class, 'index'])->name('articles.index');
Route::get('/articles/create', [ArticleController::class, 'create'])->middleware('auth')->name('articles.create');
Route::post('/articles', [ArticleController::class, 'store'])->middleware('auth')->name('articles.store');
Route::get('/articles/{id}', [ArticleController::class, 'show'])->name('articles.show');


// Admin routes with auth and admin middleware
Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('/admin/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
    Route::get('/admin/users', [AdminController::class, 'manageUsers'])->name('admin.manageUsers');
    Route::delete('/admin/users/{id}', [AdminController::class, 'deleteUser'])->name('admin.deleteUser');
    Route::get('/admin/photos', [AdminController::class, 'managePhotos'])->name('admin.managePhotos');
    Route::delete('/admin/photos/{id}', [AdminController::class, 'deletePhoto'])->name('admin.deletePhoto');
    Route::get('/admin/sessions', [AdminController::class, 'sessionActivity'])->name('admin.sessionActivity');
});

Route::middleware(['auth', 'admin'])->group(function () {
    Route::post('/admin/articles/{id}/approve', [ArticleController::class, 'approve'])->name('admin.articles.approve');
    Route::post('/admin/articles/{id}/reject', [ArticleController::class, 'reject'])->name('admin.articles.reject');
    Route::get('/articles/search', [ArticleController::class, 'search'])->name('articles.search');
});