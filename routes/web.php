<?php

use App\Http\Controllers\Auth\AdminController;
use App\Http\Controllers\Auth\UserController;
use App\Http\Controllers\c_bobot;
use App\Http\Controllers\c_kriteria;
use Illuminate\Support\Facades\Route;

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

Route::middleware(['PreventBackHistory'])->group(function () {
    Auth::routes();
});

Route::view('/test', 'test');



Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::group(['prefix' => 'admin', 'middleware' => ['auth', 'isAdmin', 'PreventBackHistory']], function(){
    Route::get('dashboard', [AdminController::class, 'index'])->name('admin.dashboard');
    Route::resource('kriteria', c_kriteria::class,[
        'names' => [
            'index' => 'admin.kriteria.index',
            'store' => 'admin.kriteria.store',
            'update' => 'admin.kriteria.update',
            'destroy' => 'admin.kriteria.delete'
        ]
    ]);
});

Route::group(['prefix' => 'user', 'middleware' => ['auth', 'isUser','PreventBackHistory']], function(){
    Route::get('dashboard', [UserController::class, 'index'])->name('user.dashboard');
    Route::resource('bobot', c_bobot::class,[
        'names' => [
            'create'=> 'bobot.create',
            'edit'=> 'bobot.edit',
            'index' => 'bobot.index',
            'store' => 'bobot.store',
            'update' => 'bobot.update',
            'destroy' => 'bobot.delete'
        ]
    ]);
});
