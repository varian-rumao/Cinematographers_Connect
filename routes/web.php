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
use Illuminate\Support\Facades\Auth;

// Home Route
Route::get('/', [HomeController::class, 'index'])->name('home');

// Authenticated home route
Route::get('/home', [HomeController::class, 'index'])->middleware('auth')->name('home');

// User profile routes
Route::put('/user/profile', [UserProfileController::class, 'update'])->name('user.profile.update');
Route::get('/profile/{id}/edit', [UserProfileController::class, 'edit'])->name('profile.edit');
Route::put('/profile/{id}', [UserProfileController::class, 'update'])->name('profile.update');

// About page
Route::get('/about', function () {
    return view('about');
})->name('about');

// Contact page and message saving
Route::get('/contact', function () {
    return view('contact');
})->name('contact');
Route::post('/save-message', [ContactMessageController::class, 'store'])->name('save.message');

// Blog routes with 'verified' middleware to restrict access to verified users
Route::get('/blogs', [BlogController::class, 'index'])->middleware('verified')->name('blogs.index');
Route::get('/blogs/create', [BlogController::class, 'create'])->middleware('verified')->name('blogs.create');
Route::post('/blogs', [BlogController::class, 'store'])->middleware('verified')->name('blogs.store');
Route::get('/blogs/{id}', [BlogController::class, 'show'])->middleware('verified')->name('blogs.show');

// Portfolio page
Route::get('/portfolio', function () {
    return view('portfolio');
});

// Login and Logout routes
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

// Register routes
Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [RegisterController::class, 'register']);

// Gallery routes
Route::get('/gallery', [GalleryController::class, 'index'])->name('gallery.index');

// Works page
Route::get('/works', function () {
    return view('works');
})->name('works');

// Auth routes and email verification
Auth::routes(['verify' => true]);

// Ensure verified users can access home
Route::get('/home', [HomeController::class, 'index'])->middleware('verified')->name('home');

// Group common web middleware routes
Route::middleware(['web'])->group(function () {
    Route::get('/home', [HomeController::class, 'index'])->name('home'); // Move outside any 'auth' middleware
});

//Logout route 
Route::post('/logout', [App\Http\Controllers\Auth\LoginController::class, 'logout'])->name('logout');
