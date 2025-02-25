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
