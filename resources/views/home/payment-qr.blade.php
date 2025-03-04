<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thanh toán QR Code</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>

</head>
<body>
    <div class="text-center">
        <h2>Quét mã QR để thanh toán</h2>
        <p>Vui lòng quét mã QR bằng ứng dụng ngân hàng để thực hiện thanh toán.</p>
        <div>{!! $qrCode !!}</div>
        <p><a href="{{ $paymentUrl }}" target="_blank">Hoặc bấm vào đây để thanh toán</a></p>
    </div>

</body>
</html>
