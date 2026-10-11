<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreOrderRequest;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;

class OrderController extends Controller
{
    public function index(): JsonResponse
    {
        $orders = Order::where('user_id', Auth::guard('api')->id())
            ->withCount('items')
            ->latest()
            ->paginate(10);

        return response()->json($orders);
    }

    public function store(StoreOrderRequest $request): JsonResponse
    {
        $items = collect($request->validated('items'));

        $order = DB::transaction(function () use ($items) {
            // Kunci baris produk selama transaksi supaya pengecekan stok konsisten
            $products = Product::whereIn('id', $items->pluck('product_id'))
                ->lockForUpdate()
                ->get()
                ->keyBy('id');

            $errors = [];
            foreach ($items as $index => $item) {
                $product = $products[$item['product_id']];

                if ($product->stock < $item['quantity']) {
                    $errors["items.$index.quantity"] =
                        "Stok {$product->name} tidak mencukupi (tersisa {$product->stock}).";
                }
            }

            if ($errors) {
                throw ValidationException::withMessages($errors);
            }

            $order = Order::create([
                'user_id' => Auth::guard('api')->id(),
                'status' => 'pending',
                'total_price' => 0,
            ]);

            $total = 0;
            foreach ($items as $item) {
                $product = $products[$item['product_id']];

                $order->items()->create([
                    'product_id' => $product->id,
                    'quantity' => $item['quantity'],
                    'price_at_purchase' => $product->price,
                ]);

                $total += $product->price * $item['quantity'];
            }

            $order->update(['total_price' => $total]);

            return $order;
        });

        return response()->json($order->load('items.product'), 201);
    }

    public function show(Order $order): JsonResponse
    {
        if ($order->user_id !== Auth::guard('api')->id()) {
            return response()->json(['message' => 'Forbidden'], 403);
        }

        return response()->json($order->load('items.product', 'invoice'));
    }
}