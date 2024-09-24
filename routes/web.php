<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MapaController;
use App\Http\Controllers\AnimaisController;
use Illuminate\Support\Facades\Log;


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
    Route::resource('mapa', MapaController::class);
    Route::get('/alerta/getAnimais', [AnimaisController::class, 'getAnimais'])->name('mapa.getAnimais.swal');
    Route::post('/alerta/storeAlerta', [AnimaisController::class, 'storeAlerta'])->name('mapa.storeAlerta.swal');


});

require __DIR__.'/auth.php';
