<?php

namespace App\Models;

use App\Models\Order;

class Cart
{
    public $items = [];
    public $totalPrice = 0;
    public $totalQuantity = 0;
    public function __construct()
    {
        $this->items = session('cart') ? session('cart') : [];
        $this->totalPrice = $this->getTotalPrice();
        $this->totalQuantity = $this->getTotalQuantity();
    }
    public function add($product, $quantity = 1)
    {

        if (isset($this->items[$product->id])) {
            $this->items[$product->id]['quantity'] += $quantity;
        } else {
            $cart_item = [
                'id' => $product->id,
                'name' => $product->name,
                'price' => $product->sale_price ? $product->sale_price : $product->price,
                'image' => $product->image,
                'quantity' => 1,
            ];
            $this->items[$product->id] = $cart_item;
        }

        // $this->totalQuantity = $this->getTotalQuantity();
        // $this->totalPrice = $this->getTotalPrice(); // Calculate total price
        session(['cart' => $this->items]);


        // dd($this->items);
    }

    public function update($id, $qtt)
    {
        if (isset($this->items[$id])) {
            $this->items[$id]['quantity'] = $qtt;
            session(['cart' => $this->items]);

            // Cập nhật lại tổng giá và số lượng
            $this->totalPrice = $this->getTotalPrice();
            $this->totalQuantity = $this->getTotalQuantity();
        }
    }

    public function delete($id)
    {
        if (isset($this->items[$id])) {
            unset($this->items[$id]);
            session(['cart' => $this->items]);
        }
    }

    public function clear()
    {
        session(['cart' => null]);
    }

    private function getTotalPrice()
    {
        $total = 0;
        foreach ($this->items as $item) {
            $total += $item['quantity'] * $item['price'];
        }
        return $total;
    }

    private function getTotalQuantity()
    {
        $total = 0;
        foreach ($this->items as $item) {
            $total += $item['quantity'];
        }
        return $total;
    }

    private function placeOrder($userId)
    {
        $order = Order::create([
            'user_id' => $userId,
            'total_amount' => $this->getFinalTotalPrice($userId), // Sử dụng giá cuối cùng sau giảm giá
            'status' => 'Chờ xác nhận',
        ]);

        foreach ($this->items as $item) {
            $order->products()->attach($item['id'], [
                'quantity' => $item['quantity'],
                'price' => $item['price'],
                'name' => $item['name'],
                'image' => $item['image'],
            ]);
        }
        
        session()->forget('cart');
        return $order;
    }

    public function createOrder($userId)
    {
        $order = $this->placeOrder($userId);
        $this->updateMembershipPoints($userId, $this->getTotalPrice()); // Cập nhật điểm thành viên
        return $order;
    }

    public function getFinalTotalPrice($userId)
    {
        $totalPrice = $this->getTotalPrice();
        $membership = Membership::where('user_id', $userId)->first();

        if ($membership) {
            return $totalPrice - $membership->calculateDiscount($totalPrice);
        }

        return $totalPrice;
    }

    private function updateMembershipPoints($userId, $orderTotal)
    {
        // tim user da co the thanh vien chua
        $membership = Membership::where('user_id', $userId)->first();

        // cach tinh diem
        $pointsToAdd = $orderTotal * 0.001; // 1000vnd -> 1 diem

        if ($membership) {
            $membership->points += $pointsToAdd;// cong diem tu don hang

            $membership->updateMembershipLevel(); // update hang the
            $membership->save();
        } else {

            $membership = Membership::create([
                'user_id' => $userId,
                'points' => $pointsToAdd,
            ]);

            if ($membership) { // Kiểm tra nếu đã tạo thành công, update luon cho user
                $membership->updateMembershipLevel();
                $membership->save();
            }
        }
    }
}

// b1: them san pham vao gio hnag add: kiem tra san pham da co chua
// neu co chi tang so luong san pham

// tinh tong tien private function getTotalPrice()
// tinh gia cuoi public function getFinalTotalPrice($userId)

// Dat hang va luu vao dtb
// b1: goi placeOrder() de luu don hang, Gọi updateMembershipPoints($userId, $this->getTotalPrice()) để cập nhật điểm thành viên.
