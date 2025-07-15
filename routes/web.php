<?php

use Illuminate\Support\Facades\Route;
use Livewire\Volt\Volt;
use App\Http\Controllers\RemoteLoginController;
use App\Http\Controllers\DashboardController;

Route::get('/', function () {
    // return view('welcome');
    // Redirect to dashboard
    return redirect()->route('dashboard');
})->name('home');

Route::get('dashboard', [DashboardController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::get('remote-login', [RemoteLoginController::class, 'showLoginForm'])->name('remote.login');
Route::post('remote-login', [RemoteLoginController::class, 'login'])->name('remote.login.submit');

Route::middleware(['auth'])->group(function () {
    Route::redirect('settings', 'settings/profile');

    Volt::route('settings/profile', 'settings.profile')->name('settings.profile');
    Volt::route('settings/password', 'settings.password')->name('settings.password');
    Volt::route('settings/appearance', 'settings.appearance')->name('settings.appearance');
});

require __DIR__ . '/auth.php';
