<?php

use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;

Route::get('/', function () {
    return view('welcome');
});

/**
 * List product by id
 *
 * @route GET /products/{id}. Test URL: http://127.0.0.1:8000/products?id=201
 */
Route::get('/products/{id}', function (int $id) {
    return response("Product $id Found", 200);
});


/**
 * List all products
 *
 * @api route GET /products AND FILTER BY "in_stock" attribute. Test URL:
 * http://127.0.0.1:8000/products?in_stock=1
 */
//Route::get('/products', function (Request $request) {
//    // Default "in_stock" attribute value
//    $request->input('in_stock', 0);
//    return response()->json(['error' => 'Products Not Found'], 404);
//});

Route::get('/products', [ProductController::class, 'index'])->name('products.list');


Route::get('/test', function (Request $request) {
    return [
        "method" => $request->method(),
        "url" => $request->url(),
        "path" => $request->path(),
        "fullUrl" => $request->fullUrl(),
        "ip" => $request->ip(),
        "userAgent" => $request->userAgent(),
        "header" => $request->header(),
    ];
});
