
@extends('layout')

@section('content')
    <a href="{{ route('cart.view') }}" class="btn btn-success btn-gh" style="margin-right:2vw">
        <img src="https://tocotocotea.com/wp-content/themes/tocotocotea/assets/images/button_delivery.png" alt="" >
    </a>
    <main>
        <div class="swiper mySwiper">
            <div class="swiper-wrapper">
                @foreach($randomBanners as $banner)
                    <div class="swiper-slide">
                        <img src="{{ $banner->image }}" alt="{{ $banner->title }}" width="100%">
                    </div>
                @endforeach
            </div>
            <div class="swiper-button-next"></div>
            <div class="swiper-button-prev"></div>
        </div>
        {{-- @foreach($banners as $banner)
                @if ($banner->description == 'home-1')
                    <div class="banner">
                        <img src="{{  $banner->image }}" alt="{{ $banner->title }}" width="100%">
                    </div>
                @endif

        @endforeach --}}
        <div class="container px-3">
            <!-- Banner -->


            <!-- Giới thiệu thương hiệu -->
            <div class="content-1">
                <h2 class="text-center mt-4">PHÊ LA VÀ NHỮNG ĐIỀU KHÁC BIỆT</h2>
                <div class="row mt-4">
                    <div class="col-md-5">
                        <h4>NGUYÊN LIỆU ĐẶC SẢN</h4>
                        <p>
                            Nốt Hương Đặc Sản - Phê La luôn trân quý, nâng niu những giá trị Nguyên Bản ở mỗi vùng đất...
                        </p>
                    </div>
                    <div class="col-md-2 text-center">
                        <img src="https://phela.vn/wp-content/uploads/2024/06/444482930_848685467281848_1903781029210564640_n.jpg" alt="Nguyên liệu" class="img-fluid rounded">
                    </div>
                    <div class="col-md-5">
                        <h4>CÂU CHUYỆN THƯƠNG HIỆU</h4>
                        <p>
                            Trà Ô Long đặc sản tại Phê La còn được ươm trồng với phương pháp chăm bón hữu cơ...
                        </p>
                    </div>
                </div>
                <div class="btn-xem-them text-center mt-4">
                    <a href="{{ route('about') }}" class="btn btn-primary">Xem thêm</a>
                </div>
            </div>

            <!-- Danh sách sản phẩm -->
            <div class="content-2">
                <h2 class="text-center mt-4">SẢN PHẨM NỔI BẬT</h2>
                <div class="row mt-4">
                    @foreach($products as $product)
                        <div class="col-md-4 mb-4">
                            <div class="card">
                                <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}"   class="card-img-top">

                                <div class="card-body text-center">
                                    <h5 class="card-title">{{ $product->name }}</h5>
                                    <p class="price">{{ number_format($product->price) }} đ</p>
                                    <p class="card-text">{{ Str::limit($product->content, 40) }}</p>

                                    <a href="{{ route('products.show', $product->id) }}" class="btn btn-primary btn-xem">Xem chi tiết</a>
                                </div>

                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </main>
    <!-- Swiper JS -->
    <script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>

    <!-- Initialize Swiper -->
    <script>
        var swiper = new Swiper('.mySwiper', {
            navigation: {
                nextEl: '.swiper-button-next',
                prevEl: '.swiper-button-prev',
            },
            autoplay: {
                delay: 3000,
                disableOnInteraction: false, // Không dừng autoplay khi người dùng tương tác
            },
            loop: true,
        });
    </script>
@endsection


