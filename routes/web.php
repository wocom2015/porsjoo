<?php

use App\Http\Controllers\CategoriesController;
use App\Http\Controllers\ConfigurationController;
use App\Http\Controllers\DashboardController;
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


Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [DashboardController::class , 'index'])->middleware(['verified'])->name('dashboard');
    Route::resource("users" , UsersController::class);
    Route::resource('categories' , CategoriesController::class);
    Route::post("/categories/item" , [CategoriesController::class , 'item'])->name("categories.item");
    Route::post("/categories/subList" , [CategoriesController::class , 'subList'])->name("categories.subList");
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::get("/configuration" , [ConfigurationController::class , 'index']);
    Route::post("/configuration/update" , [ConfigurationController::class , 'update']);

    Route::resource('plans' , PlansController::class);


});




require __DIR__.'/auth.php';
