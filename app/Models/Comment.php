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
    ];

    // hien thi ten cua nguoi binh luan : day la phan lien quan den du lieu

    public function user()
    {
        return $this->hasOne(User::class, 'id', 'user_id');
    }

    // lay thong tin cua nguoi comment qua relationship
}
