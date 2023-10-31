<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
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

Route::get('/', function () {
    return view('welcome');
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});

// ログイン後のユーザー名のドロップダウンメニューが機能していないため、以下を追加
Livewire::setScriptRoute(function ($handle) {
    return Route::get('/laravel/testproject/vendor/livewire/livewire/dist/livewire.js', $handle);
});

// ログイン後のアカウント情報を表示させるためのルーティング
// Route::get('user/profile', [UserController::class, 'profile'])->name('user.profile');
// Route::resource('/user', 'UserController');