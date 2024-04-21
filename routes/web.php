<?php

use App\Http\Controllers\AccountController;
use App\Models\Role;
use Illuminate\Support\Facades\Auth;
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

Auth::routes();

Route::get('/', function () {
    return view('welcome');
});

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/profile', [AccountController::class, 'profile'])->name('profile');
Route::put('/profile/{id}', [AccountController::class, 'updateProfile'])->name('profile.update');

Route::group(['middleware' => 'role:1'], function () {

});

Route::group(['middleware' => 'role:2'], function () {
    Route::get('/registerteacher', [AccountController::class, 'registerteacher'])->name('registerteacher');
    Route::post('/registerteacher', [AccountController::class, 'createteacher'])->name('registerteacher.create');
});

Route::group(['middleware' => 'role:3'], function () {
    Route::get('/registerchild', [AccountController::class, 'registerchild'])->name('registerchild');
    Route::post('/registerchild', [AccountController::class, 'createchild'])->name('registerchild.create');
});

Route::group(['middleware' => 'role:4'], function () {
    
});