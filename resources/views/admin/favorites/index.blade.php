@extends('admin.admin') <!-- Hoặc layout mà bạn đang sử dụng -->

@section('main')
<div class="container">
    <h1>Danh sách sản phẩm yêu thích</h1>
    @if($favorites->isEmpty())
        <p>Chưa có sản phẩm nào trong danh sách yêu thích.</p>
    @else
    <table class="table table-hover">
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Image</th>
                <th>Price</th>
                <th>Content</th>
                <th>Category</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($favorites as $favorite)
            <tr>

                <td>{{ $favorite->product->id }}</td>
                <td>{{ $favorite->product->name}}

                </td>
                <td>
                    @if ($favorite->product->image)
                        <img src="{{ asset('storage/' . $favorite->product->image) }}" alt="{{ $favorite->product->name }}" width="50px" height="50px">
                    @endif
                </td>

                <td>{{ $favorite->product->price }}</td>
                <td>{{ $favorite->product->content }}</td>
                <td>{{ $favorite->product->category->name ?? 'No category' }}</td>
                
            </tr>
            @endforeach
        </tbody>

    </table>


    @endif
</div>
@endsection
