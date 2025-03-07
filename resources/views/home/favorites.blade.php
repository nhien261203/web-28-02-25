@extends('layout')
@section('content')
    <div class="container mt-5">
        <div class="row">
            <div class="col-lg-5">
                <div class="breadcrumb-content">
                    {{-- <h2 class="title">Change Password</h2> --}}
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb mt-3">
                            <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Yêu thích sản phẩm</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
        @if($favorites->isEmpty())
            <p>Bạn chưa yêu thích sản phẩm nào.</p>
        @else
            <h2 class="text-center mb-4">Your Favorite Products</h2>
            <div class="row">
                @foreach ($favorites as $favorite)
                    <div class="col-md-4 mb-4">
                        <div class="card">
                            <img src="{{ asset('storage/' . $favorite->product->image) }}" alt="{{ $favorite->product->name }}" class="card-img-top product-image">
                            <div class="card-body">
                                <h5 class="card-title">{{ $favorite->product->name }}</h5>
                                <p class="card-text">{{ $favorite->product->description }}</p>
                                <p class="card-text"><strong>Price:</strong> {{ number_format($favorite->product->price) }} đ</p>
                                <a href="{{ route('products.show', $favorite->product->id) }}" class="btn btn-primary">View Product</a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
    </div>
@endsection
