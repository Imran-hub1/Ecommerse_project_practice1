<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\addToCartController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\SubCategoryController;
use App\Http\Controllers\BrandController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\OrderProcessing;
use App\Http\Controllers\ProductOrderController;


use App\Http\Controllers\CustomerAddressController;


Route::get('/', [HomeController::class, 'home'])->name('home');
Route::get('/detail/{id}', [HomeController::class, 'detail'])->name('detail');
Route::post('/addToCart', [addToCartController::class, 'addToCart'])->name('add.to.cart');
Route::get('/cart-index', [addToCartController::class, 'cart'])->name('cart');
Route::get('/processToCheackout', [addToCartController::class, 'checkout'])->name('checkout');
Route::post('/update-cart', [addToCartController::class, 'updateCart'])->name('update.cart');
Route::get('/processtocheckout', [CheckoutController::class, 'checkout'])->name('process.checkout');
Route::get('/confirm-order', [OrderProcessing::class, 'order'])->name('order');


Route::post('/customer-address', [CustomerAddressController::class, 'customerProcess'])->name('customerProcess');
Route::get('/order-success/{id}', [CustomerAddressController::class, 'orderSuccess'])->name('ordersuccess');


Route::post('/remove-cart-item', [addToCartController::class, 'removeCart'])->name('cart.remove');


Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', [AdminController::class, 'admin'])->name('admin');
    Route::get('/category', [CategoryController::class, 'category'])->name('category');
    Route::get('/category-index', [CategoryController::class, 'index'])->name('index');
    Route::post('/categoryProcess', [CategoryController::class, 'categoryprocess'])->name('categoryprocess');
    Route::get('/edit/{id}', [CategoryController::class, 'edit'])->name('edit');
    Route::post('/update/{id}', [CategoryController::class, 'update'])->name('category.update');
    Route::delete('/delete/{id}', [CategoryController::class, 'delete'])->name('category.delete');

    Route::get('/subcategory', [SubCategoryController::class, 'subcategory'])->name('subcategory');
    Route::post('/subcategorypost', [SubCategoryController::class, 'create'])->name('subcategory.create');
    Route::get('/manage', [SubCategoryController::class, 'index'])->name('subcategory.manage');
    Route::get('/subcategory-edit/{id}', [SubCategoryController::class, 'edit'])->name('subcategory.edit');
    Route::post('/subcategory-update/{id}', [SubCategoryController::class, 'update'])->name('subcategory.update');
    Route::delete('/admin/subcategory/delete/{id}', [SubCategoryController::class, 'destroy'])->name('subcategory.delete');

    Route::get('/brand', [BrandController::class, 'brand'])->name('brand');
    Route::post('/brandProcess', [BrandController::class, 'create'])->name('brand.create');
    Route::get('/brand/manage', [BrandController::class, 'manage'])->name('brand.manage');
    Route::get('/brand/edit/{id}', [BrandController::class, 'edit'])->name('brand.edit');
    Route::post('/brand/update/{id}', [BrandController::class, 'update'])->name('brand.update');
    Route::delete('/admin/brand/delete/{id}', [BrandController::class, 'delete'])->name('brand.delete');

    Route::get('/product', [ProductController::class, 'product'])->name('product');
    Route::post('/productProcess', [ProductController::class, 'store'])->name('product.store');
    Route::get('/product/manage', [ProductController::class, 'manage'])->name('product.manage');
    Route::get('/product/edit/{id}', [ProductController::class, 'edit'])->name('product.edit');
    Route::post('/product/update/{id}', [ProductController::class, 'update'])->name('product.update');
    Route::get('/product-order', [ProductOrderController::class, 'orderProcess'])->name('product.order');


    // Route::delete('/product/delete/{id}', [ProductController::class, 'destroy'])->name('product.delete');
});
