<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\CategoryController;
use App\Http\Controllers\Api\PostController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware(['auth:sanctum'])->group(function() {
    Route::get('/user', function (Request $request) {
        return $request->user();
    });
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

    // Category
    Route::controller(CategoryController::class)->prefix('categories')->group(function() {
        Route::get('/', 'categories')->name('category.list');
        Route::post('/', 'create')->name('category.create');
        Route::put('/{category}', 'edit')->name('category.edit');
        Route::delete('/{category}', 'delete')->name('category.delete');
    });

    // Blog Post
    Route::controller(PostController::class)->prefix('posts')->group(function() {
        Route::get('/', 'index');
        Route::get('/{slug}', 'show');
        Route::post('/', 'create');
        Route::put('/{post}', 'edit');
        Route::delete('/{post}', 'delete');
    });
});

Route::post('/login', [AuthController::class, 'login'])->name('login');
Route::post('/register', [AuthController::class, 'register'])->name('register');