<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\DaftarLkController;
use App\Http\Controllers\Api\EventController;
use App\Http\Controllers\Api\JoinEventController;
use App\Http\Controllers\Api\TulisanController;
use App\Http\Controllers\Api\UserController;
use App\Models\Tulisan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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


// auth
Route::post('login', [AuthController::class, 'login']);
Route::post('register', [AuthController::class, 'register']);

// user
Route::get('profile', [UserController::class, 'profile'])->middleware('auth:sanctum');
Route::post('profile/update', [UserController::class, 'update'])->middleware('auth:sanctum');

// daftar lk
Route::post('daftarlk/create', [DaftarLkController::class, 'create'])->middleware('auth:sanctum');

// tulisan
Route::get('tulisan', [TulisanController::class, 'index']);
Route::get('tulisan/{id}', [TulisanController::class, 'show']);
Route::delete('tulisan/{id}', [TulisanController::class, 'delete']);
Route::post('tulisan/create', [TulisanController::class, 'create'])->middleware('auth:sanctum');

// event
Route::get('event', [EventController::class, 'index']);
Route::get('event/{id}', [EventController::class, 'show']);
Route::get('kategori', [EventController::class, 'kategoriAll']);
Route::get('kategori/{id}', [EventController::class, 'kategori']);

// joinevent
Route::post('event/join/create', [JoinEventController::class, 'create'])->middleware('auth:sanctum');
Route::get('event-saya', [JoinEventController::class, 'myEvent'])->middleware('auth:sanctum');
