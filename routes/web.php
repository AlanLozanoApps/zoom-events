<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ChatController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\PermissionController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [HomeController::class, 'index'])->name('home');

Route::prefix('/')
    ->middleware('auth')
    ->group(function () {
        Route::resource('roles', RoleController::class);
        Route::resource('permissions', PermissionController::class);

        Route::get('usuarios', [UserController::class, 'index'])->name(
            'users.index'
        );
        Route::post('usuarios', [UserController::class, 'store'])->name(
            'users.store'
        );
        Route::get('usuarios/create', [UserController::class, 'create'])->name(
            'users.create'
        );
        Route::get('usuarios/{user}', [UserController::class, 'show'])->name(
            'users.show'
        );
        Route::get('usuarios/{user}/edit', [
            UserController::class,
            'edit',
        ])->name('users.edit');
        Route::put('usuarios/{user}', [UserController::class, 'update'])->name(
            'users.update'
        );
        Route::delete('usuarios/{user}', [
            UserController::class,
            'destroy',
        ])->name('users.destroy');

        Route::get('chat', [ChatController::class, 'index'])->name(
            'chats.index'
        );
        Route::post('chat', [ChatController::class, 'store'])->name(
            'chats.store'
        );
        Route::get('chat/create', [ChatController::class, 'create'])->name(
            'chats.create'
        );
        Route::get('chat/{chat}', [ChatController::class, 'show'])->name(
            'chats.show'
        );
        Route::get('chat/{chat}/edit', [ChatController::class, 'edit'])->name(
            'chats.edit'
        );
        Route::put('chat/{chat}', [ChatController::class, 'update'])->name(
            'chats.update'
        );
        Route::delete('chat/{chat}', [ChatController::class, 'destroy'])->name(
            'chats.destroy'
        );
    });
