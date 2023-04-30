<?php

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

Route::get('/', function () {
    return view('welcome');
});

// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::get('/dashboard', [App\Http\Controllers\PetsController::class, 'index'])
->middleware(['auth'])
->name('dashboard');

Route::get('/register-pet', [App\Http\Controllers\PetsController::class, 'create'])
->middleware(['auth'])
->name('register-pet');

Route::post('/register-pet', [App\Http\Controllers\PetsController::class, 'store'])
->middleware(['auth'])
->name('register-pet');

Route::get('/dashboard/adotar/{id}',[\App\Http\Controllers\PetsController::class,'adotar'])
->middleware(['auth'])
->name('adotar-pet');

Route::get('/pets/adotado',[\App\Http\Controllers\PetsController::class,'show_adotado'])
->middleware(['auth'])
->name('adotado-pet');

Route::get('/pets/doado',[\App\Http\Controllers\PetsController::class,'show_doado'])
->middleware(['auth'])
->name('doado-pet');

Route::get('/pets/historico',[\App\Http\Controllers\PetsController::class,'show_historico'])
->middleware(['auth'])
->name('historico-pet');

require __DIR__.'/auth.php';