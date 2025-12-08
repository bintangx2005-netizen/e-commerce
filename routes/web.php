<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\AdminProfileController;
use App\Http\Controllers\Admin\AdminVendorController;
use App\Http\Controllers\Admin\BannerController;
use App\Http\Controllers\Admin\BrandController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\SliderController;
use App\Http\Controllers\Admin\SubCategoryController;
use App\Http\Controllers\Frontend\CartController;
use App\Http\Controllers\Frontend\FrontendProductController;
use App\Http\Controllers\Frontend\HomeController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\User\UserController;
use App\Http\Controllers\Vendor\VendorController;
use App\Http\Controllers\Vendor\VendorProductController;
use App\Http\Controllers\Vendor\VendorProfileController;
use Illuminate\Support\Facades\Route;





Route::get('/', [HomeController::class, 'index']);



Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';

// Admin Route

Route::middleware(['auth', 'role:admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [AdminController::class, 'index'])->name('dashboard');
    Route::get('/profile', [AdminProfileController::class, 'index'])->name('profile');
    Route::post('/profile', [AdminProfileController::class, 'store'])->name('profile.store');
    Route::get('/change-password', [AdminProfileController::class, 'editPassword'])->name('change_password');
    Route::post('/change-password', [AdminProfileController::class, 'updatePassword'])->name('change_password');


    Route::controller(AdminVendorController::class)->group(function () {
        Route::get('inactive-vendor', 'inactive_vendor')->name('inactive_vendor');
        Route::get('active-vendor', 'active_vendor')->name('active_vendor');
    });


    Route::controller(BrandController::class)->group(function () {
        Route::get('all-brand', 'index')->name('all_brand');
        Route::get('add-brand', 'create')->name('add_brand');
        Route::post('store-brand', 'store')->name('store_brand');
        Route::get('edit-brand/{brand}', 'edit')->name('edit_brand');
        Route::post('update-brand/{brand}', 'update')->name('update_brand');
        Route::get('delete-brand/{brand}', 'destroy')->name('delete_brand');
    });
    Route::controller(CategoryController::class)->group(function () {
        Route::get('all-category', 'index')->name('all_category');
        Route::get('add-category', 'create')->name('add_category');
        Route::post('store-category', 'store')->name('store_category');
        Route::get('edit-category/{category}', 'edit')->name('edit_category');
        Route::post('update-category/{category}', 'update')->name('update_category');
        Route::get('delete-category/{category}', 'destroy')->name('delete_category');
    });
    Route::controller(SubCategoryController::class)->group(function () {
        Route::get('all-sub-category', 'index')->name('all_sub_category');
        Route::get('add-sub-category', 'create')->name('add_sub_category');
        Route::post('store-sub-category', 'store')->name('store_sub_category');
        Route::get('edit-sub-category/{sub_category}', 'edit')->name('edit_sub_category');
        Route::post('update-sub-category/{sub_category}', 'update')->name('update_sub_category');
        Route::get('delete-sub-category/{sub_category}', 'destroy')->name('delete_sub_category');
    });

    Route::controller(ProductController::class)->group(function () {
        Route::get('/all-product', 'index')->name('all_product');
        Route::get('/add-product', 'create')->name('add_product');
        Route::post('/store-product', 'store')->name('store_product');
        Route::get('/delete-product/{product}', 'destroy')->name('delete_product');
    });

    Route::controller(SliderController::class)->group(function () {
        Route::get('all-slider', 'index')->name('all_slider');
        Route::get('add-slider', 'create')->name('add_slider');
        Route::post('store-slider', 'store')->name('store_slider');
        Route::get('edit-slider/{slider}', 'edit')->name('edit_slider');
        Route::post('update-slider/{slider}', 'update')->name('update_slider');
        Route::get('delete-slider/{slider}', 'destroy')->name('delete_slider');
    });
    Route::controller(BannerController::class)->group(function () {
        Route::get('all-banner', 'index')->name('all_banner');
        Route::get('add-banner', 'create')->name('add_banner');
        Route::post('store-banner', 'store')->name('store_banner');
        Route::get('edit-banner/{banner}', 'edit')->name('edit_banner');
        Route::post('update-banner/{banner}', 'update')->name('update_banner');
        Route::get('delete-banner/{banner}', 'destroy')->name('delete_banner');
    });
});

Route::get('/admin/login', [AdminController::class, 'login'])->middleware('guest');

// Vendor Route

Route::middleware(['auth', 'role:vendor'])->prefix('vendor')->name('vendor.')->group(function () {
    Route::get('/dashboard', [VendorController::class, 'index'])->name('dashboard');
    Route::get('/profile', [VendorProfileController::class, 'index'])->name('profile');
    Route::post('/profile', [VendorProfileController::class, 'store'])->name('profile.store');
    Route::get('/profile/change-password', [VendorProfileController::class, 'editPassword'])->name('change_password');
    Route::post('/profile/update-password', [VendorProfileController::class, 'updatePassword'])->name('update_password');

    Route::controller(VendorProductController::class)->group(function () {
        Route::get('/all-product', 'index')->name('all_product');
        Route::get('/add-product', 'create')->name('add_product');
        Route::post('/store-product', 'store')->name('store_product');
        Route::get('/delete-product/{product}', 'destroy')->name('delete_product');
    });
});
Route::get('/vendor/login', [VendorController::class, 'login'])->middleware('guest');


// Frontend User Route
Route::middleware(['auth'])->name('user.')->group(function () {
    Route::get('/dashboard', [UserController::class, 'index'])->name('dashboard');
    Route::post('/user-update', [UserController::class, 'store'])->name('profile.store');
});



Route::get('/ajax-carts', [CartController::class, 'get_carts_data']);
Route::get('/cart', [CartController::class, 'view_cart'])->name('cart');
Route::get('/add-to-cart/{id}', [CartController::class, 'add_to_cart']);
Route::get('/remove-from-cart/{id}', [CartController::class, 'remove_from_cart']);
Route::get('/vendor-list', [HomeController::class, 'vendor_list'])->name('vendor_list');
Route::get('/category/{category}', [HomeController::class, 'product_by_category'])->name('product_by_category');
Route::get('/{vendor}', [HomeController::class, 'vendor_details'])->name('vendor_details');
Route::get('/{product}/{slug}', [FrontendProductController::class, 'product_details'])->name('product_details');
