@extends('layout')
@section('content')

<div class="about-banner">
    <img src="{{asset('img/about.png')}}" alt="">
    <div class="about-title">
        <p>VỀ CHÚNG TÔI</p>
    </div>
</div>
<div class="container">
    <div class="container my-5">
        <div class="row align-items-center">
            <!-- Cột văn bản -->
            <div class="col-md-6">
                <h4 class="fw-bold">“Nốt Hương Đặc Sản”</h4>
                <p>
                    Phê La luôn trân quý, nâng niu những giá trị Nguyên Bản ở mỗi vùng đất mà chúng tôi đi qua,
                    nơi tâm hồn được đồng điệu với thiên nhiên, với nỗi vất vả nhọc nhằn của người nông dân;
                    cảm nhận được hết thảy những tầng hương ẩn sâu trong từng nguyên liệu.
                </p>
                <p>
                    Một chặng đường dài đang chờ phía trước, Phê La đã sẵn sàng viết tiếp câu chuyện
                    Nốt Hương Đặc Sản – Nguyên Bản – Thủ Công đầy cảm hứng và càng tự hào hơn khi được mang sứ mệnh:
                    “Đánh thức những nốt hương đặc sản của nông sản Việt Nam”.
                </p>
            </div>

            <!-- Cột hình ảnh -->
            <div class="col-md-6">
                <img src="{{ asset('img/img2.jpg')}}" alt="Hình ảnh Phê La"
                     class="img-fluid rounded shadow">
            </div>
        </div>
    </div>

</div>

@endsection
