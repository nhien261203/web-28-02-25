<?php

namespace App\Http\Controllers;

use App\Mail\OrderMail;
use App\Models\Cart;
use App\Models\Membership;
use App\Models\Order;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class OrderController extends Controller
{
    public function placeOrder(Request $request)
    {
        $cart = new Cart();

        // Call the public method to place the order
        $order = $cart->createOrder(auth()->id());
        $user = auth()->user();

        Mail::to($order->user->email)->send(new OrderMail($order));

        return redirect()->route('products.index')->with('success', 'Order placed successfully.');
    }




    public function index(Request $request)
    {
        $status = $request->get('status');

        $orders = Order::when($status, function ($query) use ($status) {
            return $query->where('status', $status);
        })->paginate(6); // Số lượng bản ghi trên mỗi trang

        return view('admin.order.index', compact('orders'));
    }
    public function edit($id)
    {
        $order = Order::findOrFail($id);


        return view('admin.order.edit-order', compact('order'));
    }
    public function update(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|string|max:255'
        ]);

        $order = Order::findOrFail($id);
        $order->status = $request->status;
        $order->save();

        return redirect()->route('order.index')->with('success', 'Cập nhật đơn hàng thành công.');
    }
    public function destroy($id)
    {
        $order = Order::findOrFail($id);
        $order->delete();

        return redirect()->route('order.index')->with('success', 'Xóa đơn hàng thành công.');
    }

    public function userOrders()
    {
        $user = Auth::user();
        $orders = Order::where('user_id', $user->id)->get();

        return view('home.order', compact('orders'));
    }








    public function show($id)
    {
        // $order = Order::findOrFail($id);
        // $order = Order::with('products')->findOrFail($id);

        $order = Order::with(['products.category'])->findOrFail($id);
        return view('admin.show-order', compact('order'));
    }


    public function showOrderUsers($id)
    {
        // $order = Order::findOrFail($id);
        // $order = Order::with('products')->findOrFail($id);

        $order = Order::with(['products.category'])->findOrFail($id);
        return view('home.show-order', compact('order'));
    }
}
