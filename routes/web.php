<?php

use App\Livewire\Settings\Appearance;
use App\Livewire\Settings\Password;
use App\Livewire\Settings\Profile;
use App\Livewire\Auth\Login;
use App\Livewire\Users\EditUser;
use App\Livewire\Users\DeleteUser;
use App\Livewire\Users\Index;
use App\Livewire\Users\CreateUser;
use App\Livewire\Transactions\Index as TransactionsIndex;
use App\Livewire\Transactions\Create as TransactionsCreate;
use Illuminate\Support\Facades\Route;

// Route::get('/', function () {
//     return view('welcome');
// })->name('home');
Route::get('/',  Login::class)->name('home');

Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::middleware(['auth'])->group(function () {
    Route::redirect('settings', 'settings/profile');

    Route::get('settings/profile', Profile::class)->name('settings.profile');
    Route::get('settings/password', Password::class)->name('settings.password');
    Route::get('settings/appearance', Appearance::class)->name('settings.appearance');
});

Route::middleware(['auth', 'verified'])->group(function () {
    Route::prefix('/users')->group(function (): void {
        Route::get('/', Index::class)->name('users');
        Route::get('/create', CreateUser::class)->name('user.create');
        Route::get('/edit/{id}', EditUser::class)->name('user.edit');
        Route::delete('/delete/{id}', DeleteUser::class)->name('user.delete');
    });

    Route::prefix('/transactions')->group(function (): void {
        Route::get('/', TransactionsIndex::class)->name('transactions');
        Route::get('/create', TransactionsCreate::class)->name('transactions.create');
        // Route::get('/edit/{id}', TransactionsCreate::class)->name('transactions.edit');
    });
});

require __DIR__.'/auth.php';
