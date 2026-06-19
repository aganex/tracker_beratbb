<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\AuthController;

use App\Http\Controllers\User\DashboardController;
use App\Http\Controllers\User\BeratBadanController;
use App\Http\Controllers\User\ProfileController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// =====================================================
// HALAMAN AWAL
// =====================================================

Route::get('/', function () {

    return redirect('/login');

});

// =====================================================
// AUTH
// =====================================================

Route::get('/login', [AuthController::class, 'showLogin']);

Route::post('/login', [AuthController::class, 'login']);

Route::get('/register', [AuthController::class, 'showRegister']);

Route::post('/register', [AuthController::class, 'register']);

Route::get('/logout', [AuthController::class, 'logout']);

// =====================================================
// USER AREA
// =====================================================

Route::middleware('user.auth')->group(function () {

    // DASHBOARD

    Route::get(
        '/dashboard',
        [DashboardController::class, 'index']
    );

    // BERAT BADAN

    Route::post(
        '/berat-badan',
        [BeratBadanController::class, 'store']
    );

    // PROFILE

    Route::get(
        '/profile',
        [ProfileController::class, 'index']
    );

    Route::post(
        '/profile',
        [ProfileController::class, 'update']
    );

});