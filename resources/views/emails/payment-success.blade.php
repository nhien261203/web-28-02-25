<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thanh toán thành công</title>
</head>
<body>
    <h2>Chào {{ $user->name }},</h2>
    <p>Cảm ơn bạn đã mua hàng tại cửa hàng của chúng tôi.</p>
    <p>Đơn hàng của bạn đã được xác nhận với tổng số tiền: <strong>{{ number_format($order->total_amount, 0, ',', '.') }} VND</strong>.</p>
    <p>Mã đơn hàng: <strong>{{ $order->id }}</strong></p>
    <p>Chúng tôi sẽ sớm giao hàng đến bạn.</p>
    <p>Trân trọng,</p>
    <p><strong>Đội ngũ hỗ trợ</strong></p>
</body>
</html>
