<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\ShoppingCart;
use App\Models\ShoppingCartItem;
use App\Models\Product; // Import Product model
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class CartController extends BaseController
{
    /**
     * Sync frontend cart with backend database.
     */
    /**
     * Sync frontend cart with backend database.
     * 
     * @authenticated
     */
    public function sync(Request $request)
    {
        \Log::info('Cart Sync Payload:', $request->all());

        try {
            $request->validate([
                'items' => 'required|array',
                'items.*.product.id' => 'required|integer|exists:products,id',
                'items.*.quantity' => 'required|integer|min:1',
                'items.*.platform' => 'nullable', // Relaxed to nullable for now
            ]);
        } catch (\Illuminate\Validation\ValidationException $e) {
            \Log::error('Cart Sync Validation Error:', $e->errors());
            return $this->sendError('Validation Error', $e->errors(), 422);
        }

        $user = $request->user();
        $items = $request->items;

        DB::beginTransaction();
        try {
            // Get or create active cart
            $cart = ShoppingCart::firstOrCreate(
                ['user_id' => $user->id, 'status' => 'active']
            );

            // Clear existing items (simple sync strategy: replace all)
            $cart->items()->delete();

            foreach ($items as $item) {
                // Calculate price from DB to be safe, or trust frontend? 
                // Better to trust frontend logic for offers for now OR re-calculate.
                // But frontend sends 'final_price'.
                // Let's re-verify product price from DB to prevent tampering.

                $product = Product::find($item['product']['id']);
                if (!$product)
                    continue;

                $price = $product->price;
                // Calculate offer
                if ($product->is_offer && $product->offer_percentage > 0) {
                    $price = $price * (1 - ($product->offer_percentage / 100));
                }

                ShoppingCartItem::create([
                    'shopping_cart_id' => $cart->id,
                    'product_id' => $product->id,
                    'quantity' => $item['quantity'],
                    // Store platform_id if we have a way to resolve it, 
                    // or storing platform name? 
                    // The Item model probably needs platform_id.
                    // Let's check ShoppingCartItem model fields.
                    // Assuming 'platform_id' exists based on CheckoutController using 'items.platform'
                    'platform_id' => isset($item['platform']['id']) ? $item['platform']['id'] : null,
                    'unit_price' => $price,
                    'line_total' => $price * $item['quantity'],
                ]);
            }

            DB::commit();
            return $this->sendResponse([], 'Cart synced successfully');

        } catch (\Exception $e) {
            DB::rollBack();
            return $this->sendError('Error syncing cart', ['error' => $e->getMessage()], 500);
        }
    }
}
