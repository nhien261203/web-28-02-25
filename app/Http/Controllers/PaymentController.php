<?php

namespace App\Http\Controllers;

use App\Mail\PaymentSuccessMail;
use App\Models\Order;
use App\Models\Cart;
use App\Models\Membership;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
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
        $vnp_Returnurl = config('services.vnpay.return_url');

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

            // Cập nhật điểm thành viên
            $this->updateMembershipPoints($user->id, $vnp_Amount);

            Mail::to($user->email)->send(new PaymentSuccessMail($order, $user));
            session()->forget('cart');

            return redirect()->route('cart.view')->with('success', 'Thanh toán thành công! Đơn hàng của bạn đã được xác nhận.');
        } else {
            return redirect()->route('cart.view')->with('error', 'Thanh toán không thành công, vui lòng thử lại.');
        }
    }

    // QR-CODE
    public function generateQrPayment(Request $request)
    {
        $userId = auth()->id();
        $cart = new Cart();
        $totalAmount = $cart->getFinalTotalPrice($userId); // Lấy tổng tiền từ giỏ hàng

        if ($totalAmount <= 0) {
            return redirect()->route('cart.view')->with('error', 'Giỏ hàng trống, không thể thanh toán.');
        }

        $vnp_TmnCode = config('services.vnpay.tmn_code');
        $vnp_HashSecret = config('services.vnpay.hash_secret');
        $vnp_Url = config('services.vnpay.url');
        $vnp_Returnurl = config('services.vnpay.return_url');
        $vnp_TxnRef = now()->format('YmdHis');
        $vnp_Amount = $totalAmount * 100;

        $vnp_OrderInfo = "Thanh toán đơn hàng #" . $vnp_TxnRef;
        $vnp_Locale = "vn";
        $vnp_IpAddr = request()->ip();

        $inputData = [
            "vnp_Version" => "2.1.0",
            "vnp_TmnCode" => $vnp_TmnCode,
            "vnp_Amount" => $vnp_Amount,
            "vnp_Command" => "pay",
            "vnp_CreateDate" => now()->format('YmdHis'),
            "vnp_CurrCode" => "VND",
            "vnp_IpAddr" => $vnp_IpAddr,
            "vnp_Locale" => $vnp_Locale,
            "vnp_OrderInfo" => $vnp_OrderInfo,
            "vnp_OrderType" => "billpayment",
            "vnp_ReturnUrl" => $vnp_Returnurl,
            "vnp_TxnRef" => $vnp_TxnRef,
        ];

        ksort($inputData);

        $query = "" ;
        $i = 0 ;
        $hashdata = "" ;

        foreach ($inputData as $key => $value) {
            if ($i == 1) {
                $hashdata .= '&' . urlencode($key) . "=" . urlencode($value);
            } else {
                $hashdata .= urlencode($key) . "=" . urlencode($value);
                $i = 1;
            }
            $query .= urlencode($key) . "=" . urlencode($value) . '&';
        }

        // Xóa ký tự & cuối chuỗi query (tránh lỗi URL không hợp lệ)
        $query = rtrim($query, '&');

        $vnpSecureHash = hash_hmac('sha512', $hashdata, $vnp_HashSecret);
        $paymentUrl = $vnp_Url . "?" . $query . "&vnp_SecureHash=" . $vnpSecureHash;

        // Tạo QR Code từ URL thanh toán
        $qrCode = QrCode::size(200)->generate($paymentUrl);

        return view('home.payment-qr', compact('qrCode', 'paymentUrl'));
    }
    public function qrPaymentSuccess(Request $request)
    {
        $vnp_ResponseCode = $request->get('vnp_ResponseCode');
        $vnp_TxnRef = $request->get('vnp_TxnRef');
        $vnp_Amount = $request->get('vnp_Amount') / 100;

        if ($vnp_ResponseCode == "00") { // Kiểm tra nếu thanh toán thành công
            $user = auth()->user();
            $order = Order::create([
                'user_id' => $user->id,
                'total_amount' => $vnp_Amount,
                'status' => 'Đã thanh toán'
            ]);

            // Lưu sản phẩm từ giỏ hàng vào đơn hàng
            foreach (session('cart', []) as $item) {
                $order->products()->attach($item['id'], [
                    'quantity' => $item['quantity'],
                    'price' => $item['price'],
                    'name' => $item['name']
                ]);
            }

            // Cập nhật điểm thành viên
            $this->updateMembershipPoints($user->id, $vnp_Amount);

            // Gửi email xác nhận thanh toán
            Mail::to($user->email)->send(new PaymentSuccessMail($order, $user));

            // Xóa giỏ hàng sau khi thanh toán thành công
            session()->forget('cart');

            return redirect()->route('cart.view')->with('success', 'Thanh toán thành công! Đơn hàng của bạn đã được xác nhận.');
        } else {
            return redirect()->route('cart.view')->with('error', 'Thanh toán không thành công, vui lòng thử lại.');
        }
    }

    private function updateMembershipPoints($userId, $amount)
    {
        $membership = Membership::firstOrCreate(['user_id' => $userId]);

        // diem member
        $pointsEarned = $amount * 0.001 ; // 1000vnd->1 diem
        $membership->points += $pointsEarned;

        // Cập nhật hạng thẻ
        if ($membership->points >= 500) {
            $membership->membership_level = 'gold';

        } elseif ($membership->points >= 200) {
            $membership->membership_level = 'silver';

        } else {
            $membership->membership_level = 'basic';
        }

        $membership->updateMembershipLevel();
        $membership->save();
    }
}
