<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'status'];

    public function products()
    {
        return $this->hasMany(Product::class);
    }

    public function orders()
    {
        return $this->hasManyThrough(
            Order::class,    // Bảng đích (orders)
            Product::class,  // Bảng trung gian (products)
            'category_id',   // Khoá ngoại của bảng trung gian (products.category_id)
            'id',            // Khoá ngoại của bảng đích (orders.id)
            'id',            // Khoá chính của bảng hiện tại (categories.id)
            'order_id'       // Khoá ngoại của bảng trung gian liên kết với bảng đích (products.order_id)
        );
    }

    //hasManyThrough noi 3 bang voi nhau:
    // Orders: day la model dai dien cho bang dich lay du lieu
    // product: day la model trung gian . dung de ket noi categories va orders
    

}
