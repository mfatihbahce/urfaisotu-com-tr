<?php

namespace Database\Seeders;

use App\Models\Setting;
use Illuminate\Database\Seeder;

class SettingSeeder extends Seeder
{
    public function run(): void
    {
        $settings = [
            'site_name' => 'IstanbulSpice',
            'site_tagline' => 'İstanbul\'dan Dünyaya Uzanan Baharat Yolculuğu',
            'contact_email' => 'info@istanbulspice.com',
            'contact_phone' => '+90 212 xxx xx xx',
            'contact_address' => 'İstanbul, Türkiye',
            'shipping_base_rate' => '29.90',
            'free_shipping_threshold' => '500',
        ];

        foreach ($settings as $key => $value) {
            Setting::updateOrCreate(['key' => $key], ['value' => $value]);
        }
    }
}
