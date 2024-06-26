<?php

use App\Http\Controllers\SocialController;
use Illuminate\Support\Facades\Route;
use Livewire\Volt\Volt;

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

Route::middleware('auth')->group(function () {
    Volt::route('/', 'pages.tasks.index')->name('tasks.index');
    Volt::route('/teams', 'pages.teams.index')->name('teams.index');
    Volt::route('/my-teams', 'pages.my-teams.index')->name('my-teams.index');
    Volt::route('/flows/{flow}/tasks/{task}', 'pages.tasks.show')->name('tasks.show');
    Volt::route('/teams/{team}', 'pages.teams.show')->name('teams.show');

    Route::get('/{provider}/logout', [SocialController::class, 'logout'])->name('logout');
});

Route::prefix('auth')->group(function () {
    Route::get('/{provider}/redirect', [SocialController::class, 'redirectToProvider'])->name('login');
    Route::get('/{provider}/callback', [SocialController::class, 'handleProviderCallback']);
});
