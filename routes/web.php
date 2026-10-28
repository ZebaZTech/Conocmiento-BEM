<?php

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

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';

