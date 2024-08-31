<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SignupController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProductController;



/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|


Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


*/

//for signup
Route::post('/signup', [SignupController::class, 'signup']);

//for login
Route::post('/login', [LoginController::class, 'login']);

//for show user
Route::get('/users', [UserController::class, 'index']);

//for update user
Route::put('/users/{id}', [UserController::class, 'update']);

//for delete user
Route::delete('/users/{id}', [UserController::class, 'destroy']);

//login user can only add the product
Route::middleware('auth:sanctum')->post('/products', [ProductController::class, 'store']);

//for add product
//Route::post('/products', [ProductController::class, 'store']);
