<?php

namespace App\Http\Controllers;

use App\Models\Category;

class CategoryController extends Controller
{
    public function show(string $slug)
    {
        $category = Category::where('slug', $slug)
            ->where('is_active', true)
            ->firstOrFail();

        $products = $category->products()
            ->where('is_active', true)
            ->with(['category', 'images', 'variants'])
            ->orderBy('sort_order')
            ->paginate(12);

        return view('front.categories.show', compact('category', 'products'));
    }
}
