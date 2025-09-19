<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;

Route::get('/', [LoginController::class, 'loginForm']);
Route::post('login', [LoginController::class, 'login']);
Route::get('/dashboard', [LoginController::class, 'dashboard']);
