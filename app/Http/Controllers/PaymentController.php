<?php

namespace App\Http\Controllers;

use App\Mail\PaymentSuccessMail;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class PaymentController extends Controller
{
    public $items = [];
    public function vnpay_payment(Request $request)
    {
        $data = $request->all();

        $vnp_TmnCode = "R04CAIF6"; // Mã website tại VNPAY
        $vnp_HashSecret = "IY1BW043BVONGBNI083QQL7GTFH830Y5"; // Chuỗi bí mật

        $vnp_Url = "https://sandbox.vnpayment.vn/paymentv2/vpcpay.html";
        $vnp_Returnurl = route('payment.success'); // URL trả về sau khi thanh toán
        $vnp_TxnRef = date("YmdHis"); // Mã đơn hàng
        $vnp_OrderInfo = "Thanh toán hóa đơn test";
        $vnp_OrderType = "billpayment";
        $vnp_Amount = $data['total'] * 100000; // Số tiền thanh toán
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

        $cart = session('cart');

        if (isset($_POST['redirect'])) {
            $order = new Order();
            $order->user_id = auth()->id();
            $order->total_amount = $data['total'];
            $order->status = 'confirmed';
            $order->save();



            // lưu chi tiết đơn hàng
            foreach ($cart as $item) {
                $order->products()->attach($item['id'], [
                    'quantity' => $item['quantity'],
                    'price' => $item['price'],
                    'name' => $item['name']
                ]);
            }



            header('Location: ' . $vnp_Url);

            die();
            session()->forget('cart');
        } else {
            echo json_encode($returnData);
        }
    }
    public function paymentSuccess(Request $request)
    {
        // Lấy dữ liệu từ VNPay callback
        $vnp_ResponseCode = $request->get('vnp_ResponseCode'); // Mã phản hồi từ VNPay
        $vnp_TxnRef = $request->get('vnp_TxnRef'); // Mã giao dịch đơn hàng
        $vnp_Amount = $request->get('vnp_Amount') / 100000; // Lấy số tiền thanh toán thực tế

        if ($vnp_ResponseCode == "00") { // Thanh toán thành công
            // Xóa giỏ hàng
            // Gửi email xác nhận
            $user = auth()->user();
            $order = Order::where('user_id', $user->id)->latest()->first();

            Mail::to($user->email)->send(new PaymentSuccessMail($order, $user));


            session()->forget('cart');

            // Hiển thị trang thành công
            return redirect()->route('cart.view')->with('success', 'Thanh toán thành công! Đơn hàng của bạn đã được xác nhận.');
        } else {
            return redirect()->route('cart.view')->with('error', 'Thanh toán không thành công, vui lòng thử lại.');
        }
    }
}
