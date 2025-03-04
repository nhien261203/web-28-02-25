<?php

namespace App\Http\Controllers;

use App\Mail\PaymentSuccessMail;
use App\Models\Order;
use App\Models\Cart;
use App\Models\Membership;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;


class PaymentController extends Controller
{
    public $items = [];
    public function vnpay_payment(Request $request)
    {
        $data = $request->all();
        $userId = auth()->id();
        $cart = new Cart();

        // Tính toán tổng tiền sau giảm giá
        $totalAmount = $cart->getFinalTotalPrice($userId);

        $vnp_TmnCode = "R04CAIF6";
        $vnp_HashSecret = "IY1BW043BVONGBNI083QQL7GTFH830Y5";
        $vnp_Url = "https://sandbox.vnpayment.vn/paymentv2/vpcpay.html";
        $vnp_Returnurl = route('payment.success');
        $vnp_TxnRef = date("YmdHis");
        $vnp_OrderInfo = "Thanh toán hóa đơn test";
        $vnp_OrderType = "billpayment";
        $vnp_Amount = $totalAmount * 100; // Sử dụng tổng tiền sau giảm giá
        $vnp_Locale = "vn";
        $vnp_BankCode = "NCB";
        $vnp_IpAddr = $request->ip();

        $inputData = [
            "vnp_Version" => "2.1.0",
            "vnp_TmnCode" => $vnp_TmnCode,
            "vnp_Amount" => $vnp_Amount,
            "vnp_Command" => "pay",
            "vnp_CreateDate" => date('YmdHis'),
            "vnp_CurrCode" => "VND",
            "vnp_IpAddr" => $vnp_IpAddr,
            "vnp_Locale" => $vnp_Locale,
            "vnp_OrderInfo" => $vnp_OrderInfo,
            "vnp_OrderType" => $vnp_OrderType,
            "vnp_ReturnUrl" => $vnp_Returnurl,
            "vnp_TxnRef" => $vnp_TxnRef,
        ];

        if (isset($vnp_BankCode) && $vnp_BankCode != "") {
            $inputData['vnp_BankCode'] = $vnp_BankCode;
        }

        ksort($inputData);
        $query = "";
        $i = 0;
        $hashdata = "";
        foreach ($inputData as $key => $value) {
            if ($i == 1) {
                $hashdata .= '&' . urlencode($key) . "=" . urlencode($value);
            } else {
                $hashdata .= urlencode($key) . "=" . urlencode($value);
                $i = 1;
            }
            $query .= urlencode($key) . "=" . urlencode($value) . '&';
        }

        $vnp_Url = $vnp_Url . "?" . $query;
        if (isset($vnp_HashSecret)) {
            $vnpSecureHash = hash_hmac('sha512', $hashdata, $vnp_HashSecret);
            $vnp_Url .= 'vnp_SecureHash=' . $vnpSecureHash;
        }
        $returnData = [
            'code' => '00',
            'message' => 'success',
            'data' => $vnp_Url
        ];
        return redirect()->away($vnp_Url);
    }

    public function paymentSuccess(Request $request)
    {
        $vnp_ResponseCode = $request->get('vnp_ResponseCode');
        $vnp_TxnRef = $request->get('vnp_TxnRef');
        $vnp_Amount = $request->get('vnp_Amount') / 100;

        if ($vnp_ResponseCode == "00") {
            $user = auth()->user();
            $order = Order::create([
                'user_id' => $user->id,
                'total_amount' => $vnp_Amount,
                'status' => 'Đã thanh toán'
            ]);
            // Lưu sản phẩm trong giỏ hàng vào đơn hàng
            foreach (session('cart', []) as $item) {
                $order->products()->attach($item['id'], [
                    'quantity' => $item['quantity'],
                    'price' => $item['price'],
                    'name' => $item['name']
                ]);
            }


            Mail::to($user->email)->send(new PaymentSuccessMail($order, $user));
            session()->forget('cart');

            return redirect()->route('cart.view')->with('success', 'Thanh toán thành công! Đơn hàng của bạn đã được xác nhận.');
        } else {
            return redirect()->route('cart.view')->with('error', 'Thanh toán không thành công, vui lòng thử lại.');
        }
    }
}
