<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\BrandApiController;
use App\Http\Controllers\Api\CartController;
use App\Http\Controllers\Api\FeProductController;
use App\Http\Controllers\Api\OrderController;
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
Route::group([
    'middleware' => 'api',


], function () {
    Route::post('/login', [AuthController::class, 'login']);
    Route::post('/register', [AuthController::class, 'register']);
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::post('/refresh', [AuthController::class, 'refresh']);
    Route::get('/user-profile', [AuthController::class, 'userProfile']);
    Route::post('/change-pass', [AuthController::class, 'changePassWord']);
    Route::get('product_list',[FeProductController::class,'product_list']);
    Route::get('product_list/search',[FeProductController::class,'search']);
    Route::get('product_detail/{id}',[FeProductController::class,'product_detail']);
    Route::get('category_list',[FeProductController::class,'category_list']);
    Route::get('trendingProduct',[FeProductController::class,'trendingProduct']);
    Route::get('getBaner',[FeProductController::class,'getBaner']);
    Route::get('getCustomer',[FeProductController::class,'getCustomer']);
    Route::get('coutReviewStar/{id}',[FeProductController::class,'coutReviewStar']);
    Route::get('getReview/{id}',[FeProductController::class,'getReview']);
    Route::post('addAnswer',[ReviewApiController::class,'addAnswer']);
    //review
    Route::apiResource('review', ReviewApiController::class);
});


Route::apiResource('brand',BrandApiController::class);





//addToCart
Route::get('list-cart', [CartController::class, 'getAllCart']);
Route::get('add-to-cart/{id}', [CartController::class, 'addToCart']);
Route::get('remove-to-cart/{id}', [CartController::class, 'removeToCart']);
Route::get('remove-all-cart', [CartController::class, 'removeAllCart']);
Route::get('update-cart/{id}/{quantity}', [CartController::class, 'updateCart']);
//Order
Route::get('order/create', [OrderController::class, 'create']);
Route::get('order/list-province', [OrderController::class, 'getAllProvince']);
Route::get('order/list-district/{id}', [OrderController::class, 'getAllDistrictByProvinceId']);
Route::get('order/list-ward/{id}', [OrderController::class, 'getAllWardByDistrictId']);
Route::post('order/store', [OrderController::class, 'store']);
Route::get('order/show/{id}', [OrderController::class, 'show']);
