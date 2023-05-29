<?php

use App\Http\Controllers\admin\DashboardController;
use App\Http\Controllers\admin\PlansController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\InquiriesController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UsersController;
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


Route::get('/', [HomeController::class , 'index'])->name('home');


Route::get('/profile', [ProfileController::class , 'index'])->name('profile');
Route::get('/inquiry/request', [InquiriesController::class , 'index'])->name('index');
Route::get('/signin', [UsersController::class , 'signin'])->name('signin');
Route::get('/signup', [UsersController::class , 'signup'])->name('signup');
Route::post('/signup', [UsersController::class , 'register'])->name('users.register');
Route::post('/signin', [UsersController::class , 'login'])->name('users.login');


Route::resource('plans' , PlansController::class);

Route::middleware('auth')->group(function () {

});




require __DIR__.'/auth.php';
