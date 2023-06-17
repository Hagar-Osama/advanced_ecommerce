<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Brand extends Model
{
    use HasFactory;

    protected $casts = [
        'name' => 'object',
        'slug' => 'object'
    ];

    protected $fillable = [
        'name',
        'slug',
        'image'
    ];

    public function products():HasMany
    {
        return $this->hasMany(Product::class, 'brand_id', 'id');
    }
}
