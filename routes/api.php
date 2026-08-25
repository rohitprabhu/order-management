<?php

use App\Http\Controllers\Api\OrderController;
use App\Http\Controllers\Api\ProductController;
use App\Http\Middleware\AuthenticateRequest;
use Illuminate\Support\Facades\Route;

/**
 * List products
 *
 * @api route GET /api/products. Test URL: http://127.0.0.1:8000/api/products?pageSize=10&in_stock=1
 */
Route::apiResource('products', ProductController::class)->middleware(AuthenticateRequest::class);

/**
 * Create order
 *
 * @api route POST /api/orders. Test URL: http://127.0.0.1:8000/api/orders
 */
Route::apiResource('orders', OrderController::class)->middleware(AuthenticateRequest::class);

