<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProfileController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::prefix('auth')->group(function () {
    Route::post('join', [AuthController::class, 'join']);           //회원가입
    Route::post('login', [AuthController::class, 'login']);         //로그인
    Route::post('logout', [AuthController::class, 'logout']);       //로그아웃
});

Route::prefix('profile')->group(function () {
    Route::get('/', [ProfileController::class, 'profile']);         //사용자 프로필
    Route::put('/', [ProfileController::class, 'editProfile']);     //사용자 프로필 수정
});
