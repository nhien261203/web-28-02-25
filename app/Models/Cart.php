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
        $membership = Membership::where('user_id', $userId)->first();

        $pointsToAdd = $orderTotal * 0.001;

        if ($membership) {
            $membership->points += $pointsToAdd;
            $membership->updateMembershipLevel(); // Cập nhật cấp độ ngay lập tức
            $membership->save();
        } else {
            // Tạo mới và gán vào biến để sử dụng tiếp
            $membership = Membership::create([
                'user_id' => $userId,
                'points' => $pointsToAdd,
            ]);

            if ($membership) { // Kiểm tra nếu đã tạo thành công
                $membership->updateMembershipLevel();
                $membership->save();
            }
        }
    }
}
