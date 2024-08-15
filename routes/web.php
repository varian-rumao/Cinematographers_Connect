<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PageController;

Route::get('/', [PageController::class, 'home'])->name('home');
Route::get('/works', [PageController::class, 'works'])->name('works');
Route::get('/stories', [PageController::class, 'stories'])->name('stories');
Route::get('/gallery', [PageController::class, 'gallery'])->name('gallery');
Route::get('/contact', [PageController::class, 'contact'])->name('contact');
Route::get('/search', [PageController::class, 'search'])->name('search');
