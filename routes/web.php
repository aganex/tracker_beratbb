<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\User\DashboardController;
use App\Http\Controllers\User\BeratBadanController;
use App\Http\Controllers\User\ProfileController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Pesan\ChatController;
use App\Http\Controllers\Pesan\AdminChatController;

/*
|--------------------------------------------------------------------------
| HALAMAN AWAL
|--------------------------------------------------------------------------
*/

Route::get('/', function () {
    return redirect('/login');
});

/*
|--------------------------------------------------------------------------
| AUTH
|--------------------------------------------------------------------------
*/

Route::get('/login', [AuthController::class, 'showLogin']);
Route::post('/login', [AuthController::class, 'login']);

Route::get('/register', [AuthController::class, 'showRegister']);
Route::post('/register', [AuthController::class, 'register']);

Route::get('/logout', [AuthController::class, 'logout']);

/*
|--------------------------------------------------------------------------
| USER AREA
|--------------------------------------------------------------------------
*/

Route::middleware('user.auth')->group(function () {

    // DASHBOARD
    Route::get('/dashboard', [DashboardController::class, 'index']);

    // BERAT BADAN
    Route::post('/berat-badan', [BeratBadanController::class, 'store']);

    // PROFILE
    Route::get('/profile', [ProfileController::class, 'index']);
    Route::post('/profile', [ProfileController::class, 'update']);

});

/*
|--------------------------------------------------------------------------
| ADMIN AREA
|--------------------------------------------------------------------------
*/

Route::get('/admin', [AdminController::class, 'index']);
Route::delete('/admin/user/{id}',[AdminController::class, 'destroy']);
Route::get('/admin/user/{id}/edit',[AdminController::class, 'edit']);
Route::put('/admin/user/{id}', [AdminController::class, 'update']);

/*
|--------------------------------------------------------------------------
| PESAN AREA
|--------------------------------------------------------------------------
*/

Route::get('/chat',[ChatController::class, 'index']);
Route::get('/admin/chat',[AdminChatController::class, 'index']);
Route::get('/admin/chat/{id}',[AdminChatController::class, 'show']);
Route::post('/chat/send',[ChatController::class, 'store']);
Route::post('/admin/chat/{id}/send',[AdminChatController::class, 'send']);
Route::get('/admin/user/{id}/chat',[AdminChatController::class, 'open']);
Route::delete('/admin/chat/{chat}', [AdminChatController::class, 'destroy']);