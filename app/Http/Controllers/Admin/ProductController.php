<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use App\Models\ProductImage;
use App\Models\ProductVariant;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::with('category')->orderBy('sort_order')->paginate(20);

        return view('admin.products.index', compact('products'));
    }

    public function create()
    {
        $categories = Category::orderBy('sort_order')->get();

        return view('admin.products.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'category_id' => 'required|exists:categories,id',
            'name' => 'required|string|max:255',
            'slug' => 'nullable|string|max:255|unique:products,slug',
            'sku' => 'required|string|max:100|unique:products,sku',
            'description' => 'nullable|string',
            'meta_title' => 'nullable|string|max:255',
            'meta_description' => 'nullable|string',
            'price' => 'required|numeric|min:0',
            'sale_price' => 'nullable|numeric|min:0',
            'stock' => 'required|integer|min:0',
            'is_active' => 'boolean',
            'is_featured' => 'boolean',
            'attributes' => 'nullable|array',
            'sort_order' => 'nullable|integer|min:0',
            'images' => 'nullable|array',
            'images.*' => 'image|max:2048',
        ]);

        $validated['slug'] = $validated['slug'] ?? Str::slug($validated['name']);
        $validated['is_active'] = $request->boolean('is_active', true);
        $validated['is_featured'] = $request->boolean('is_featured', false);
        $validated['sort_order'] = $validated['sort_order'] ?? 0;

        $product = Product::create($validated);

        if ($request->hasFile('images')) {
            $sortOrder = 0;
            foreach ($request->file('images') as $file) {
                $filename = time() . '_' . uniqid() . '_' . $file->getClientOriginalName();
                $path = 'uploads/products';
                $file->move(public_path($path), $filename);
                ProductImage::create([
                    'product_id' => $product->id,
                    'path' => $path . '/' . $filename,
                    'sort_order' => $sortOrder++,
                    'is_primary' => $sortOrder === 1,
                ]);
            }
        }

        $this->saveVariants($product, $request->input('variants', []));

        return redirect()->route('admin.products.index')->with('success', 'Ürün oluşturuldu.');
    }

    public function show(Product $product)
    {
        $product->load(['category', 'images', 'variants']);

        return view('admin.products.show', compact('product'));
    }

    public function edit(Product $product)
    {
        $product->load(['images', 'variants']);
        $categories = Category::orderBy('sort_order')->get();

        return view('admin.products.edit', compact('product', 'categories'));
    }

    public function update(Request $request, Product $product)
    {
        $validated = $request->validate([
            'category_id' => 'required|exists:categories,id',
            'name' => 'required|string|max:255',
            'slug' => 'nullable|string|max:255|unique:products,slug,' . $product->id,
            'sku' => 'required|string|max:100|unique:products,sku,' . $product->id,
            'description' => 'nullable|string',
            'meta_title' => 'nullable|string|max:255',
            'meta_description' => 'nullable|string',
            'price' => 'required|numeric|min:0',
            'sale_price' => 'nullable|numeric|min:0',
            'stock' => 'required|integer|min:0',
            'is_active' => 'boolean',
            'is_featured' => 'boolean',
            'attributes' => 'nullable|array',
            'sort_order' => 'nullable|integer|min:0',
            'images' => 'nullable|array',
            'images.*' => 'image|max:2048',
        ]);

        $validated['is_active'] = $request->boolean('is_active', true);
        $validated['is_featured'] = $request->boolean('is_featured', false);

        $product->update($validated);

        if ($request->hasFile('images')) {
            $maxSort = $product->images()->max('sort_order') ?? -1;
            foreach ($request->file('images') as $file) {
                $filename = time() . '_' . uniqid() . '_' . $file->getClientOriginalName();
                $path = 'uploads/products';
                $file->move(public_path($path), $filename);
                ProductImage::create([
                    'product_id' => $product->id,
                    'path' => $path . '/' . $filename,
                    'sort_order' => ++$maxSort,
                    'is_primary' => $product->images()->count() === 0 && $maxSort === 0,
                ]);
            }
        }

        $this->saveVariants($product, $request->input('variants', []));

        return redirect()->route('admin.products.index')->with('success', 'Ürün güncellendi.');
    }

    public function destroy(Product $product)
    {
        $product->delete();

        return redirect()->route('admin.products.index')->with('success', 'Ürün silindi.');
    }

    private function saveVariants(Product $product, array $variantsInput): void
    {
        $validIds = [];
        $sortOrder = 0;

        foreach ($variantsInput as $v) {
            $name = trim($v['name'] ?? '');
            if ($name === '') {
                continue;
            }

            $data = [
                'name' => $name,
                'sku' => $v['sku'] ?? null,
                'price' => (float) ($v['price'] ?? 0),
                'sale_price' => !empty($v['sale_price']) ? (float) $v['sale_price'] : null,
                'stock' => (int) ($v['stock'] ?? 0),
                'sort_order' => $sortOrder++,
            ];

            $id = $v['id'] ?? null;
            if ($id && $product->variants()->where('id', $id)->exists()) {
                ProductVariant::where('id', $id)->update($data);
                $validIds[] = (int) $id;
            } else {
                $variant = $product->variants()->create($data);
                $validIds[] = $variant->id;
            }
        }

        if (!empty($validIds)) {
            $product->variants()->whereNotIn('id', $validIds)->delete();
        } else {
            $product->variants()->delete();
        }
    }
}
