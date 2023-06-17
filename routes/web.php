<?php

use App\Http\Controllers\CategoriesController;
use App\Http\Controllers\CitiesController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\InquiriesController;
use App\Http\Controllers\PlansController;
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




Route::get('/signin', [UsersController::class , 'signin'])->name('signin');
Route::get('/signup', [UsersController::class , 'signup'])->name('signup');
Route::post('/signup', [UsersController::class , 'register'])->name('users.register');
Route::post('/signin', [UsersController::class , 'login'])->name('users.login');
Route::post('/search', [CategoriesController::class , 'search'])->name('search');
Route::get('/contact', [HomeController::class , 'contact'])->name('contact');
Route::get('/page/{title}', [HomeController::class , 'page']);




Route::middleware('auth_user')->group(function () {
    Route::get('/inquiry/request/{category_id}', [InquiriesController::class , 'index'])->name('inquiry-form');
    Route::post('/inquiry/create', [InquiriesController::class , 'create'])->name('inquiry');
    Route::post('/cities', [CitiesController::class , 'index']);
    Route::get('/profile', [ProfileController::class , 'index'])->name('profile');
    Route::get('/profile/edit', [ProfileController::class , 'edit'])->name('profile.edit');
    Route::post('/profile/edit', [ProfileController::class , 'update'])->name('profile.update');
    Route::get('/plans' , [PlansController::class , 'index']);
    Route::get('/plans/buy/{plan_id}' , [PlansController::class , 'buy']);
    Route::get('/user/logout' , [UsersController::class , 'logout']);
});




require __DIR__.'/auth.php';
