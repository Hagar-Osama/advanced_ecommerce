<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Size extends Model
{
    use HasFactory;

    protected $casts = [
        'name' => 'object',
    ];


    protected $fillable = [
        'name',
    ];

    public function products():BelongsToMany
    {
        return $this->belongsToMany(
            Product::class,
            'product_size',
            'size_id',
            'product_id'
        )
            ->withTimestamps()
            ->using(ProductSize::class);
    }


}
