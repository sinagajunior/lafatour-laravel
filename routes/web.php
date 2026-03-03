<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\PackageController;
use App\Http\Controllers\AboutController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\GalleryController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\TrackingController;
use App\Http\Controllers\FaqController;
use Illuminate\Support\Facades\Route;

// Homepage
Route::get('/', [HomeController::class, 'index'])->name('home');

// Package Routes
Route::prefix('paket')->name('packages.')->group(function () {
    Route::get('/umroh', [PackageController::class, 'umroh'])->name('umroh');
    Route::get('/haji', [PackageController::class, 'haji'])->name('haji');
    Route::get('/{slug}', [PackageController::class, 'show'])->name('show');
});

// About Page
Route::get('/tentang-kami', [AboutController::class, 'index'])->name('about');

// Gallery
Route::get('/galeri', [GalleryController::class, 'index'])->name('gallery');

// Blog
Route::prefix('berita')->name('blog.')->group(function () {
    Route::get('/', [BlogController::class, 'index'])->name('index');
    Route::get('/{slug}', [BlogController::class, 'show'])->name('show');
});

// Contact
Route::get('/kontak', [ContactController::class, 'index'])->name('contact');
Route::post('/kontak', [ContactController::class, 'submit'])->name('contact.submit');

// Booking
Route::get('/daftar', [BookingController::class, 'create'])->name('booking.create');
Route::post('/booking', [BookingController::class, 'store'])->name('booking.store');
Route::get('/booking/success/{booking}', [BookingController::class, 'success'])->name('booking.success');

// Tracking
Route::get('/cek-pemesanan', [TrackingController::class, 'index'])->name('tracking');
Route::post('/tracking', [TrackingController::class, 'search'])->name('tracking.search');

// FAQ
Route::get('/faq', [FaqController::class, 'index'])->name('faq');

// Legacy route support (optional - for backward compatibility)
Route::get('/umroh', fn() => redirect()->route('packages.umroh'));
Route::get('/haji', fn() => redirect()->route('packages.haji'));

// Test route for logo debugging
Route::get('/test-logo', function() {
    return view('test_logo');
})->name('test.logo');
