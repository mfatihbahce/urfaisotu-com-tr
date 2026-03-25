<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        $categories = [
            ['name' => 'Pul Biber', 'slug' => 'pul-biber', 'description' => 'Doğal pul biber çeşitleri', 'icon' => 'chili'],
            ['name' => 'Toz Baharatlar', 'slug' => 'toz-baharatlar', 'description' => 'Öğütülmüş baharatlar', 'icon' => 'cumin'],
            ['name' => 'Tane Baharatlar', 'slug' => 'tane-baharatlar', 'description' => 'Tane halinde baharatlar', 'icon' => 'clove'],
            ['name' => 'Karışımlar', 'slug' => 'karisimlar', 'description' => 'Özel baharat karışımları', 'icon' => 'sumac'],
            ['name' => 'Soslar ve Çeşniler', 'slug' => 'soslar-cesniler', 'description' => 'Nar ekşisi, sumak sosu ve diğer çeşniler', 'icon' => 'pomegranate'],
            ['name' => 'Kuru Meyveler', 'slug' => 'kuru-meyveler', 'description' => 'Kurutulmuş meyveler ve atıştırmalıklar', 'icon' => 'fig'],
        ];

        foreach ($categories as $i => $cat) {
            Category::updateOrCreate(
                ['slug' => $cat['slug']],
                array_merge($cat, ['sort_order' => $i + 1, 'is_active' => true])
            );
        }
    }
}
