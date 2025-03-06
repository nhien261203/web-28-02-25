

@extends('layout')

@section('content')
<a href="{{ route('cart.view') }}" class="btn btn-success btn-gh" style="margin-right:2vw">
    <img src="https://tocotocotea.com/wp-content/themes/tocotocotea/assets/images/button_delivery.png" alt="" >
</a>
<div class="container mt-5">
    <div class="row">
        <div class="col-lg-5">
            <div class="breadcrumb-content">
                {{-- <h2 class="title">Change Password</h2> --}}
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mt-3">
                        <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Sản Phẩm</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
    <!-- Price Filter Form -->
    <form action="{{ route('products.index') }}" method="GET" class="mt-3">
        <h4>Lọc theo giá</h4>
        <div class="form-group">
            <label for="min_price">Giá tối thiểu:</label>
            <input type="number" name="min_price" id="min_price" class="form-control" value="{{ request('min_price') }}">
        </div>
        <div class="form-group">
            <label for="max_price">Giá tối đa:</label>
            <input type="number" name="max_price" id="max_price" class="form-control" value="{{ request('max_price') }}">
        </div>
        <button type="submit" class="btn btn-primary mt-2">Lọc</button>
    </form>



    <div class="row">
        <!-- Sidebar with categories -->
        <div class="col-md-3 category-sidebar">

            <ul class="list-group cate">
                <h4>Categories</h4>
                @foreach($categories as $category)
                    <li class="list-group-item">
                        <a href="#{{ $category->id }}">{{ $category->name }}</a>
                    </li>
                @endforeach
            </ul>



        </div>


        <div class="col-md-9">
            @foreach($categories as $category)
                <h2 id="{{ $category->id }}">{{ $category->name }}</h2>
                <div class="row">
                    @foreach($category->products as $product)
                        <div class="col-md-4 mb-4">
                            <div class="card">
                                <a href="{{ route('products.show', $product->id) }}">
                                    <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}" class="card-img-top product-image">
                                </a>

                            <div class="card-body text-center">
                                <h5 class="card-title">{{ $product->name }}</h5>
                                <p class="price">{{ number_format($product->price, 0) }} đ</p>

                                <a href="{{ route('products.show', $product->id) }}" class="btn btn-buy">Mua ngay</a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endforeach
        </div>
    </div>
</div>
@endsection
