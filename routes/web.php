<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\UserController;

// Rota para exibir o formulário de login
Route::get('/login', function () {
    return view('login');
})->name('login.form');

// Rota para processar o login
Route::post('/login', [LoginController::class, 'login'])->name('login');

// Rota para logout
Route::post('/logout', function () {
    session()->forget('usuario');
    return redirect()->route('login.form');
})->name('logout');

// Rota protegida para a página inicial (dashboard)
Route::get('/home', function () {
    if (!session()->has('usuario')) {
        return redirect()->route('login.form');
    }
    return view('dashboard.home');
})->name('home');


// Rota para o perfil do usuário
Route::get('/perfil', [UserController::class, 'showProfile'])->name('perfil');
Route::post('/perfil/update-email', [UserController::class, 'updateEmail'])->name('updateEmail');
Route::post('/perfil/update-password', [UserController::class, 'updatePassword'])->name('updatePassword');
Route::post('/perfil/update-password', [UserController::class, 'updatePassword'])->name('perfil.update-password');
// Defina a rota corretamente em web.php
Route::match(['get', 'post'], '/gestaouser', function () {
    // Lógica para exibir a view e manipular os formulários
    return view('dashboard.gestaouser');
})->name('gestao.usuarios');
// Rota para a gestão de bancos
// Rota para a gestão de bancos (GET para exibir a view e POST para manipular dados)
Route::match(['get', 'post'], '/gestaobancos', [UserController::class, 'listarBancos'])->name('gestao.bancos');

