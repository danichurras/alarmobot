<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AlarmeController;
use App\Http\Controllers\DashboardController;
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

//Inicial
Route::get('/', function () {
    return view('welcome');
});

//Dashboard
Route::get('/dashboard', [DashboardController::class, 'dashboard'])
    ->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    //Perfil
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    //Alarmes
    Route::prefix('/alarmes')->name('alarmes.')->group(function () {
        Route::get('/listar', [AlarmeController::class, 'listar'])->name('listar');
        Route::get('/cadastrar', [AlarmeController::class, 'cadastrar'])->name('cadastrar');
        Route::post('/salvar', [AlarmeController::class, 'salvar'])->name('salvar');

        Route::prefix('/{id}')->group(function () {
            Route::get('/editar', [AlarmeController::class, 'editar'])->name('editar');
            Route::put('/atualizar', [AlarmeController::class, 'atualizar'])->name('atualizar');
            Route::delete('/deletar', [AlarmeController::class, 'deletar'])->name('deletar');
            Route::get('/gerenciar', [AlarmeController::class, 'gerenciar'])->name('gerenciar');
            Route::put('/atualizarStatus', [AlarmeController::class, 'atualizarStatus'])->name('atualizarStatus');
        });
    });
});

require __DIR__.'/auth.php';
