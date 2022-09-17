<?php

use App\Http\Controllers\BannerController;
use App\Http\Controllers\BrandController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\DashBoardServer;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\RoleController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;


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



Route::controller(UserController::class)->group(function () {
    Route::get('login', 'login')->name('login');
    Route::post('user/handelLogin', 'handelLogin')->name('user.handelLogin');
});
Route::middleware(['auth','prevent-back-history'])->group(function () {
    Route::get('/dashboard',DashBoardServer::class)->name('dashboard');

    Route::controller(CategoryController::class)->group(function () {
        Route::get('category/index', 'index')->name('category.index');
        Route::get('category/create', 'create')->name('category.create');
        Route::post('category/store', 'store')->name('category.store');
        Route::get('category/edit/{id}', 'edit')->name('category.edit');
        Route::put('category/update/{id}', 'update')->name('category.update');
        Route::delete('category/delete/{id}', 'destroy')->name('category.delete');
        Route::get('category/getTrashed', 'getTrashed')->name('category.getTrashed');
        Route::get('category/restore/{id}', 'restore')->name('category.restore');
        Route::delete('category/force_destroy/{id}', 'force_destroy')->name('category.force_destroy');
    });
    Route::controller(ProductController::class)->group(function () {
        Route::get('product/index', 'index')->name('product.index');
        Route::get('product/create', 'create')->name('product.create');
        Route::post('product/store', 'store')->name('product.store');
        Route::get('product/show/{id}', 'show')->name('product.show');
        Route::get('product/edit/{id}', 'edit')->name('product.edit');
        Route::put('product/update/{id}', 'update')->name('product.update');
        Route::delete('product/delete/{id}', 'destroy')->name('product.delete');
        Route::get('product/getTrashed', 'getTrashed')->name('product.getTrashed');
        Route::get('product/restore/{id}', 'restore')->name('product.restore');
        Route::delete('product/force_destroy/{id}', 'force_destroy')->name('product.force_destroy');
        Route::get('product/showStatus/{id}', 'showStatus')->name('product.showStatus');
        Route::get('product/hideStatus/{id}', 'hideStatus')->name('product.hideStatus');
    });
    Route::controller(UserController::class)->group(function () {
        Route::get('user/index', 'index')->name('user.index');
        Route::get('user/GetDistricts', 'GetDistricts')->name('user.GetDistricts');
        Route::get('user/getWards', 'getWards')->name('user.getWards');
        Route::get('user/create', 'create')->name('user.create');
        Route::post('user/store', 'store')->name('user.store');
        Route::post('user/addAvatar', 'addAvatar')->name('user.addAvatar');
        Route::get('user/show/{id}', 'show')->name('user.show');
        Route::get('user/edit/{id}', 'edit')->name('user.edit');
        Route::put('user/update/{id}', 'update')->name('user.update');
        Route::put('user/updateAvatar', 'updateAvatar')->name('user.updateAvatar');
        Route::delete('user/delete/{id}', 'destroy')->name('user.delete');
        Route::get('user/getTrashed', 'getTrashed')->name('user.getTrashed');
        Route::get('user/restore/{id}', 'restore')->name('user.restore');
        Route::delete('user/force_destroy/{id}', 'force_destroy')->name('user.force_destroy');
        Route::post('user/logout', 'logout')->name('user.logout');
        Route::get('user/changePassword', 'changePassword')->name('user.changePassword');
        Route::post('user/updatePassword', 'updatePassword')->name('user.updatePassword');
    });
    Route::controller(RoleController::class)->group(function () {
        Route::get('role/index', 'index')->name('role.index');
        Route::get('role/create', 'create')->name('role.create');
        Route::post('role/store', 'store')->name('role.store');
        Route::get('role/edit/{id}', 'edit')->name('role.edit');
        Route::put('role/update/{id}', 'update')->name('role.update');
        Route::delete('role/destroy/{id}', 'destroy')->name('role.destroy');
        Route::delete('role/force_destroy/{id}', 'force_destroy')->name('role.force_destroy');
        Route::get('role/getTrashed', 'getTrashed')->name('role.getTrashed');
        Route::get('role/restore/{id}', 'restore')->name('role.restore');
    });
    //Order
    Route::controller(OrderController::class)->group(function () {
        Route::get('order/index', 'index')->name('order.index');
        Route::get('order/create', 'create')->name('order.create');
        Route::post('order/store', 'store')->name('order.store');
        Route::get('order/show/{id}', 'show')->name('order.show');
        Route::put('order/updatesingle/{id}', 'updateSingle')->name('order.updatesingle');
        // Route::get('order/edit/{id}', 'edit')->name('order.edit');
        // Route::put('order/update/{id}', 'update')->name('order.update');
        // Route::delete('order/destroy/{id}', 'destroy')->name('order.destroy');
        // Route::get('order/getTrashed', 'getTrashed')->name('order.getTrashed');
        // Route::get('order/restore/{id}', 'restore')->name('order.restore');
        // Route::delete('order/force_destroy/{id}', 'force_destroy')->name('order.force_destroy');
    });
    //Banner
    Route::controller(BannerController::class)->group(function () {
        Route::get('banner/index', 'index')->name('banner.index');
        Route::get('banner/create', 'create')->name('banner.create');
        Route::post('banner/store', 'store')->name('banner.store');
        Route::get('banner/edit/{id}', 'edit')->name('banner.edit');
        Route::put('banner/update/{id}', 'update')->name('banner.update');
        Route::post('banner/updatestatus/{id}/{status?}', 'updateStatus')->name('banner.updatestatus');
        Route::delete('banner/destroy/{id}', 'destroy')->name('banner.destroy');
        // Route::get('banner/getTrashed', 'getTrashed')->name('banner.getTrashed');
        // Route::get('banner/restore/{id}', 'restore')->name('banner.restore');
        // Route::delete('banner/force_destroy/{id}', 'force_destroy')->name('banner.force_destroy');
    });


    Route::resource('brand', BrandController::class);
    Route::get('brands/trash', [BrandController::class, 'getTrash'])->name('brand.trash');
    Route::post('brands/trash/restore/{id}', [BrandController::class, 'restore'])->name('brand.restore');
    Route::delete('brands/trash/force-delete/{id}', [BrandController::class, 'forceDelete'])->name('brand.forceDelete');
    Route::get('search_brand', [BrandController::class, 'searchByName'])->name('brand.searchKey');
    Route::get('searchBrand', [BrandController::class, 'searchBrand'])->name('brand.search');

    //Review
    Route::resource('review', ReviewController::class);
    Route::get('changeStatus/{id}', [ReviewController::class, 'changeStatus'])->name('review.changeStatus');
    Route::get('reviews/trash', [ReviewController::class, 'getTrash'])->name('review.trash');
    Route::post('reviews/trash/restore/{id}', [ReviewController::class, 'restore'])->name('review.restore');
    Route::delete('reviews/trash/force-delete/{id}', [ReviewController::class, 'forceDelete'])->name('review.forceDelete');
    Route::get('searchReviews', [ReviewController::class, 'searchByName'])->name('review.searchKey');
    Route::get('searchReview', [ReviewController::class, 'searchReview'])->name('review.search');

    //Customer
    Route::resource('customer', CustomerController::class);
    Route::get('customers/trash', [CustomerController::class, 'getTrash'])->name('customer.trash');
    Route::post('customers/trash/restore/{id}', [CustomerController::class, 'restore'])->name('customer.restore');
    Route::delete('customers/trash/force-delete/{id}', [CustomerController::class, 'forceDelete'])->name('customer.forceDelete');
    Route::get('searchCustomers', [CustomerController::class, 'searchByName'])->name('customer.searchKey');
    Route::get('searchCustomer', [CustomerController::class, 'searchCustomer'])->name('customer.search');
});
