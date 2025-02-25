<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order_product extends Model
{
    use HasFactory;
    protected $table = 'order_product';

    // Các thuộc tính có thể điền được
    protected $fillable = [
        'order_id',
        'product_id',
        'quantity',
        'price',
        'name',
        'image',
    ];

    // Quan hệ với model Order
    public function order()
    {
        return $this->belongsTo(Order::class);
    }

    // Quan hệ với model Product
    public function product()
    {
        return $this->belongsTo(Product::class);
    }

}
