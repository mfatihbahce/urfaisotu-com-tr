@extends('admin.layout')

@section('page_title', 'Ürün Düzenle')

@section('content')
    <form action="{{ route('admin.products.update', $product) }}" method="post" enctype="multipart/form-data" class="w-full space-y-4">
        @csrf
        @method('PUT')
        <div class="bg-white rounded-2xl shadow-sm border border-cream p-6 space-y-4">
            <div>
                <label class="block text-sm font-medium mb-1">Mevcut Görseller</label>
                @if($product->images->isNotEmpty())
                    <div class="flex flex-wrap gap-3 mb-2">
                        @foreach($product->images as $img)
                            <div class="relative group">
                                <img src="{{ asset($img->path) }}" alt="{{ $img->alt }}" class="w-20 h-20 object-cover rounded-lg border border-slate-200">
                                @if($img->is_primary)<span class="absolute -top-1 -right-1 w-5 h-5 bg-primary-dark text-white text-xs rounded-full flex items-center justify-center">A</span>@endif
                            </div>
                        @endforeach
                    </div>
                @else
                    <p class="text-sm text-slate-500 mb-2">Henüz görsel yok.</p>
                @endif
            </div>
            <div>
                <label class="block text-sm font-medium mb-1">Yeni Görsel Ekle</label>
                <input type="file" name="images[]" multiple accept="image/*" class="w-full rounded-lg border border-slate-200 px-3 py-2 text-sm file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:bg-primary-dark/10 file:text-primary-dark file:font-medium hover:file:bg-primary-dark/20">
                <p class="text-xs text-slate-500 mt-1">Birden fazla görsel seçebilirsiniz. (max 2MB)</p>
                @error('images')<p class="text-red-600 text-sm mt-1">{{ $message }}</p>@enderror
                @error('images.*')<p class="text-red-600 text-sm mt-1">{{ $message }}</p>@enderror
            </div>
            <div>
                <label class="block text-sm font-medium mb-1">Kategori</label>
                <select name="category_id" required class="w-full rounded-lg border px-3 py-2">
                    @foreach($categories as $c)
                        <option value="{{ $c->id }}" {{ old('category_id', $product->category_id) == $c->id ? 'selected' : '' }}>{{ $c->name }}</option>
                    @endforeach
                </select>
            </div>
            <div>
                <label class="block text-sm font-medium mb-1">Ürün Adı *</label>
                <input type="text" name="name" value="{{ old('name', $product->name) }}" required class="w-full rounded-lg border px-3 py-2">
            </div>
            <div>
                <label class="block text-sm font-medium mb-1">Slug</label>
                <input type="text" name="slug" value="{{ old('slug', $product->slug) }}" class="w-full rounded-lg border px-3 py-2">
            </div>
            <div>
                <label class="block text-sm font-medium mb-1">SKU *</label>
                <input type="text" name="sku" value="{{ old('sku', $product->sku) }}" required class="w-full rounded-lg border px-3 py-2">
            </div>
            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm font-medium mb-1">Fiyat *</label>
                    <input type="number" name="price" step="0.01" value="{{ old('price', $product->price) }}" required class="w-full rounded-lg border px-3 py-2">
                </div>
                <div>
                    <label class="block text-sm font-medium mb-1">İndirimli Fiyat</label>
                    <input type="number" name="sale_price" step="0.01" value="{{ old('sale_price', $product->sale_price) }}" class="w-full rounded-lg border px-3 py-2">
                </div>
            </div>
            <div>
                <label class="block text-sm font-medium mb-1">Stok</label>
                <input type="number" name="stock" value="{{ old('stock', $product->stock) }}" class="w-full rounded-lg border px-3 py-2">
            </div>
            <div>
                <label class="block text-sm font-medium mb-1">Açıklama</label>
                <textarea name="description" rows="3" class="w-full rounded-lg border px-3 py-2">{{ old('description', $product->description) }}</textarea>
            </div>
            <div class="flex gap-4">
                <label class="flex items-center gap-2"><input type="checkbox" name="is_active" value="1" {{ old('is_active', $product->is_active) ? 'checked' : '' }}> Aktif</label>
                <label class="flex items-center gap-2"><input type="checkbox" name="is_featured" value="1" {{ old('is_featured', $product->is_featured) ? 'checked' : '' }}> Öne Çıkan</label>
            </div>

            <div class="border-t border-slate-200 pt-4 mt-4">
                <div class="flex items-center justify-between mb-2">
                    <label class="block text-sm font-medium">Ürün Seçenekleri (Örn: 100g, 250g, 1kg)</label>
                    <button type="button" onclick="addVariantRow()" class="text-sm px-3 py-1.5 bg-primary-dark text-white rounded-lg hover:bg-primary-dark/90">+ Seçenek Ekle</button>
                </div>
                <p class="text-xs text-slate-500 mb-3">Seçenek eklemezseniz ürün tek fiyatla satılır. Seçenek eklerseniz müşteri dropdown'dan seçim yapar.</p>
                <div id="variants-container" class="space-y-3">
                    @php $vIdx = 0; @endphp
                    @forelse($product->variants->sortBy('sort_order') as $v)
                        <div class="variant-row grid grid-cols-12 gap-2 items-end text-sm">
                            <input type="hidden" name="variants[{{ $vIdx }}][id]" value="{{ $v->id }}">
                            <div class="col-span-2"><input type="text" name="variants[{{ $vIdx }}][name]" value="{{ old("variants.{$vIdx}.name", $v->name) }}" placeholder="Ad (100g)" class="w-full rounded-lg border px-2 py-1.5 text-sm"></div>
                            <div class="col-span-2"><input type="text" name="variants[{{ $vIdx }}][sku]" value="{{ old("variants.{$vIdx}.sku", $v->sku) }}" placeholder="SKU" class="w-full rounded-lg border px-2 py-1.5 text-sm"></div>
                            <div class="col-span-2"><input type="number" name="variants[{{ $vIdx }}][price]" step="0.01" value="{{ old("variants.{$vIdx}.price", $v->price) }}" placeholder="Fiyat" class="w-full rounded-lg border px-2 py-1.5 text-sm"></div>
                            <div class="col-span-2"><input type="number" name="variants[{{ $vIdx }}][sale_price]" step="0.01" value="{{ old("variants.{$vIdx}.sale_price", $v->sale_price) }}" placeholder="İnd. Fiyat" class="w-full rounded-lg border px-2 py-1.5 text-sm"></div>
                            <div class="col-span-2"><input type="number" name="variants[{{ $vIdx }}][stock]" value="{{ old("variants.{$vIdx}.stock", $v->stock) }}" placeholder="Stok" class="w-full rounded-lg border px-2 py-1.5 text-sm"></div>
                            <div class="col-span-2"><button type="button" onclick="removeVariantRow(this)" class="text-red-600 hover:text-red-700 text-xs">Sil</button></div>
                        </div>
                        @php $vIdx++; @endphp
                    @empty
                        <div class="variant-row grid grid-cols-12 gap-2 items-end text-sm">
                            <div class="col-span-2"><input type="text" name="variants[0][name]" placeholder="Ad (100g)" class="w-full rounded-lg border px-2 py-1.5 text-sm"></div>
                            <div class="col-span-2"><input type="text" name="variants[0][sku]" placeholder="SKU" class="w-full rounded-lg border px-2 py-1.5 text-sm"></div>
                            <div class="col-span-2"><input type="number" name="variants[0][price]" step="0.01" placeholder="Fiyat" class="w-full rounded-lg border px-2 py-1.5 text-sm"></div>
                            <div class="col-span-2"><input type="number" name="variants[0][sale_price]" step="0.01" placeholder="İnd. Fiyat" class="w-full rounded-lg border px-2 py-1.5 text-sm"></div>
                            <div class="col-span-2"><input type="number" name="variants[0][stock]" value="0" placeholder="Stok" class="w-full rounded-lg border px-2 py-1.5 text-sm"></div>
                            <div class="col-span-2"><button type="button" onclick="removeVariantRow(this)" class="text-red-600 hover:text-red-700 text-xs">Sil</button></div>
                        </div>
                    @endforelse
                </div>
            </div>
        </div>
        <div class="flex gap-4">
            <button type="submit" class="px-6 py-2 bg-primary-dark text-white rounded-lg">Güncelle</button>
            <a href="{{ route('admin.products.index') }}" class="px-6 py-2 border rounded-lg">İptal</a>
        </div>
    </form>
    <script>
        let variantIndex = {{ $product->variants->count() }};
        function addVariantRow() {
            const tpl = `<div class="variant-row grid grid-cols-12 gap-2 items-end text-sm">
                <div class="col-span-2"><input type="text" name="variants[__i__][name]" placeholder="Ad (100g)" class="w-full rounded-lg border px-2 py-1.5 text-sm"></div>
                <div class="col-span-2"><input type="text" name="variants[__i__][sku]" placeholder="SKU" class="w-full rounded-lg border px-2 py-1.5 text-sm"></div>
                <div class="col-span-2"><input type="number" name="variants[__i__][price]" step="0.01" placeholder="Fiyat" class="w-full rounded-lg border px-2 py-1.5 text-sm"></div>
                <div class="col-span-2"><input type="number" name="variants[__i__][sale_price]" step="0.01" placeholder="İnd. Fiyat" class="w-full rounded-lg border px-2 py-1.5 text-sm"></div>
                <div class="col-span-2"><input type="number" name="variants[__i__][stock]" value="0" placeholder="Stok" class="w-full rounded-lg border px-2 py-1.5 text-sm"></div>
                <div class="col-span-2"><button type="button" onclick="removeVariantRow(this)" class="text-red-600 hover:text-red-700 text-xs">Sil</button></div>
            </div>`;
            document.getElementById('variants-container').insertAdjacentHTML('beforeend', tpl.replace(/__i__/g, variantIndex++));
        }
        function removeVariantRow(btn) {
            btn.closest('.variant-row').remove();
        }
    </script>
@endsection
