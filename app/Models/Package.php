<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Package extends Model
{
    use HasFactory;

    protected $fillable = ['product_id', 'name', 'price', 'cost_price', 'stock', 'sold_count', 'badge', 'is_available', 'description', 'terms'];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    // Check if stock is available
    public function hasStock(): bool
    {
        return $this->stock > $this->sold_count;
    }

    // Get remaining stock
    public function getRemainingStockAttribute(): int
    {
        return max(0, $this->stock - $this->sold_count);
    }

    // Decrement stock when order is placed
    public function decrementStock(int $quantity = 1): void
    {
        $this->increment('sold_count', $quantity);

        // Auto set is_available to false if out of stock
        if (! $this->hasStock()) {
            $this->update(['is_available' => false]);
        }
    }
}
