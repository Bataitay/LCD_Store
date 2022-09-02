<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\RoleController;
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
Route::get('/index', function () {
    return view('back-end.dashboard.index');
});
Route::get('/login', function () {
    return view('back-end.auth.login');
});
Route::get('/register', function () {
    return view('back-end.auth.register');
});
Route::controller(ProductController::class)->group(function(){
    Route::get('product/index','index');
});
Route::controller(CategoryController::class)->group(function(){
    Route::get('category/index','index')->name('category.index');
});
Route::controller(RoleController::class)->group(function(){
    Route::get('role/index','index')->name('role.index');
    Route::get('role/create','create')->name('role.create');
    Route::post('role/store','store')->name('role.store');
    Route::get('role/edit/{id}','edit')->name('role.edit');
    Route::put('role/update/{id}','update')->name('role.update');
});
