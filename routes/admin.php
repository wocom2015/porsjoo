<?php

use App\Http\Controllers\admin\CategoriesController;
use App\Http\Controllers\admin\ConfigurationController;
use App\Http\Controllers\admin\DashboardController;
use App\Http\Controllers\admin\InquiriesController;
use App\Http\Controllers\admin\PermissionsController;
use App\Http\Controllers\admin\PlansController;
use App\Http\Controllers\admin\ProfileController;
use App\Http\Controllers\admin\RolesController;
use App\Http\Controllers\admin\SliderController;
use App\Http\Controllers\admin\UsersController;
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

Route::middleware('auth_admin')->prefix("admin")->group(function () {
    Route::get('/', [DashboardController::class, 'index'])->middleware(['verified'])->name('dashboard');
    Route::resource("users", UsersController::class);
    Route::resource('categories', CategoriesController::class);
    Route::post("/categories/item", [CategoriesController::class, 'item'])->name("categories.item");
    Route::post("/categories/subList", [CategoriesController::class, 'subList'])->name("categories.subList");
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::get("/configuration", [ConfigurationController::class, 'index']);
    Route::post("/configuration/update", [ConfigurationController::class, 'update'])->name("config.update");
    Route::get("/configuration/slider", [SliderController::class, 'index']);
    Route::post("/configuration/slider", [SliderController::class, 'update'])->name("config.clientsSlides.update");
//    Route::delete("/configuration/clients-slides/delete" , [SliderController::class , 'delete'])->name("config.clientsSlides.delete");
    Route::resource('plans', CategoriesController::class);

    Route::resource('inquiries', InquiriesController::class);
    Route::resource('plans', PlansController::class);
    Route::resource('roles', RolesController::class);
    Route::resource('permissions', PermissionsController::class);
    Route::post("/roles/save-permissions", [RolesController::class, 'save_permissions'])->name('roles.savePermissions');
    Route::post("/roles/get-permissions", [RolesController::class, 'get_permissions'])->name('roles.getPermissions');
});




require __DIR__.'/auth.php';
