<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Plan extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'price',
        'description',
        'features',
        'excluded_features',
        'period',
        'featured',
    ];

    protected $casts = [
        'features' => 'array',
        'excluded_features' => 'array',
        'featured' => 'boolean',
        'price' => 'decimal:2',
    ];
}
