<?php

use App\Livewire\CreateTicket;
use App\Livewire\Login;
use App\Livewire\Home;
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

Route::get('/', Home::class)
    ->middleware('auth')
    ->name('home');

Route::get('login', Login::class)
    ->middleware('guest')
    ->name('login');

Route::get('/logout', function () {
    auth()->logout();
    request()->session()->invalidate();
    request()->session()->regenerateToken();

    return redirect('/');
})->name('logout');

Route::get('/ticket/create', CreateTicket::class)
    ->middleware('auth')
    ->name('ticket.create');
