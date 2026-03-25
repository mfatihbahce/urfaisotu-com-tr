<?php

namespace App\Services;

use App\Models\Cart;
use App\Models\CartItem;
use App\Models\Product;
use App\Models\ProductVariant;
use Illuminate\Support\Facades\DB;

class CartService
{
    public function getCart(): Cart
    {
        $sessionId = session()->getId();
        $userId = auth()->id();

        $cart = Cart::when($userId, fn ($q) => $q->where('user_id', $userId))
            ->when(!$userId, fn ($q) => $q->where('session_id', $sessionId))
            ->with('items.product', 'items.productVariant')
            ->first();

        if (!$cart) {
            $cart = Cart::create([
                'session_id' => $userId ? null : $sessionId,
                'user_id' => $userId,
            ]);
        }

        if ($userId && !$cart->user_id) {
            $cart->update(['user_id' => $userId, 'session_id' => null]);
        }

        return $cart;
    }

    public function add(int $productId, int $quantity = 1, ?int $variantId = null): Cart
    {
        $cart = $this->getCart();

        $product = Product::findOrFail($productId);
        $price = $product->effective_price;
        $variant = null;

        if ($variantId) {
            $variant = ProductVariant::where('product_id', $productId)->findOrFail($variantId);
            $price = $variant->effective_price;
        }

        $existing = $cart->items()->where('product_id', $productId)
            ->where('product_variant_id', $variantId)->first();

        if ($existing) {
            $existing->update(['quantity' => $existing->quantity + $quantity]);
        } else {
            $cart->items()->create([
                'product_id' => $productId,
                'product_variant_id' => $variantId,
                'quantity' => $quantity,
                'price' => $price,
            ]);
        }

        return $this->getCart();
    }

    public function update(int $cartItemId, int $quantity): void
    {
        $cart = $this->getCart();
        $item = $cart->items()->findOrFail($cartItemId);
        $item->update(['quantity' => max(1, $quantity)]);
    }

    public function remove(int $cartItemId): void
    {
        $cart = $this->getCart();
        $cart->items()->where('id', $cartItemId)->delete();
    }

    public function mergeGuestCart(): void
    {
        if (!auth()->check()) {
            return;
        }
        $sessionId = session()->getId();
        $guestCart = Cart::where('session_id', $sessionId)->whereNull('user_id')->first();
        if (!$guestCart) {
            return;
        }
        $userCart = $this->getCart();
        foreach ($guestCart->items as $item) {
            $existing = $userCart->items()->where('product_id', $item->product_id)
                ->where('product_variant_id', $item->product_variant_id)->first();
            if ($existing) {
                $existing->update(['quantity' => $existing->quantity + $item->quantity]);
            } else {
                $userCart->items()->create([
                    'product_id' => $item->product_id,
                    'product_variant_id' => $item->product_variant_id,
                    'quantity' => $item->quantity,
                    'price' => $item->price,
                ]);
            }
        }
        $guestCart->delete();
    }

    public function clear(): void
    {
        $this->getCart()->items()->delete();
    }

    public function itemCount(): int
    {
        return $this->getCart()->item_count;
    }
}
