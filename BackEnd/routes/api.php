<?php

use App\Http\Controllers\Api\FeProductController;
use App\Http\Controllers\Api\ReviewApiController;
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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


Route::get('product_list',[FeProductController::class,'product_list']);
Route::get('product_detail/{id}',[FeProductController::class,'product_detail']);
Route::get('category_list',[FeProductController::class,'category_list']);
Route::get('trendingProduct',[FeProductController::class,'trendingProduct']);
//review
Route::apiResource('review',ReviewApiController::class);


