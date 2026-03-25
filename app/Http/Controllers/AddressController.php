<?php

namespace App\Http\Controllers;

use App\Models\Address;
use Illuminate\Http\Request;

class AddressController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $addresses = auth()->user()->addresses()->orderBy('is_default', 'desc')->get();

        return view('front.account.addresses.index', compact('addresses'));
    }

    public function create()
    {
        return view('front.account.addresses.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:50',
            'full_name' => 'required|string|max:255',
            'phone' => 'required|string|max:20',
            'city' => 'required|string|max:100',
            'district' => 'required|string|max:100',
            'address' => 'required|string',
            'postal_code' => 'nullable|string|max:10',
            'is_default' => 'boolean',
        ]);

        $validated['user_id'] = auth()->id();
        $validated['is_default'] = $request->boolean('is_default', false);

        if ($validated['is_default']) {
            auth()->user()->addresses()->update(['is_default' => false]);
        }

        Address::create($validated);

        return redirect()->route('account.addresses.index')->with('success', 'Adres eklendi.');
    }

    public function edit(Address $address)
    {
        if ($address->user_id !== auth()->id()) {
            abort(403);
        }

        return view('front.account.addresses.edit', compact('address'));
    }

    public function update(Request $request, Address $address)
    {
        if ($address->user_id !== auth()->id()) {
            abort(403);
        }

        $validated = $request->validate([
            'title' => 'required|string|max:50',
            'full_name' => 'required|string|max:255',
            'phone' => 'required|string|max:20',
            'city' => 'required|string|max:100',
            'district' => 'required|string|max:100',
            'address' => 'required|string',
            'postal_code' => 'nullable|string|max:10',
            'is_default' => 'boolean',
        ]);

        $validated['is_default'] = $request->boolean('is_default', false);

        if ($validated['is_default']) {
            auth()->user()->addresses()->where('id', '!=', $address->id)->update(['is_default' => false]);
        }

        $address->update($validated);

        return redirect()->route('account.addresses.index')->with('success', 'Adres güncellendi.');
    }

    public function destroy(Address $address)
    {
        if ($address->user_id !== auth()->id()) {
            abort(403);
        }

        $address->delete();

        return redirect()->route('account.addresses.index')->with('success', 'Adres silindi.');
    }
}
