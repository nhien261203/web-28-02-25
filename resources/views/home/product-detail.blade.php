@extends('layout')

@section('content')
<div class="container mt-5">
    <div class="row">
        <div class="col-md-6">
            <img src="{{ asset('storage/' . $products->image) }}" class="img-fluid rounded" alt="{{ $products->name }}">
        </div>
        <div class="col-md-6 d-flex flex-column justify-content-center">
            <h2 class="text-uppercase">{{ $products->name }}</h2>
            <div class="h4 text-danger">
                {{ number_format($products->price, 0, ',', '.') }}₫
                @if(auth()->check())
                    @if ($products->is_favorited)
                        <a title="no like" href="{{ route('admin.favorite', $products->id) }}"><i class="fas fa-heart fa-sm" style="color: red;"></i></a>
                    @else
                        <a  title="like" href="{{ route('admin.favorite', $products->id) }}"><i class="far fa-heart fa-sm"></i></a>
                    @endif

                @endif
            </div>

            <a href="{{ route('cart.add', $products->id) }}" class="mt-3"><button type="submit" class="btn btn-primary">Mua ngay</button></a>
            <h3 class="mt-4">CHI TIẾT SẢN PHẨM</h3>
            <p>{{ $products->content }}</p>
        </div>
    </div>
    <div class="row">
        <div class="comments-section mt-4">
            <h3 class="mb-4">Bình luận</h3>
            @foreach ($comments as $comment)
                <div class="card mb-3 shadow-sm">
                    <div class="card-body">
                        <h6 class="card-title text-primary mb-1">{{ $comment->name }}</h6>
                        <p class="card-text">{{ $comment->comment }}</p>
                        <small class="text-muted">Đăng vào: {{ $comment->created_at->format('d/m/Y H:i') }}</small>
                    </div>
                </div>
            @endforeach
        </div>



        @if(auth()->check())
            <form action="{{ route('home.comment',['product_id' => $products->id]) }}" method="POST" class="p-4 border rounded shadow-sm">
                @csrf
                <h4 class="mb-3">BÌNH LUẬN - HỎI ĐÁP</h4>

                <div class="form-group">
                    <label for="comment">Hãy viết bình luận của bạn tại đây:</label>
                    <textarea class="form-control" id="comment" name="comment" rows="4" placeholder="Nhập bình luận..." required></textarea>
                </div>

                <div class="row">
                    <div class="col-md-5">
                        <div class="form-group">
                            <label for="name">Họ tên</label>
                            <input type="text" class="form-control" id="name" name="name" placeholder="Nhập họ tên" required>
                        </div>
                    </div>

                    <div class="col-md-5">
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="email" class="form-control" id="email" name="email" placeholder="Nhập email" required>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <button type="submit" class="btn btn-primary mt-4">Gửi bình luận</button>
                    </div>
                </div>


            </form>

        @else
            <p><a href="{{ route('login') }}">Đăng nhập</a> để bình luận.</p>
        @endif

    </div>
    <h3 class="mt-5">SẢN PHẨM VỪA XEM</h3>
    <div class="row">
        @foreach($recentProducts as $recentProduct)
        <div class="col-md-4 mb-4">
            <div class="card">
                <img src="{{ asset('storage/' . $recentProduct->image) }}" class="card-img-top" alt="{{ $recentProduct->name }}">
                <div class="card-body">
                    <h5 class="card-title">{{ $recentProduct->name }}</h5>
                    <p class="card-text">{{ number_format($recentProduct->price, 0, ',', '.') }}₫</p>
                    <a href="{{ route('products.show', $recentProduct->id) }}" class="btn btn-primary">Xem chi tiết</a>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>
@endsection
