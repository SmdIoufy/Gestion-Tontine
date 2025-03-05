<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\InscriptionController;
use Illuminate\Support\Facades\Route;

Route::get('/', [InscriptionController::class, 'home'])->name('home');

//Inscription utilisateur
Route::get('register', [InscriptionController::class, 'index'])->name('inscription.index');
Route::post('validate-register', [InscriptionController::class, 'register'])
    ->name('inscription.register');

//Authentification
Route::get('connexion', [AuthController::class, 'create'])->name('auth.create');
Route::post('connexion', [AuthController::class, 'auth'])->name('auth.store');
