<?php

use App\Http\Controllers\GamesController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    
    
});


Route::get('/games', [GamesController::class, 'index'])->name('games.index');

Route::get('/games/create', [GamesController::class, 'create'])->name('games.create');

Route::get('/games/{game}', [GamesController::class, 'show'])->name('games.show');


Route::post('/games', [GamesController::class, 'store'])->name('games.store');


require __DIR__.'/auth.php';
