<?php

namespace App\Services;

use App\Models\Setting;

/**
 * Kargo ücreti hesaplama servisi.
 * İleride kargo API entegrasyonu eklenebilir.
 */
class ShippingService
{
    public function calculate(float $subtotal, string $city, ?string $district = null): float
    {
        $freeShippingThreshold = (float) (Setting::get('free_shipping_threshold') ?? 500);
        if ($subtotal >= $freeShippingThreshold) {
            return 0;
        }
        $baseRate = (float) (Setting::get('shipping_base_rate') ?? 29.90);
        return $baseRate;
    }
}
