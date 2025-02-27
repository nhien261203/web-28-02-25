<?php

namespace App\Models;
use App\Models\Order;
class Cart
{
    public $items= [];
    public $totalPrice = 0;
    public $totalQuantity = 0;

    public function __construct()
    {
        $this->items = session('cart') ? session('cart') : [];
        $this->totalPrice= $this->getTotalPrice();
        $this->totalQuantity = $this->getTotalQuantity();
    }

    public function add($product, $quantity= 1 ) {

        if(isset($this->items[$product->id])) {
            $this->items[$product->id]['quantity'] += $quantity;
        }else {
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

        session([ 'cart'=> $this->items]);


        // dd($this->items);
    }

    public function update($id, $qtt)
    {
        if(isset($this->items[$id])) {
            $this->items[$id]['quantity'] = $qtt;
            session([ 'cart'=> $this->items]);
        }
    }

    public function delete($id)
    {
        if(isset($this->items[$id])) {
            unset($this->items[$id]);
            session([ 'cart'=> $this->items]);
        }
    }

    public function clear()
    {
        session([ 'cart'=> null]);
    }

    private function getTotalPrice()
    {
        $total = 0;
        foreach($this->items as $item){
            $total += $item['quantity'] * $item['price'];
        }

        return $total;
    }

    private function getTotalQuantity()
    {
        $total = 0;
        foreach($this->items as $item){
            $total += $item['quantity'];
        }
        return $total;

    }

    private function placeOrder($userId)
    {

        $order = Order::create([
            'user_id' => $userId,
            'total_amount' => $this->getTotalPrice(),
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
        return $this->placeOrder($userId);
    }

}
