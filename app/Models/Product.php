<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'category_id',
        'sub_category_id',
        'brand_id',
        'vendor_id',
        'hot_deals',
        'featured',
        'special_offer',
        'special_deal',
        'product_name',
        'product_slug',
        'product_id',
        'product_tags',
        'product_sizes',
        'product_colors',
        'selling_price',
        'discount',
        'short_desc',
        'long_desc',
        'status',
        'thumbnail',
        'product_quantity'
    ];


    public function multiple_images(): HasMany
    {
        return $this->hasMany(MultiImage::class);
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function vendor(): BelongsTo
    {
        return $this->belongsTo(User::class, 'vendor_id');
    }

    public function carts(): HasMany
    {
        return $this->hasMany(Cart::class);
    }
}
