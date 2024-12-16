<?php

use App\Livewire\CreateTicket;
use App\Livewire\Login;
use App\Livewire\Home;
use App\Livewire\Logout;
use App\Livewire\ViewTicket;
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

Route::get('login', Login::class)
    ->middleware(['guest', 'throttle:auth'])
    ->name('login');

Route::group(['middleware' => ['auth', 'throttle:web']], function () {
    Route::get('/', Home::class)->name('home');
    Route::get('/logout', Logout::class)->name('logout');

    Route::get('/ticket/create', CreateTicket::class)->name('ticket.create');
    Route::get('/ticket/view/{ticket}', ViewTicket::class)->name('ticket.view');
});
