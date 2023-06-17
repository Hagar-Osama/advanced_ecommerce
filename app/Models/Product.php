<?php

namespace App\Models;

use App\Http\Enums\ProductStatusEnum;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Product extends Model
{
    use HasFactory;

    protected $casts = [
        'name' => 'object',
        'slug' => 'object',
        'long_description' => 'object',
        'short_description' => 'object',
        'code' => 'object',
        'tags' => 'object',
        'status' => ProductStatusEnum::class
    ];

    protected $guarded = [];

    public function images():HasMany
    {
        return $this->hasMany(ProductImage::class, 'product_id', 'id');
    }

    public function colors():BelongsToMany
    {
        return $this->belongsToMany(
            Color::class,
            'color_product',
            'product_id',
            'color_id'
        )
            ->withTimestamps()
            ->using(ColorProduct::class);
    }

    public function sizes():BelongsToMany
    {
        return $this->belongsToMany(
            Size::class,
            'product_size',
            'product_id',
            'size_id'
        )
            ->withTimestamps()
            ->using(ProductSize::class);
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class, 'category_id', 'id');
    }

    public function brand(): BelongsTo
    {
        return $this->belongsTo(Brand::class, 'brand_id', 'id');
    }
}
