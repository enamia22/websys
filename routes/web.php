<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

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
Route::get('/', [App\Http\Controllers\ConsultationController::class, 'index'])
    ->name('app.welcome');

Auth::routes();

Route::resource('home', App\Http\Controllers\HomeController::class)
    ->only(['index','destroy'])
    ->middleware('auth');

Route::patch('/approve/{id}', [App\Http\Controllers\HomeController::class, 'approve'])
    ->name('home.approve')
    ->middleware('auth');

Route::resource('consultations', App\Http\Controllers\ConsultationController::class)
    ->only(['index','store','destroy'])
    ->middleware('auth');

Route::get('/search', [App\Http\Controllers\ConsultationController::class, 'search'])
    ->name('consultations.search')
    ->middleware('auth');

