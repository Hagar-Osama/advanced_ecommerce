<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Color extends Model
{
    use HasFactory;

    protected $casts = [
        'name' => 'object',
    ];

    protected $fillable = [
        'name',
        'code'
    ];

    public function products(): BelongsToMany
    {
        return $this->belongsToMany(
            Product::class,
            'color_product',
            'color_id',
            'product_id'
        )
            ->withTimestamps()
            ->using(ColorProduct::class);
    }
}
