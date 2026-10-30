<?php

use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\ContactMessageController;
use App\Http\Controllers\Admin\PlanController;
use App\Http\Controllers\Admin\TestimonialController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('pages.inicio');
})->name('home');

Route::get('/caracteristicas', function () {
    return view('pages.caracteristicas');
})->name('caracteristicas');

Route::get('/opiniones', function () {
    return view('pages.opiniones');
})->name('opiniones');

Route::get('/planes', function () {
    return view('pages.planes');
})->name('planes');

Route::get('/contacto', function () {
    return view('pages.contacto');
})->name('contacto');

Route::post('/contacto', [ContactController::class, 'store'])
    ->middleware('throttle:5,1')
    ->name('contacto.store');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::resource('plans', PlanController::class);
    Route::resource('testimonials', TestimonialController::class);
    Route::resource('categories', CategoryController::class);
    Route::resource('contact-messages', ContactMessageController::class)
        ->only(['index', 'show', 'destroy'])
        ->parameters(['contact-messages' => 'contactMessage']);
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
