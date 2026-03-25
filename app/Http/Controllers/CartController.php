<?php

namespace App\Http\Controllers;

use App\Services\CartService;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function __construct(
        private CartService $cartService
    ) {}

    public function index()
    {
        $cart = $this->cartService->getCart();

        return view('front.cart.index', compact('cart'));
    }

    public function add(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'quantity' => 'nullable|integer|min:1|max:99',
            'variant_id' => 'nullable|exists:product_variants,id',
        ]);

        $this->cartService->add(
            (int) $request->product_id,
            (int) ($request->quantity ?? 1),
            $request->variant_id ? (int) $request->variant_id : null
        );

        if ($request->expectsJson()) {
            return response()->json(['success' => true, 'item_count' => $this->cartService->itemCount()]);
        }

        return back()->with('success', 'Ürün sepete eklendi.');
    }

    public function update(Request $request)
    {
        $request->validate([
            'cart_item_id' => 'required|integer',
            'quantity' => 'required|integer|min:1|max:99',
        ]);

        $this->cartService->update(
            (int) $request->cart_item_id,
            (int) $request->quantity
        );

        if ($request->expectsJson()) {
            return response()->json(['success' => true]);
        }

        return back()->with('success', 'Sepet güncellendi.');
    }

    public function remove(Request $request)
    {
        $request->validate([
            'cart_item_id' => 'required|integer',
        ]);

        $this->cartService->remove((int) $request->cart_item_id);

        if ($request->expectsJson()) {
            return response()->json(['success' => true]);
        }

        return back()->with('success', 'Ürün sepetten kaldırıldı.');
    }
}
