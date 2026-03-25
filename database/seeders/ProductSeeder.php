<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Product;
use App\Models\ProductImage;
use App\Models\ProductVariant;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        $categories = Category::pluck('id', 'slug');

        $products = [
            [
                'name' => 'Urfa Pul Biber',
                'slug' => 'urfa-pul-biber',
                'category_slug' => 'pul-biber',
                'price' => 149.90,
                'sale_price' => 119.90,
                'sku' => 'PB-001',
                'description' => 'Güneydoğu Anadolu\'nun eşsiz lezzeti. Düşük ısıda kurutulmuş, özel aromalı Urfa pul biber.',
                'is_featured' => true,
                'variants' => [
                    ['name' => '100g', 'price' => 49.90, 'sale_price' => 39.90],
                    ['name' => '250g', 'price' => 99.90, 'sale_price' => 79.90],
                    ['name' => '500g', 'price' => 179.90, 'sale_price' => 149.90],
                    ['name' => '1kg', 'price' => 299.90],
                ],
            ],
            [
                'name' => 'Antep Pul Biber',
                'slug' => 'antep-pul-biber',
                'category_slug' => 'pul-biber',
                'price' => 129.90,
                'sku' => 'PB-002',
                'description' => 'Acılığı ile ünlü Antep pul biberi. Kebap ve et yemeklerine mükemmel eşlik eder.',
                'is_featured' => true,
                'variants' => [
                    ['name' => '100g', 'price' => 44.90],
                    ['name' => '250g', 'price' => 94.90],
                    ['name' => '500g', 'price' => 164.90],
                ],
            ],
            [
                'name' => 'Kimyon',
                'slug' => 'kimyon',
                'category_slug' => 'toz-baharatlar',
                'price' => 39.90,
                'sku' => 'TB-001',
                'description' => 'Öğütülmüş kimyon. Köfte, kıyma ve et yemeklerinin vazgeçilmezi.',
                'variants' => [
                    ['name' => '50g', 'price' => 24.90],
                    ['name' => '100g', 'price' => 39.90],
                    ['name' => '250g', 'price' => 84.90],
                ],
            ],
            [
                'name' => 'Sumak',
                'slug' => 'sumak',
                'category_slug' => 'toz-baharatlar',
                'price' => 59.90,
                'sale_price' => 49.90,
                'sku' => 'TB-002',
                'description' => 'Ekşi ve hafif aromalı sumak. Salatalara ve soğan salatasına lezzet katar.',
                'is_featured' => true,
                'variants' => [
                    ['name' => '100g', 'price' => 59.90, 'sale_price' => 49.90],
                    ['name' => '250g', 'price' => 124.90],
                ],
            ],
            [
                'name' => 'Karabiber Tane',
                'slug' => 'karabiber-tane',
                'category_slug' => 'tane-baharatlar',
                'price' => 89.90,
                'sku' => 'TB-003',
                'description' => 'Tellicherry karabiber taneleri. Taze öğütüldüğünde en iyi aromasını verir.',
                'variants' => [
                    ['name' => '100g', 'price' => 89.90],
                    ['name' => '250g', 'price' => 189.90],
                ],
            ],
            [
                'name' => 'Köfte Baharatı',
                'slug' => 'kofte-baharati',
                'category_slug' => 'karisimlar',
                'price' => 49.90,
                'sale_price' => 39.90,
                'sku' => 'KB-001',
                'description' => 'Özel karışım köfte baharatı. Ev yapımı köftelere profesyonel lezzet.',
                'is_featured' => true,
                'variants' => [
                    ['name' => '75g', 'price' => 49.90, 'sale_price' => 39.90],
                    ['name' => '150g', 'price' => 84.90],
                ],
            ],
            // 10 ek ürün
            [
                'name' => 'Tatlı Kırmızı Biber',
                'slug' => 'tatli-kirmizi-biber',
                'category_slug' => 'pul-biber',
                'price' => 89.90,
                'sale_price' => 74.90,
                'sku' => 'PB-003',
                'description' => 'Hafif tatlı ve aromalı kırmızı pul biber. Salatalara ve mezeye ideal.',
                'is_featured' => true,
                'variants' => [
                    ['name' => '100g', 'price' => 39.90],
                    ['name' => '250g', 'price' => 89.90, 'sale_price' => 74.90],
                ],
            ],
            [
                'name' => 'Kekik',
                'slug' => 'kekik',
                'category_slug' => 'toz-baharatlar',
                'price' => 44.90,
                'sku' => 'TB-004',
                'description' => 'Dağ kekiği. Pizza, et ve sebze yemeklerinde kullanılır.',
                'variants' => [
                    ['name' => '50g', 'price' => 24.90],
                    ['name' => '100g', 'price' => 44.90],
                ],
            ],
            [
                'name' => 'Kuru Nane',
                'slug' => 'kuru-nane',
                'category_slug' => 'toz-baharatlar',
                'price' => 34.90,
                'sku' => 'TB-005',
                'description' => 'Öğütülmüş kuru nane. Yoğurtlu mezelerin ve çorbaların vazgeçilmezi.',
                'variants' => [
                    ['name' => '50g', 'price' => 19.90],
                    ['name' => '100g', 'price' => 34.90],
                ],
            ],
            [
                'name' => 'Kırmızı Biber Tane',
                'slug' => 'kirmizi-biber-tane',
                'category_slug' => 'tane-baharatlar',
                'price' => 79.90,
                'sku' => 'TB-006',
                'description' => 'Bütün kırmızı biber taneleri. Kendin öğüt, taze lezzet al.',
                'variants' => [
                    ['name' => '100g', 'price' => 79.90],
                    ['name' => '250g', 'price' => 169.90],
                ],
            ],
            [
                'name' => 'Hardal Tohumu',
                'slug' => 'hardal-tohumu',
                'category_slug' => 'tane-baharatlar',
                'price' => 54.90,
                'sku' => 'TB-007',
                'description' => 'Sarı hardal tohumu. Turşu ve salamura yapımında kullanılır.',
                'variants' => [
                    ['name' => '100g', 'price' => 54.90],
                ],
            ],
            [
                'name' => 'Tavuk Baharatı',
                'slug' => 'tavuk-baharati',
                'category_slug' => 'karisimlar',
                'price' => 54.90,
                'sale_price' => 44.90,
                'sku' => 'KB-002',
                'description' => 'Tavuk, hindi ve kümes hayvanları için özel karışım.',
                'is_featured' => true,
                'variants' => [
                    ['name' => '75g', 'price' => 54.90, 'sale_price' => 44.90],
                ],
            ],
            [
                'name' => 'Kebap Baharatı',
                'slug' => 'kebap-baharati',
                'category_slug' => 'karisimlar',
                'price' => 59.90,
                'sku' => 'KB-003',
                'description' => 'Adana ve Urfa kebap tarifleri için özel karışım.',
                'variants' => [
                    ['name' => '100g', 'price' => 59.90],
                    ['name' => '200g', 'price' => 104.90],
                ],
            ],
            [
                'name' => 'Nar Ekşisi',
                'slug' => 'nar-eksisi',
                'category_slug' => 'soslar-cesniler',
                'price' => 129.90,
                'sale_price' => 109.90,
                'sku' => 'SC-001',
                'description' => 'Özgün Antakya nar ekşisi. Salata ve kebap sosu olarak kullanılır.',
                'is_featured' => true,
                'variants' => [
                    ['name' => '250ml', 'price' => 69.90],
                    ['name' => '500ml', 'price' => 129.90, 'sale_price' => 109.90],
                ],
            ],
            [
                'name' => 'Pestil - Cevizli',
                'slug' => 'pestil-cevizli',
                'category_slug' => 'kuru-meyveler',
                'price' => 89.90,
                'sku' => 'KM-001',
                'description' => 'Geleneksel cevizli pestil. Doğal meyve ve ceviz ile hazırlanmış.',
                'variants' => [
                    ['name' => '250g', 'price' => 49.90],
                    ['name' => '500g', 'price' => 89.90],
                ],
            ],
            [
                'name' => 'Kuru İncir',
                'slug' => 'kuru-incir',
                'category_slug' => 'kuru-meyveler',
                'price' => 119.90,
                'sku' => 'KM-002',
                'description' => 'Aydın kuru inciri. Doğal kurutulmuş, şekersiz.',
                'variants' => [
                    ['name' => '500g', 'price' => 119.90],
                    ['name' => '1kg', 'price' => 219.90],
                ],
            ],
        ];

        foreach ($products as $i => $p) {
            $catId = $categories[$p['category_slug']] ?? $categories->first();
            $variants = $p['variants'] ?? [];
            unset($p['category_slug'], $p['variants']);

            $product = Product::updateOrCreate(
                ['slug' => $p['slug']],
                array_merge($p, [
                    'category_id' => $catId,
                    'stock' => 100,
                    'sort_order' => $i + 1,
                    'is_active' => true,
                    'attributes' => ['menşei' => 'Türkiye', 'doğal' => 'Evet'],
                ])
            );

            foreach ($variants as $j => $v) {
                ProductVariant::updateOrCreate(
                    [
                        'product_id' => $product->id,
                        'name' => $v['name'],
                    ],
                    [
                        'price' => $v['price'],
                        'sale_price' => $v['sale_price'] ?? null,
                        'stock' => 50,
                        'sort_order' => $j + 1,
                    ]
                );
            }
        }
    }
}
