<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\LoginController;
use App\Http\Controllers\Admin\ConfirmPasswordController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\Admin\CustomerController;
use App\Http\Controllers\Admin\ReportController;

Route::group(['prefix' => 'admin'], function() {

  Route::middleware('guest:admin')->group(function() {
    Route::get('login', [LoginController::class, 'showLoginForm'])->name('admin.login');
    Route::post('login', [LoginController::class, 'login']);
  });


  Route::middleware('auth:admin')->group(function() {

    Route::get('/confirm-password', [ConfirmPasswordController::class, 'showConfirmPasswordForm'])->name('password.confirm');
    Route::post('/confirm-password', [ConfirmPasswordController::class, 'confirmPassword'])->middleware('throttle:6,1');

    Route::get('/logout', [LoginController::class, 'logout'])->name('admin.logout');

    Route::get('/', [DashboardController::class, 'index'])->name('admin.home');

    Route::get('/categories', [CategoryController::class, 'index'])->name('admin.categories.index');
    Route::get('/categories/create', [CategoryController::class, 'showCreateForm'])->name('admin.categories.create');
    Route::post('/categories/create', [CategoryController::class, 'create']);
    Route::get('/categories/{category}', [CategoryController::class, 'show'])->name('admin.categories.show');
    Route::put('/categories/{category}', [CategoryController::class, 'edit'])->name('admin.categories.edit');
    Route::delete('/categories/{category}', [CategoryController::class, 'delete'])->name('admin.categories.delete');
    Route::patch('/categories/{category}/featured', [CategoryController::class, 'toggleIsFeatured'])->name('admin.categories.featured');

    Route::get('/products', [ProductController::class, 'index'])->name('admin.products.index');
    Route::get('/products/create', [ProductController::class, 'showCreateForm'])->name('admin.products.create');
    Route::post('/products/create', [ProductController::class, 'create']);
    Route::get('/products/{product}', [ProductController::class, 'show'])->name('admin.products.show');
    Route::put('/products/{product}', [ProductController::class, 'edit'])->name('admin.products.edit');
    Route::delete('/products/{product}', [ProductController::class, 'delete'])->name('admin.products.delete');

    Route::get('/orders', [OrderController::class, 'index'])->name('admin.orders.index');
    Route::get('/orders/{order}', [OrderController::class, 'show'])->name('admin.orders.show');
    Route::patch('/orders/{order}/cancel', [OrderController::class, 'cancel'])->name('admin.orders.cancel');
    Route::patch('/orders/{order}/ship', [OrderController::class, 'ship'])->name('admin.orders.ship');
    Route::patch('/orders/{order}/deliver', [OrderController::class, 'deliver'])->name('admin.orders.deliver');
    Route::patch('/orders/{order}/complete', [OrderController::class, 'complete'])->name('admin.orders.complete');

    Route::get('/customers', [CustomerController::class, 'index'])->name('admin.customers.index');
    Route::get('/customers/{user}/profile', [CustomerController::class, 'profile'])->name('admin.customers.profile');
    Route::get('/customers/{user}/orders', [CustomerController::class, 'orders'])->name('admin.customers.orders');
    Route::get('/customers/{user}/favorites', [CustomerController::class, 'favorites'])->name('admin.customers.favorites');

    Route::get('/reports/sales', [ReportController::class, 'salesReport'])->name('admin.reports.sales');
    Route::get('/reports/stocks', [ReportController::class, 'stocksReport'])->name('admin.reports.stocks');
    Route::get('/reports/favorites', [ReportController::class, 'favoritesReport'])->name('admin.reports.favorites');

  });

});
