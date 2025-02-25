<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Favorite extends Model
{
    use HasFactory;
    protected $fillable = [
        'product_id',
        'user_id',
    ];
    // cach 1: su dung relation
    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
