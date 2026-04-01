<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    public function store(Request $request)
    {
        // Auto-seed products if they don't exist yet (e.g., user went straight to checkout in demo)
        if (\App\Models\Product::count() === 0) {
            app(\App\Http\Controllers\ProductController::class)->index();
        }

        $request->validate([
            'hotel_name' => 'required|string',
            'room_number' => 'nullable|string',
            'phone' => 'required|string',
            'delivery_date' => 'required|string',
            'delivery_time' => 'required|string',
            'payment_method' => 'required|string',
            'items' => 'required|array|min:1',
            'items.*.product_id' => 'required|integer',
            'items.*.quantity' => 'required|integer|min:1',
            'items.*.price' => 'required|numeric',
        ]);

        try {
            DB::beginTransaction();

            $totalAmount = 0;
            foreach ($request->items as $item) {
                $totalAmount += ($item['price'] * $item['quantity']);
            }

            $order = Order::create([
                'user_id' => $request->user()->id,
                'hotel_name' => $request->hotel_name,
                'room_number' => $request->room_number,
                'phone' => $request->phone,
                'delivery_date' => $request->delivery_date,
                'delivery_time' => $request->delivery_time,
                'total_amount' => $totalAmount,
                'payment_method' => $request->payment_method,
                'status' => 'Pending',
            ]);

            foreach ($request->items as $item) {
                // Ensure product exists to prevent foreign key exception
                // If it doesn't exist, we will quickly insert a dummy record with that ID.
                if (!\App\Models\Product::where('id', $item['product_id'])->exists()) {
                    \Illuminate\Support\Facades\DB::table('products')->insert([
                        'id' => $item['product_id'],
                        'name' => 'Demo Product (Restored)',
                        'description' => 'A restored item for the demo',
                        'price' => $item['price'],
                        'image' => 'https://via.placeholder.com/150',
                        'category' => 'Restored',
                        'stock' => 10,
                        'created_at' => now(),
                        'updated_at' => now(),
                    ]);
                }

                OrderItem::create([
                    'order_id' => $order->id,
                    'product_id' => $item['product_id'],
                    'quantity' => $item['quantity'],
                    'price' => $item['price'],
                ]);
            }

            DB::commit();

            return response()->json([
                'message' => 'Order placed successfully',
                'order' => $order->load('items')
            ], 201);
            
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json([
                'message' => 'Failed to place order',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function userOrders(Request $request)
    {
        $orders = Order::where('user_id', $request->user()->id)
            ->with(['items.product'])
            ->orderBy('created_at', 'desc')
            ->get();
            
        return response()->json($orders);
    }
}
