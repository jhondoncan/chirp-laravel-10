<?php

use App\Http\Controllers\ChirpController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

/* Route::get('/', function () {
  return view('welcome');
}); */

Route::view('/', 'welcome')->name('welcome');

// Rutas que necesitan autenticacion
Route::middleware('auth')->group(function () {

  Route::view('/dashboard', 'dashboard')->name('dashboard');

  Route::get('/perfil', [ProfileController::class, 'edit'])->name('profile.edit');
  Route::patch('/perfil', [ProfileController::class, 'update'])->name('profile.update');
  Route::delete('/perfil', [ProfileController::class, 'destroy'])->name('profile.destroy');

  Route::get('/chirps', [ChirpController::class, 'index'])->name('chirps.index');
  Route::post('/chirps', [ChirpController::class, 'store'])->name('chirps.store');
  Route::get('/chirps/editar/{chirp}', [ChirpController::class, 'edit'])->name('chirps.edit');
  Route::put('/chirps/{chirp}', [ChirpController::class, 'update'])->name('chirps.update');
  Route::delete('/chirps/{chirp}', [ChirpController::class, 'destroy'])->name('chirps.destroy');
});

require __DIR__ . '/auth.php';
