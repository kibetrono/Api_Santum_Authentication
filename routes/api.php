<?php

use App\Http\Controllers\ProductController;
use App\Http\Controllers\SanctumAuthController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Models\Product;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// This are the unprotected/public routes
Route::get('/products',[ProductController::class,'index']);
Route::get('/products/search/{name}', [ProductController::class, 'search']);
Route::post('/register', [SanctumAuthController::class, 'register']);
Route::post('/login', [SanctumAuthController::class, 'login']);

//  end of the unprotected/public routes

// This are the protected routes

// Route::group(['middleware' => 'auth:sanctum'], function () {
//     Route::apiResource('products', ProductController::class);
// });

Route::group(['middleware' => 'auth:sanctum'], function () {

    Route::get('products/{id}/', [ProductController::class, 'show']);
    Route::post('products', [ProductController::class,'store']);
    Route::put('products/{id}', [ProductController::class, 'update']);
    Route::delete('products/{id}', [ProductController::class, 'destroy']);
    Route::post('/logout', [SanctumAuthController::class, 'logout']);

});

// end of the protected routes


