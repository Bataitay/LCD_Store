<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});
Route::get('dashboard', function () {
    return view('back-end.dashboard.index');
});
// Route::get('/login', function () {
//     return view('back-end.auth.login');
// });
// Route::get('/register', function () {
//     return view('back-end.auth.register');
// });
Route::middleware(['auth'])->group(function () {
Route::controller(ProductController::class)->group(function(){
    Route::get('product/index','index');
});
Route::controller(CategoryController::class)->group(function(){
    Route::get('category/index','index')->name('category.index');
    Route::get('category/create','create')->name('category.create');
    Route::post('category/store','store')->name('category.store');
    Route::get('category/edit/{id}','edit')->name('category.edit');
    Route::put('category/update/{id}','update')->name('category.update');
    Route::delete('category/delete/{id}','destroy')->name('category.delete');
    Route::get('category/getTrashed','getTrashed')->name('category.getTrashed');
    Route::get('category/restore/{id}','restore')->name('category.restore');
    Route::delete('category/force_destroy/{id}','force_destroy')->name('category.force_destroy');

});
Route::controller(UserController::class)->group(function(){
    Route::get('user/index','index')->name('user.index');
    Route::get('user/GetDistricts','GetDistricts')->name('user.GetDistricts');
    Route::get('user/getWards','getWards')->name('user.getWards');
    Route::get('user/create','create')->name('user.create');
    Route::post('user/store','store')->name('user.store');
    Route::post('user/addAvatar','addAvatar')->name('user.addAvatar');
    Route::get('user/show/{id}','show')->name('user.show');
    Route::get('user/edit/{id}','edit')->name('user.edit');
    Route::put('user/update/{id}','update')->name('user.update');
    Route::delete('user/delete/{id}','destroy')->name('user.delete');
    Route::get('user/getTrashed','getTrashed')->name('user.getTrashed');
    Route::get('user/restore/{id}','restore')->name('user.restore');
    Route::delete('user/force_destroy/{id}','force_destroy')->name('user.force_destroy');

    Route::get('user/logout','logout')->name('user.logout');
});
});
Route::controller(UserController::class)->group(function(){
    Route::get('user/viewLogin','viewLogin')->name('user.viewLogin');
    Route::post('user/login','login')->name('user.login');
});

// Route::post('user/addAvatar', function () {
//     dd($_REQUEST);
// });
