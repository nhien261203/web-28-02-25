@extends('layout')

@section('content')
    <div class="container">
        <h2>Giỏ hàng của bạn</h2>
        <table class="table table-hover">
            <thead>
                <tr>
                    <th>STT</th>
                    <th>Ảnh</th>
                    <th>Tên sản phẩm</th>
                    <th>Giá sản phẩm</th>
                    <th>Số lượng</th>
                    <th>Tổng tiền</th>
                    <th>Hành động</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($cart->items as $item)
                    <tr>
                        <td>{{ $loop->index + 1 }}</td>
                        <td>
                            @if (isset($item['image']))
                                <img src="{{ asset('storage/' . $item['image']) }}" alt="{{ $item['name'] }}" width="50px"
                                    height="50px">
                            @endif
                        </td>
                        <td>{{ $item['name'] }}</td>
                        <td>{{ number_format($item['price']) }} VND</td>
                        <td>
                            <form action="{{ route('cart.update', $item['id']) }}" method="get">
                                <input type="number" name="quantity" style="width: 60px; text-align:center"
                                    value="{{ $item['quantity'] }}">
                                <button type="submit" class="btn btn-sm btn-primary">Cập nhật</button>
                            </form>
                        </td>
                        <td>{{ number_format($item['quantity'] * $item['price']) }} VND</td>
                        <td>
                            <a onclick="return confirm('Bạn có chắc chắn muốn xóa sản phẩm này?')"
                                href="{{ route('cart.delete', $item['id']) }}" class="btn btn-sm btn-danger">Xóa</a>
                        </td>
                    </tr>
                @endforeach
                <tr>
                    <th colspan="5" class="text-right">Tổng số lượng</th>
                    <th colspan="2">{{ $cart->totalQuantity }} (sản phẩm)</th>
                </tr>
                <tr>
                    <th colspan="5" class="text-right">Tổng tiền</th>
                    <th colspan="2">{{ number_format($cart->totalPrice) }} VND</th>
                </tr>

                @if (auth()->check())
                    @php
                        $membership = \App\Models\Membership::where('user_id', auth()->id())->first();
                    @endphp
                    @if ($membership)
                        <tr>
                            <th colspan="5" class="text-right">Giảm giá ({{ number_format($membership->discount_rate) }}%)</th>
                            <th colspan="2">{{ number_format( $membership->calculateDiscount($cart->totalPrice)) }} VND</th>
                        </tr>

                        <tr>
                            <th colspan="5" class="text-right">Tổng tiền sau giảm giá</th>
                            <th colspan="2">{{ number_format( $cart->getFinalTotalPrice(auth()->id())) }} VND</th>
                        </tr>
                    @endif
                @endif
            </tbody>
        </table>
        <div class="text-center">
            <a href="{{ route('products.index') }}" class="btn btn-primary btn-sm">Tiếp tục mua hàng</a>

            @if ($cart->totalQuantity > 0)
                <a href="{{ route('cart.clear') }}" onclick="return confirm('Bạn có chắc chắn muốn xóa toàn bộ giỏ hàng?')"
                    class="btn btn-danger btn-sm">Xóa hết hàng</a>
                <form action="{{ route('cart.placeOrder') }}" method="POST">
                    @csrf
                    <button type="submit" class="btn btn-success btn-sm mt-3">Đặt hàng</button>
                </form>
            @else
                <hr>
                <div class="alert alert-warning" role="alert">
                    <h4 class="alert-heading">Giỏ hàng trống</h4>
                    <p>Vui lòng chọn sản phẩm để thêm vào giỏ hàng.</p>
                </div>
            @endif
        </div>

        @if (auth()->check() && $cart->totalPrice > 0)
            <div class="d-flex justify-content-center mt-3">
                <form action="{{ url('/vnpay_payment') }}" method="POST" class="text-center">
                    @csrf
                    <input
                        name="total" value="{{ auth()->check() && isset($membership) ? $cart->getFinalTotalPrice(auth()->id()) : $cart->totalPrice }}"
                    type="hidden">
                    <input name="cart" value="{{ json_encode($cart->items) }}" type="hidden">

                    <button type="submit" class="btn btn-success btn-sm" name="redirect">Thanh toán bằng VnPay</button>

                </form>
            </div>
        @endif
        @if(auth()->check() && $cart->totalPrice > 0)
            <div class="text-center mt-3 mb-2">
                <form action="{{ route('generate.qr.payment') }}" method="GET">
                    <button type="submit" class="btn btn-success btn-sm">Thanh toán bằng QR</button>
                </form>
            </div>

        @else
            <p>Giỏ hàng của bạn đang trống.</p>
        @endif

    </div>
@endsection
