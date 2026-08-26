<?php

namespace App\Http\Controllers\Api;

use App\Models\Product;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ProductController
{
    public const UNAUTHORIZED_STATUS_TEXT = 'Resource not accessible';
    public const IS_IN_STOCK = 1;
    public const DEFAULT_PAGE_SIZE = 10;

    /**
     * List Products
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function index(Request $request): JsonResponse
    {
        $inStock = $request->input('in_stock', self::IS_IN_STOCK);
        $pageSize = $request->input('pageSize', self::DEFAULT_PAGE_SIZE);

        $comparisonOperator = $inStock ? '>' : '=';

        $productsCol = Product::all();

        $products = Product::where('stock_quantity', $comparisonOperator, 0)
                            ->paginate($pageSize)
                            ->items();

        if (!count($products)) {
            return response()->json(
                ['success' => false, 'message' => 'No products available'],
                JsonResponse::HTTP_NOT_FOUND
            );
        }

        return response()->json(
            ["Total Products" => $productsCol->count(), "Limit" => $request->input('pageSize'), $products],
        );
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return response()->json(
            ['success' => false, 'message' => self::UNAUTHORIZED_STATUS_TEXT],
            JsonResponse::HTTP_UNAUTHORIZED
        );
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        return response()->json(
            ['success' => false, 'message' => self::UNAUTHORIZED_STATUS_TEXT],
            JsonResponse::HTTP_UNAUTHORIZED
        );
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return response()->json(
            ['success' => false, 'message' => self::UNAUTHORIZED_STATUS_TEXT],
            JsonResponse::HTTP_UNAUTHORIZED
        );
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        return response()->json(
            ['success' => false, 'message' => self::UNAUTHORIZED_STATUS_TEXT],
            JsonResponse::HTTP_UNAUTHORIZED
        );
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        return response()->json(
            ['success' => false, 'message' => self::UNAUTHORIZED_STATUS_TEXT],
            JsonResponse::HTTP_UNAUTHORIZED
        );
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        return response()->json(
            ['success' => false, 'message' => self::UNAUTHORIZED_STATUS_TEXT],
            JsonResponse::HTTP_UNAUTHORIZED
        );
    }
}
