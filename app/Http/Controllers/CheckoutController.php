<?php

namespace App\Http\Controllers;

use App\Mail\OrderConfirmationMail;
use App\Models\Address;
use App\Models\Coupon;
use App\Models\Order;
use App\Models\OrderItem;
use App\Services\CartService;
use App\Services\ShippingService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class CheckoutController extends Controller
{
    public function __construct(
        private CartService $cartService,
        private ShippingService $shippingService
    ) {
        $this->middleware('auth');
    }

    public function index()
    {
        $cart = $this->cartService->getCart();
        $addresses = auth()->user()->addresses()->orderBy('is_default', 'desc')->get();

        if ($cart->items->isEmpty()) {
            return redirect()->route('cart.index')->with('error', 'Sepetiniz boş.');
        }

        $subtotal = $cart->subtotal;
        $shippingCost = $this->shippingService->calculate($subtotal, request('city', ''), request('district'));
        $discount = 0;
        $coupon = null;

        if ($cart->coupon_code) {
            $coupon = Coupon::where('code', $cart->coupon_code)->first();
            if ($coupon && $coupon->isValid($subtotal, auth()->id())) {
                $discount = $coupon->calculateDiscount($subtotal);
            }
        }

        $total = max(0, $subtotal - $discount + $shippingCost);

        return view('front.checkout.index', compact('cart', 'addresses', 'subtotal', 'shippingCost', 'discount', 'total', 'coupon'));
    }

    public function store(Request $request)
    {
        $cart = $this->cartService->getCart();

        if ($cart->items->isEmpty()) {
            return redirect()->route('cart.index')->with('error', 'Sepetiniz boş.');
        }

        $validated = $request->validate([
            'address_id' => 'nullable|exists:addresses,id',
            'full_name' => 'required|string|max:255',
            'phone' => 'required|string|max:50',
            'email' => 'required|email',
            'city' => 'required|string|max:100',
            'district' => 'required|string|max:100',
            'address' => 'required|string',
            'postal_code' => 'nullable|string|max:20',
            'payment_method' => 'required|in:cash_on_delivery,credit_card,bank_transfer',
            'notes' => 'nullable|string|max:1000',
        ]);

        $subtotal = $cart->subtotal;
        $shippingCost = $this->shippingService->calculate($subtotal, $validated['city'], $validated['district']);
        $discount = 0;
        $couponCode = null;

        if ($cart->coupon_code) {
            $coupon = Coupon::where('code', $cart->coupon_code)->first();
            if ($coupon && $coupon->isValid($subtotal, auth()->id())) {
                $discount = $coupon->calculateDiscount($subtotal);
                $couponCode = $coupon->code;
            }
        }

        $total = max(0, $subtotal - $discount + $shippingCost);

        $order = Order::create([
            'order_number' => Order::generateOrderNumber(),
            'user_id' => auth()->id(),
            'address_id' => $validated['address_id'] ?? null,
            'status' => Order::STATUS_PENDING,
            'full_name' => $validated['full_name'],
            'phone' => $validated['phone'],
            'email' => $validated['email'],
            'city' => $validated['city'],
            'district' => $validated['district'],
            'address' => $validated['address'],
            'postal_code' => $validated['postal_code'] ?? null,
            'subtotal' => $subtotal,
            'discount' => $discount,
            'shipping_cost' => $shippingCost,
            'tax' => 0,
            'total' => $total,
            'coupon_code' => $couponCode,
            'notes' => $validated['notes'] ?? null,
            'payment_method' => $validated['payment_method'],
            'payment_status' => 'pending',
        ]);

        foreach ($cart->items as $item) {
            $variant = $item->productVariant;
            $product = $item->product;
            OrderItem::create([
                'order_id' => $order->id,
                'product_id' => $item->product_id,
                'product_variant_id' => $item->product_variant_id,
                'product_name' => $product->name,
                'variant_name' => $variant?->name,
                'sku' => $variant?->sku ?? $product->sku,
                'quantity' => $item->quantity,
                'price' => $item->price,
                'total' => $item->quantity * $item->price,
            ]);
        }

        if ($couponCode) {
            $coupon = Coupon::where('code', $couponCode)->first();
            \App\Models\CouponUsage::create([
                'coupon_id' => $coupon->id,
                'user_id' => auth()->id(),
                'order_id' => $order->id,
                'discount_amount' => $discount,
            ]);
        }

        $this->cartService->clear();

        try {
            Mail::to($order->email)->send(new OrderConfirmationMail($order));
        } catch (\Exception $e) {
            \Log::warning('Sipariş onay e-postası gönderilemedi: ' . $e->getMessage());
        }

        return redirect()->route('account.index')->with('success', 'Siparişiniz alındı. Sipariş numaranız: ' . $order->order_number);
    }
}
