<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Cart;

use Illuminate\Http\Request;

class CartController extends Controller
{
    // them vao de kiem tra dang nhap
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function addToCart(Product $product, Cart $cart)
    {
        $quantity = request('quantity', 1);
        $quantity = $quantity > 0 ? floor($quantity) : 1;
        $cart->add($product, $quantity);
        // dd(session('cart'));
        return redirect()->route('cart.view')->with('success', 'them san pham vao gio hang thanh cong');
    }

    public function view(Cart $cart)
    {
        // dd($cart);

        // the thanh vien
        $user = auth()->user();

        if ($cart->totalQuantity <= 0) {
            return redirect()->route('products.index')->with('warning', 'Giỏ hàng đang trống, hãy thêm sản phẩm.');
        }
        return view('cart-view', compact('cart'));
    }

    public function deleteCart($id, Cart $cart)
    {
        $cart->delete($id);
        return redirect()->route('cart.view')->with('warning', 'xoa san pham khoi gio hang thanh cong');
    }

    public function updateCart($id, Cart $cart)
    {
        $quantity = request('quantity', 1);
        $quantity = $quantity > 0 ? floor($quantity) : 1;
        $cart->update($id, $quantity);
        return redirect()->route('cart.view')->with('ok', 'cap nhat so luong vao gio hang');
    }

    public function clearCart(Cart $cart)
    {
        $cart->clear();
        return redirect()->route('cart.view')->with('warning', 'xoa gio hang thanh cong');
    }

    public function placeOrder(Cart $cart)
    {
        $userId = auth()->id();
        $cart->createOrder($userId);
        return redirect()->route('products.index')->with('success', 'Đặt hàng thành công!');
    }

}


// PLACE ORDER
// giai doan 1: kiem tra login, show thong tin khach hang len form
// giai doan 2: luu thong tin khach hang vao bang orders
// luu cac san pham vao trong bang order-details
// huy gio hang
// gui mail xac nhan
// nguoi dung check mail xac nhan don hang
