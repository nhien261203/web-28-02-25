<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Product;


class Order extends Model
{
    use HasFactory;
    protected $fillable = [

        'user_id',
        'total_amount',
        'status',
        'created_at'
    ];

    public function products()
    {
        return $this->belongsToMany(Product::class, 'order_product')
                    ->withPivot('quantity', 'price')
                    ->withTimestamps();
    }



    // send mail dat hang
    // public function customer()
    // {
    //     return $this->hasOne(User::class, 'id', 'user_id');
    // }

    // public function details(){
    //     return $this->hasManyThrough(
    //         Order::class,
    //         Product::class,
    //         'category_id',
    //         'id',
    //         'id',
    //         'order_id'
    //     );
    // }

}
