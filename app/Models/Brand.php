<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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
}
