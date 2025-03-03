<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class Comment extends Model
{
    use HasFactory;

    protected $fillable =
    [
        'user_id',
        'product_id',
        'comment',
        'status',
        'name',
        'email'
    ];

    // hien thi ten cua nguoi binh luan : day la phan lien quan den du lieu

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    // lay thong tin cua nguoi comment qua relationship
}
