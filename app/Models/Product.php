<?php

// app/Models/Product.php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        'name', 'description', 'price', 'stock', 'brand',
        'processor', 'ram', 'storage', 'display', 'image'
    ];

    public function orderItems()
    {
        return $this->hasMany(OrderItem::class);
    }
}

