<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\OrderPostRequest;
use App\Models\Order;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class OrderController
{
    public const UNAUTHORIZED_STATUS_TEXT = 'Resource not accessible';

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return response()->json(
            ['success' => false, 'message' => self::UNAUTHORIZED_STATUS_TEXT],
            JsonResponse::HTTP_UNAUTHORIZED
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
     * Create Order
     *
     * @param OrderPostRequest $request
     * @return JsonResponse
     */
    public function store(OrderPostRequest $request): JsonResponse
    {
        return Order::isProductAvailableToPurchase($request);
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
