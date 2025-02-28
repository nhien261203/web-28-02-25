<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Membership extends Model
{
    use HasFactory;
    protected $fillable = ['user_id', 'points', 'discount_rate', 'membership_level'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function updateMembershipLevel()
    {
        if ($this->points >= 500) {
            $this->membership_level = 'Gold';
            $this->discount_rate = 10;
        } elseif ($this->points >= 200) {
            $this->membership_level = 'Silver';
            $this->discount_rate = 5;
        } else {
            $this->membership_level = 'Basic';
            $this->discount_rate = 0;
        }
        $this->save();
    }
    // Thêm hàm để tính toán giảm giá dựa trên cấp độ thành viên
    public function calculateDiscount($totalPrice)
    {
        return ($this->discount_rate / 100) * $totalPrice;
    }
}

