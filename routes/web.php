<?php

use App\Http\Controllers\Admin\CarController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\HomeController;
use App\Models\Car;
use App\Http\Controllers\CarDetailController;

Route::get('/', [HomeController::class, 'welcome'])->name('welcome');
Route::get('/about', [HomeController::class, 'about'])->name('about');
Route::get('/contact', [HomeController::class, 'contact'])->name('contact');

Route::get('/mobil/{slug}', [CarDetailController::class, 'show'])->name('cars.detail');

// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth', 'user'])->name('dashboard');

Route::middleware('auth', 'user')->group(function(){
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('admin/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
    Route::resource('cars', CarController::class);
});
require __DIR__.'/auth.php';