<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;

class HomeController extends Controller
{
    public function index()
    {
        $products = Product::where('is_active', true)
            ->with(['category', 'images', 'variants'])
            ->orderBy('sort_order')
            ->limit(10)
            ->get();

        $categories = Category::where('is_active', true)
            ->whereNull('parent_id')
            ->with('children')
            ->withCount('products')
            ->orderBy('sort_order')
            ->get();

        $featured = Product::where('is_active', true)
            ->where('is_featured', true)
            ->with(['category', 'images', 'variants'])
            ->orderBy('sort_order')
            ->limit(8)
            ->get();

        return view('front.home', compact('products', 'categories', 'featured'));
    }
}
