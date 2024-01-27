<?php

use App\Http\Controllers\CategoriesController;
use App\Http\Controllers\CitiesController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\InquiriesController;
use App\Http\Controllers\messagesController;
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
Route::get('/forgot', [UsersController::class , 'forgot'])->name('forgot');
Route::post('/change-pass', [UsersController::class , 'change_pass'])->name('users.change-pass');
Route::post('/password-change', [UsersController::class , 'password_change'])->name('password_change');
Route::get('/check-code', [UsersController::class , 'check_code'])->name('check-code');
Route::post('/verify', [UsersController::class , 'verify'])->name('users.verify');
Route::post('/signup', [UsersController::class , 'register'])->name('users.register');
Route::post('/signin', [UsersController::class , 'login'])->name('users.login');
Route::post('/search', [CategoriesController::class , 'search'])->name('search');
Route::post('/search/inquiry', [CategoriesController::class , 'search_inquiry'])->name('search-inquiry');
Route::get('/contact', [HomeController::class, 'contact'])->name('contact');
Route::post('/contact', [HomeController::class, 'sendContact'])->name('users.contact');
Route::get('/rules', [HomeController::class, 'rules'])->name('rules');
Route::get('/page/{title}', [HomeController::class , 'page']);
Route::get('/payment/callback', [PlansController::class, 'callback']);
Route::post('/payment/callback', [PlansController::class, 'callback']);

Route::get('/plans' , [PlansController::class , 'index']);

Route::middleware('auth_user')->group(function () {
    Route::get('/inquiry/request', [InquiriesController::class , 'index'])->name('inquiry-form');
    Route::post('/inquiry/create', [InquiriesController::class , 'store'])->name('inquiry');
    Route::post('/inquiry/feedback', [InquiriesController::class , 'feedback'])->name('inquiry.feedback');
    Route::get('/inquiry/archive', [InquiriesController::class , 'show'])->name('archive');
    Route::post('/inquiry/item', [InquiriesController::class , 'item']);
    Route::post('/inquiry/reply', [InquiriesController::class , 'reply']);
    Route::post('/inquiry/reply-info', [InquiriesController::class , 'reply_info']);
    Route::post('/inquiry/replies', [InquiriesController::class , 'replies']);
    Route::post('/inquiry/supplier', [InquiriesController::class , 'supplier']);
    Route::post('/inquiry/comment', [InquiriesController::class , 'comment']);
    Route::get('/inquiry/report', [InquiriesController::class , 'report']);
    Route::post('/inquiry/comment-info', [InquiriesController::class , 'comment_info']);
    Route::get('/inquiry/details/{id}/{name}', [InquiriesController::class , 'details']);
    Route::post('/cities', [CitiesController::class , 'index']);
    Route::get('/profile', [ProfileController::class , 'index'])->name('profile');
    Route::get('/profile/edit', [ProfileController::class , 'edit'])->name('profile.edit');
    Route::post('/profile/edit', [ProfileController::class , 'update'])->name('profile.update');
    Route::get('/plans/invoice/{plan_id}' , [PlansController::class , 'invoice']);
    Route::get('/plans/payment/{plan_id}' , [PlansController::class , 'payment']);
    Route::get('/user/logout' , [UsersController::class , 'logout']);
    Route::get('/user/profile/{user_id}' , [UsersController::class , 'profile']);
    Route::post('/messages' , [messagesController::class , 'index']);
    Route::post('/messages/send' , [messagesController::class , 'create']);
});

require __DIR__.'/auth.php';
