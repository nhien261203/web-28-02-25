<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Favorite;

class Product extends Model
{
    use HasFactory;

    public $appends = [
        'is_favorited'
    ];

    protected $fillable = [
        'name',
        'image',
        'price',
        'content',
        'category_id',
        'status'
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function orders()
    {
        return $this->belongsToMany(Order::class, 'order_product')
                    ->withPivot('quantity', 'price')
                    ->withTimestamps();
    }

    // xu li favorites

    public function getIsFavoritedAttribute()
    {
        $favorited = Favorite::where(['product_id'=>$this->id, 'user_id' => auth()->id()])->first();
        return $favorited ? true : false ;
    }
    public function orderProducts()
    {
        return $this->hasMany(Order_product::class);
    }

}
