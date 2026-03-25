<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Coupon extends Model
{
    use HasFactory;

    const TYPE_FIXED = 'fixed';
    const TYPE_PERCENTAGE = 'percentage';

    protected $fillable = [
        'code',
        'type',
        'value',
        'min_order_amount',
        'usage_limit',
        'usage_per_user',
        'starts_at',
        'expires_at',
        'is_active',
    ];

    protected $casts = [
        'value' => 'decimal:2',
        'min_order_amount' => 'decimal:2',
        'starts_at' => 'date',
        'expires_at' => 'date',
        'is_active' => 'boolean',
    ];

    public function usages()
    {
        return $this->hasMany(CouponUsage::class);
    }

    public function isValid(float $subtotal = 0, ?int $userId = null): bool
    {
        if (!$this->is_active) {
            return false;
        }
        if ($this->starts_at && $this->starts_at->isFuture()) {
            return false;
        }
        if ($this->expires_at && $this->expires_at->isPast()) {
            return false;
        }
        if ($this->usage_limit && $this->usages()->count() >= $this->usage_limit) {
            return false;
        }
        if ($this->min_order_amount && $subtotal < $this->min_order_amount) {
            return false;
        }
        if ($this->usage_per_user && $userId && $this->usages()->where('user_id', $userId)->count() >= $this->usage_per_user) {
            return false;
        }
        return true;
    }

    public function calculateDiscount(float $subtotal): float
    {
        if ($this->type === self::TYPE_FIXED) {
            return min((float) $this->value, $subtotal);
        }
        return round($subtotal * ($this->value / 100), 2);
    }
}
