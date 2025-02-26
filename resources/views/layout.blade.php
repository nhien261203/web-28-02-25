<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <title>Document</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}"> <!-- Liên kết đến file CSS -->
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css">

    <!-- Swiper CSS -->
    <link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">



</head>
<body>
    <header>
        <nav class="navbar navbar-expand-lg navbar-custom">
            <div class="container">
                <a class="navbar-brand" href="{{route('home')}}">Phê-La</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav ms-auto">
                        <li class="nav-item"><a class="nav-link" href="{{ route('products.index') }}" >SẢN PHẨM</a></li>
                        <li class="nav-item"><a class="nav-link" href="{{route('about')}}">CÂU CHUYỆN THƯƠNG HIỆU</a></li>
                        <li class="nav-item"><a class="nav-link" href="#">TIN TỨC</a></li>


                        <li class="nav-item"><a class="nav-link" href="#">THẺ THÀNH VIÊN</a></li>
                        <li class="nav-item"><a class="nav-link" href="{{route('home.contact')}}">LIÊN HỆ</a></li>
                        <li class="nav-item"><a class="nav-link" href="{{route('user.orders')}}">ĐƠN HÀNG ĐÃ MUA</a></li>
                        @auth
                            <li class="nav-item dropdown menu-hello">
                                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                    Xin chào, {{ Auth::user()->name }}
                                </a>
                                <ul >
                                    <li><a  href="{{route('password.change')}}">Đổi mật khẩu</a></li>
                                    <li>
                                        <a href="{{ route('logout') }}"
                                            onclick="event.preventDefault(); document.getElementById('logout-form').submit();"
                                            class="dropdown-item">
                                            Đăng xuất
                                        </a>
                                    </li>
                                </ul>
                                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                    @csrf
                                </form>
                            </li>
                        @endauth
                    </ul>
                </div>
            </div>
        </nav>
        <div class="container">
            @if (Session::has('success'))
                <div class="alert alert-success mt-3" role="alert">
                    <h4 class="alert-heading">Thong bao</h4>
                    <p>{{ Session::get('success') }}</p>
                </div>
            @endif

            @if (Session::has('warning'))
                <div class="alert alert-warning mt-3" role="alert">
                    <h4 class="alert-heading">Thong bao</h4>
                    <p>{{ Session::get('warning') }}</p>
                </div>
            @endif

            @if (Session::has('ok'))
                <div class="alert alert-warning mt-3" role="alert">
                    <h4 class="alert-heading">Thong bao</h4>
                    <p>{{ Session::get('ok') }}</p>
                </div>
            @endif
            @yield('main')
        </div>
    </header>


    <main>
        @yield('content')
    </main>
    <footer class="text-white bg-black py-5">
        <div class="container">
            <div class="row">
                <!-- Cột Logo -->
                <div class="col-md-3 text-center mb-4 mb-md-0">
                    <h2 class="fw-bold">Phê-La</h2>
                </div>

                <!-- Cột Về Chúng Tôi -->
                <div class="col-md-3">
                    <h5 class="fw-bold mb-3">VỀ CHÚNG TÔI</h5>
                    <ul class="list-unstyled">
                        <li><a href="#" class="text-white text-decoration-none">Cửa hàng</a></li>
                        <li><a href="#" class="text-white text-decoration-none">Về Phê La</a></li>
                        <li><a href="#" class="text-white text-decoration-none">Hệ thống cửa hàng</a></li>
                    </ul>
                </div>

                <!-- Cột Địa Chỉ Công Ty -->
                <div class="col-md-3">
                    <h5 class="fw-bold mb-3">ĐỊA CHỈ CÔNG TY</h5>
                    <p>Trụ sở chính: 289 Đinh Bộ Lĩnh, P.26, Q.Bình Thạnh, TP.HCM</p>
                    <p>Chi nhánh Đà Lạt: 7 Nguyễn Chí Thanh, P.1, TP.Đà Lạt</p>
                    <p>Chi nhánh Hà Nội: Lô 04-9A KCN Vĩnh Hoàng, Q.Hoàng Mai, Hà Nội</p>
                    <h6 class="fw-bold mt-3">EMAIL HỖ TRỢ KHÁCH HÀNG:</h6>
                    <p><a href="mailto:cskh@phela.vn" class="text-white text-decoration-none">cskh@phela.vn</a></p>
                    <h6 class="fw-bold">HOTLINE HỖ TRỢ KHÁCH HÀNG:</h6>
                    <p>1900 3013 (8h30 - 22h)</p>
                </div>

                <!-- Cột Nhận Thông Tin -->
                <div class="col-md-3">
                    <h5 class="fw-bold mb-3">NHẬN THÔNG TIN TỪ PHÊ LA</h5>
                    <div class="d-flex gap-3 mb-3">
                        <a href="#" class="text-white"><i class="bi bi-facebook fs-4"></i></a>
                        <a href="#" class="text-white"><i class="bi bi-instagram fs-4"></i></a>
                        <a href="#" class="text-white"><i class="bi bi-youtube fs-4"></i></a>
                        <a href="#" class="text-white"><i class="bi bi-tiktok fs-4"></i></a>
                    </div>
                    <p>Xin vui lòng để lại địa chỉ email, chúng tôi sẽ cập nhật những tin tức mới nhất của Phê La.</p>
                    <div class="input-group">
                        <input type="email" class="form-control bg-dark text-white border-0" placeholder="Nhập email của bạn...">
                        <button class="btn btn-outline-light">Gửi</button>
                    </div>
                </div>
            </div>

            <!-- Dòng bản quyền -->
            <div class="text-center mt-4">
                <p class="mb-0">&copy; 2020 Bản quyền thuộc về Công Ty Cổ Phần Phê La</p>
            </div>
        </div>
    </footer>
    <!-- Swiper JS -->
    <script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>

    <!-- Initialize Swiper -->

</body>
</html>
