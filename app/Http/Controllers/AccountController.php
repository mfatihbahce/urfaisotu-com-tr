<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;

class AccountController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $user = auth()->user();
        $orders = $user->orders()->with('items.product')->latest()->take(5)->get();
        $favoritesCount = $user->favorites()->count();
        $totalOrders = $user->orders()->count();
        $pendingOrders = $user->orders()->whereIn('status', [Order::STATUS_PENDING, Order::STATUS_PAID, Order::STATUS_PREPARING, Order::STATUS_SHIPPED])->count();
        $completedOrders = $user->orders()->where('status', Order::STATUS_DELIVERED)->count();

        return view('front.account.dashboard', compact(
            'orders', 'favoritesCount', 'totalOrders', 'pendingOrders', 'completedOrders'
        ));
    }

    public function ordersIndex()
    {
        $orders = auth()->user()->orders()->with('items.product')->latest()->paginate(10);

        return view('front.account.orders.index', compact('orders'));
    }

    public function orderShow($order)
    {
        $order = auth()->user()->orders()->with(['items.product', 'items.productVariant'])->findOrFail($order);

        return view('front.account.orders.show', compact('order'));
    }

    public function favoritesIndex()
    {
        $favorites = auth()->user()->favorites()->with(['category', 'images', 'variants'])->get();

        return view('front.account.favorites.index', compact('favorites'));
    }

    public function profile(Request $request)
    {
        return view('front.account.profile', ['user' => $request->user()]);
    }

    public function profileUpdate(ProfileUpdateRequest $request)
    {
        $request->user()->fill($request->validated());

        if ($request->user()->isDirty('email')) {
            $request->user()->email_verified_at = null;
        }

        $request->user()->save();

        return redirect()->route('account.profile')->with('success', 'Hesap bilgileri güncellendi.');
    }

    public function password(Request $request)
    {
        return view('front.account.password');
    }

    public function passwordUpdate(Request $request)
    {
        $request->validate([
            'current_password' => ['required', 'current_password'],
            'password' => ['required', 'confirmed', Password::defaults()],
        ]);

        $request->user()->update([
            'password' => Hash::make($request->password),
        ]);

        return redirect()->route('account.password')->with('success', 'Şifre güncellendi.');
    }
}
