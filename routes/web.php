<?php

use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\LanguageController;
use App\Http\Controllers\MainController;
use App\Http\Controllers\NotificationsController;
use App\Http\Controllers\PostController;
use Illuminate\Support\Facades\Route;

Route::get('/', [MainController::class, 'index'])->name('main');
Route::get('/about', [MainController::class, 'about'])->name('about');
Route::get('/service', [MainController::class, 'service'])->name('service');
Route::get('/projects', [MainController::class, 'projects'])->name('projects');
Route::get('/contact', [MainController::class, 'contact'])->name('contact');


Route::get('/register',[AuthController::class,'register'])->name('register');
Route::post('/register',[AuthController::class,'register_store'])->name('register.store');

Route::get('/login',[AuthController::class,'login'])->name('login');
Route::post('/authenticate',[AuthController::class,'authenticate'])->name('authenticate');

Route::post('/logout',[AuthController::class,'logout'])->name('logout');


Route::middleware('auth')->group(function () {
    Route::get('/notifications/{notification}/read',[NotificationsController::class,'read'])->name('notifications.read');
});

//=============== lang ====================
Route::get('language/{locale}',[LanguageController::class,'change_lang'])->name('language.locale');

Route::resources([
    'posts' => PostController::class,
    'comments' => CommentController::class,
    'notifications' => NotificationsController::class,
]);
