@extends('admin.admin')

@section('main')
<h1>Chi tiet san pham: {{$product->name}}</h1>
{{-- <a href="{{ route('cart.add', $product->id) }}" class="btn btn-success btn-xs">AddCart</a> --}}
    <div class="card">
        <div class="card-body">
            <h5 class="card-title">Giá: {{ $product->price }}</h5>
            <p> Anh:
                @if ($product->image)
                    <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}" width="50px" height="50px">
                @endif
            </p>
            <p class="card-text">Content: {{ $product->content }}</p>
            <p class="card-text">Category: {{ $product->category->name ?? 'No category' }}</p>

            {{-- <form action="{{ route('cart.add', $product->id) }}" method="GET" >
                <div class="form-group">
                    <input type="number" class="form-control" name="quantity" placeholder="nhap so luong" >

                </div>

            </form> --}}


            <a href="{{ route('product.index') }}" class="btn btn-secondary mt-3">Quay Lại Danh Sách</a>
        </div>
        <hr>

         {{-- <h3 >Comments</h3>

        <form action="{{ route('home.comment', $product->id) }}" method="POST" role="form">

            @csrf

            <div class="mb-3 mt-5 " >
                <textarea name="comment" id="content" class="form-control" rows="3" placeholder="Enter comments"></textarea>
            </div>
            <button type="submit" class="btn btn-primary mt-3">Send</button>
        </form>

        @foreach ($comments as $com)
        <div class="media">

        </div>
        <div class="media-body mt-3">
            <h4 class="media-heading"><i class="fas fa-user-circle px-2" style="font-size: 40px; color: #ccc;"></i>{{ $com->user->name }}
            <small>{{ $com->created_at->format('d/m/Y')}}</small>
            </h4>
            <p>{{$com->comment}}</p>
            @can('my-comment', $com)


            <p class="" style="text-align:right;">
                <a href="" class="btn btn-primary btn-sm">Sua</a>
                <a href="" class="btn btn-danger btn-sm">Xoa</a>
            </p>

            @endcan
        </div>
        @endforeach --}}

        {{-- @foreach ($comments as $com)
            <div class="media"></div>
            <div class="media-body mt-3">
                <h4 class="media-heading">
                    <i class="fas fa-user-circle px-2" style="font-size: 40px; color: #ccc;"></i>
                    {{ $com->user_name }} <!-- Thay đổi user->name thành user_name -->
                    <small>{{ \Carbon\Carbon::parse($com->created_at)->format('d/m/Y')}}</small>
                </h4>
                <p>{{ $com->comment }}</p>

                @can('my-comment', $com)
                    <p class="" style="text-align:right;">
                        <a href="" class="btn btn-primary btn-sm">Edit</a>
                        <a href="" class="btn btn-danger btn-sm">Delete</a>
                    </p>
                @endcan
            </div>
        @endforeach --}}
    </div>
@endsection
