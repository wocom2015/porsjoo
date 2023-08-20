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
Route::get('/check-code', [UsersController::class , 'check_code'])->name('check-code');
Route::post('/verify', [UsersController::class , 'verify'])->name('users.verify');
Route::post('/signup', [UsersController::class , 'register'])->name('users.register');
Route::post('/signin', [UsersController::class , 'login'])->name('users.login');
Route::post('/search', [CategoriesController::class , 'search'])->name('search');
Route::get('/contact', [HomeController::class , 'contact'])->name('contact');
Route::get('/page/{title}', [HomeController::class , 'page']);

Route::get('/plans' , [PlansController::class , 'index']);

Route::middleware('auth_user')->group(function () {
    Route::get('/inquiry/request/{category_id}', [InquiriesController::class , 'index'])->name('inquiry-form');
    Route::post('/inquiry/create', [InquiriesController::class , 'create'])->name('inquiry');
    Route::post('/inquiry/item', [InquiriesController::class , 'item']);
    Route::post('/inquiry/reply', [InquiriesController::class , 'reply']);
    Route::post('/inquiry/reply-info', [InquiriesController::class , 'reply_info']);
    Route::post('/inquiry/replies', [InquiriesController::class , 'replies']);
    Route::post('/inquiry/supplier', [InquiriesController::class , 'supplier']);
    Route::post('/inquiry/comment', [InquiriesController::class , 'comment']);
    Route::post('/inquiry/comment-info', [InquiriesController::class , 'comment_info']);
    Route::get('/inquiry/details/{id}/{name}', [InquiriesController::class , 'details']);
    Route::post('/cities', [CitiesController::class , 'index']);
    Route::get('/profile', [ProfileController::class , 'index'])->name('profile');
    Route::get('/profile/edit', [ProfileController::class , 'edit'])->name('profile.edit');
    Route::post('/profile/edit', [ProfileController::class , 'update'])->name('profile.update');
    Route::get('/plans/buy/{plan_id}' , [PlansController::class , 'buy']);
    Route::get('/user/logout' , [UsersController::class , 'logout']);
});

require __DIR__.'/auth.php';
