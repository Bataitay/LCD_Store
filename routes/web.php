<?php

use App\Http\Controllers\BrandController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ReviewController;
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
    Route::get('category/create','create')->name('category.create');
    Route::post('category/store','store')->name('category.store');
    Route::get('category/edit/{id}','edit')->name('category.edit');
    Route::put('category/update/{id}','update')->name('category.update');
    Route::delete('category/delete/{id}','destroy')->name('category.delete');
    Route::get('category/getTrashed','getTrashed')->name('category.getTrashed');
    Route::get('category/restore/{id}','restore')->name('category.restore');
    Route::delete('category/force_destroy/{id}','force_destroy')->name('category.force_destroy');

});
Route::controller(RoleController::class)->group(function(){
    Route::get('role/index','index')->name('role.index');
    Route::get('role/create','create')->name('role.create');
    Route::post('role/store','store')->name('role.store');
    Route::get('role/edit/{id}','edit')->name('role.edit');
    Route::put('role/update/{id}','update')->name('role.update');
    Route::delete('role/destroy/{id}','destroy')->name('role.destroy');
});
//brand
 Route::resource('brand', BrandController::class);
 Route::get('brands/trash',[BrandController::class,'getTrash'])->name('brand.trash');
 Route::post('brands/trash/restore/{id}',[BrandController::class,'restore'])->name('brand.restore');
 Route::delete('brands/trash/force-delete/{id}',[BrandController::class,'forceDelete'])->name('brand.forceDelete');
 Route::get('search',[BrandController::class, 'searchByName']);
 Route::get('searchBrand', [BrandController::class,'searchBrand'])->name('brand.search');
 //Review
 Route::resource('review', ReviewController::class);
 Route::get('changeStatus/{id}',[ ReviewController::class,'changeStatus'])->name('review.changeStatus');
 Route::get('reviews/trash',[ReviewController::class,'getTrash'])->name('review.trash');
 Route::post('reviews/trash/restore/{id}',[ReviewController::class,'restore'])->name('review.restore');
 Route::delete('reviews/trash/force-delete/{id}',[ReviewController::class,'forceDelete'])->name('review.forceDelete');
 Route::get('review/search',[ReviewController::class, 'searchByName']);
 Route::get('searchReview', [ReviewController::class,'searchReview'])->name('review.search');







