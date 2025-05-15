<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

// Order.php (Model)
class Order extends Model
{
    protected $fillable = ['shop_id', 'product_id', 'customer_name', 'mobile', 'location'];

    // Relationship to Product
    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    // Relationship to Shop (optional)
    public function shop()
    {
        return $this->belongsTo(Shop::class);
    }
}


