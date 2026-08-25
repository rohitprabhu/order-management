<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Http\Request;
use App\Enums\OrderStatus;

class Order extends Model
{
    protected $fillable = ['customer_email', 'total_amt', 'status'];

    protected $casts = [
        'status' => OrderStatus::class,
    ];

    /**
     * Check if product has enough stock to purchase
     *
     * @param Request $request
     * @return JsonResponse
     */
    public static function isProductAvailableToPurchase(Request $request): JsonResponse
    {
        $finalPrice = 0;
        $orderItemsData = [];

        foreach ($request->items as $item) {
            $productId = $item['productId'];
            $requestedQty = $item['quantity'];

            $orderItemsData[] = [
                'product_id'            => $productId,
                'product_qty_ordered'   => $requestedQty,
            ];

            $product = Product::find($productId);
            $finalPrice += $product->price;
        }

        $orderData = [
            'customer_email'    => $request->customerEmail,
            'total_amt'         => $finalPrice,
            'status'            => $request->status
        ];

        try {
            DB::transaction(function () use ($orderData, $orderItemsData) {
                // Create Order
                $order = Order::create($orderData);

                $orderItemsData = array_map(function ($item) use ($order) {
                    $item['order_id'] = $order->id;
                    return $item;
                }, $orderItemsData);

                // Create order items
                $orderItems = $order->orderItems()->createMany($orderItemsData);
                self::sendOrderEmail($order);
            });
        } catch (\Exception $e) {
            return response()->json(
                ['success' => false, 'message' => 'Failed to create order entries : ' .  $e->getMessage()],
                JsonResponse::HTTP_INTERNAL_SERVER_ERROR
            );
        }

        self::deductQty($orderItemsData);

        return response()->json(
            ['success' => true, 'message' => 'Order created successfully'],
            JsonResponse::HTTP_OK
        );
    }

    /**
     * @return HasMany
     */
    public function orderItems(): HasMany
    {
        return $this->hasMany(OrderItem::class);
    }

    /**
     * @return BelongsToMany
     */
    public function products(): BelongsToMany
    {
        return $this->belongsToMany(Product::class);
    }

    /**
     * Decrement stock qty after order purchase
     *
     * @param $orderItemsData
     * @return void
     */
    private static function deductQty($orderItemsData): void
    {
        foreach ($orderItemsData as $key => $value) {
            Product::find($value['product_id'])->decrement('stock_quantity', $value['product_qty_ordered']);
        }
    }

    /**
     * Send order email
     *
     * @param Order $order
     * @return void
     */
    private static function sendOrderEmail(Order $order): void
    {
        Log::info("Email sent for order no. {$order->id}");
    }
}
