@php
    use Illuminate\Support\Str;
@endphp
@extends('admin.admin')

@section('main')
    <h1>Product List</h1>
    {{-- @foreach($products as $product)
        <p>{{ $product->name }}</p>
    @endforeach --}}
    <a href="{{ route('product.create')  }}" class="btn btn-success"><i class="fas fa-plus"></i></a>
    <table class="table table-hover">
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Image</th>
                <th>Price</th>
                <th>Content</th>
                <th>Category</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($products as $product)
            <tr>
                <td>{{ $product->id }}</td>
                <td>{{ $product->name}}
                </td>
                <td>
                    @if ($product->image)
                        <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}" width="50px" height="50px">
                    @endif
                </td>
                <td>{{ number_format($product->price, 0)  }} đ</td>
                <td>{{  Str::limit($product->content, 30) }}</td>
                <td>{{ $product->category->name ?? 'No category' }}</td>
                <td>
                    <form action="{{ route('product.destroy', $product->id) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-danger"><i class="fas fa-trash"></i></button>
                    </form>
                    <a href="{{ route('product.edit', $product->id) }}" class="btn btn-sm btn-primary"><i class="fas fa-edit"></i></a>
                    <a href="{{ route('product.show', $product->id) }}" class="btn btn-sm btn-success"><i class="fas fa-eye"></i></a>
                </td>
                {{-- <td>
                    <a href="" class="sm"><i class="fas fa-heart" class="btn sm"></i></a>
                </td> --}}
                {{-- @if(auth()->check())
                <td>
                    @if ($product->is_favorited)
                    <a title="no like" href="{{ route('admin.favorite', $product->id) }}"><i class="fas fa-heart" style="color: red;"></i></a>
                    @else
                    <a  title="like" href="{{ route('admin.favorite', $product->id) }}"><i class="far fa-heart"></i></a>
                    @endif
                </td>
                @endif --}}

            </tr>
            @endforeach
        </tbody>
    </table>
    {{ $products->links() }}
@endsection
