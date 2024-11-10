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
Route::get('/home', [HomeController::class, 'index'])->name('home');

// About page
Route::get('/about', function () {
    return view('about');
})->name('about');

// Contact page and message saving
Route::get('/contact', function () {
    return view('contact');
})->name('contact');
Route::post('/save-message', [ContactMessageController::class, 'store'])->name('save.message');

// Gallery route
Route::get('/gallery', [GalleryController::class, 'index'])->name('gallery.index');

// User profile routes with auth middleware
Route::middleware(['auth'])->group(function () {
    Route::get('/profile/{id}/edit', [UserProfileController::class, 'edit'])->name('profile.edit');
    Route::put('/profile/{id}', [UserProfileController::class, 'update'])->name('profile.update');

    // Admin routes
    Route::prefix('admin')->group(function () {
        Route::get('/admin/users', [AdminController::class, 'manageUsers'])->name('admin.manageUsers');
        Route::put('/admin/users/{id}/deactivate', [AdminController::class, 'deactivateUser'])->name('admin.deactivateUser');
        
        Route::get('/admin/photos', [AdminController::class, 'managePhotos'])->name('admin.managePhotos');
        Route::delete('/admin/photos/{id}', [AdminController::class, 'deletePhoto'])->name('admin.deletePhoto');
                
        Route::get('/articles', [AdminController::class, 'manageArticles'])->name('admin.manageArticles');
        Route::post('/articles/{id}/approve', [AdminController::class, 'approveArticle'])->name('admin.approveArticle');
        Route::post('/articles/{id}/reject', [AdminController::class, 'rejectArticle'])->name('admin.rejectArticle');
    });
});

// Authentication routes
Auth::routes(['verify' => true]);
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

// Registration routes
Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [RegisterController::class, 'register']);

// Works page route
Route::get('/works/{id}', [UserProfileController::class, 'showWorks'])->name('works.show');

// Article routes
Route::get('/articles', [ArticleController::class, 'index'])->name('articles.index');
Route::get('/articles/create', [ArticleController::class, 'create'])->middleware('auth')->name('articles.create');
Route::post('/articles', [ArticleController::class, 'store'])->middleware('auth')->name('articles.store');
Route::get('/articles/{id}', [ArticleController::class, 'show'])->name('articles.show');
