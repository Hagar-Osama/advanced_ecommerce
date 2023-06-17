<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\Pivot;

class ProductSize extends Pivot
{
    use HasFactory;

    protected $fillable = [
        'size_id',
        'product_id'
    ];
}
