@extends('admin.admin')
@section('main')
<h1>Sửa Sản Phẩm</h1>
<form action="{{ route('product.update', $product->id) }}" method="POST" role="form" enctype="multipart/form-data">
    @csrf
    @method('PUT')

    <div class="form-group mb-2">
        <label for="name" class="fw-bold">Tên Sản Phẩm</label>
        <input type="text" class="form-control" id="name" name="name" value="{{ old('name', $product->name) }}" placeholder="Nhập tên sản phẩm">
        @error('name')
            <div class="text-danger">{{ $message }}</div>
        @enderror
    </div>

    <div class="form-group mb-2">
        <label for="price" class="fw-bold">Giá Sản Phẩm</label>
        <input type="number" class="form-control" id="price" name="price" value="{{ old('price', $product->price) }}" placeholder="Nhập giá sản phẩm">
        @error('price')
            <div class="text-danger">{{ $message }}</div>
        @enderror
    </div>

    <div class="form-group mb-2">
        <label for="category_id" class="fw-bold">Chọn Danh Mục</label>
        <select name="category_id" id="category_id" class="form-control mt-1">
            @foreach($categories as $category)
                <option value="{{ $category->id }}" {{ $product->category_id == $category->id ? 'selected' : '' }}>
                    {{ $category->name }}
                </option>
            @endforeach
        </select>
    </div>

    <div class="form-group mb-2">
        <label for="content" class="fw-bold">Nội Dung Sản Phẩm</label>
        <textarea class="form-control" id="content" name="content" rows="4" placeholder="Nhập nội dung sản phẩm">{{ old('content', $product->content) }}</textarea>
        @error('content')
            <div class="text-danger">{{ $message }}</div>
        @enderror
    </div>

    <div class="form-group mb-2">
        <label for="image" class="fw-bold">Hình Ảnh Sản Phẩm</label>
        <input type="file" class="form-control" id="image" name="image">
        @error('image')
            <div class="text-danger">{{ $message }}</div>
        @enderror
        @if($product->image)
            <img src="{{ asset('storage/' . $product->image) }}" alt="Current Image" class="img-thumbnail mt-2" style="max-width: 150px;">
        @endif
    </div>

    <button type="submit" class="btn btn-primary">Cập Nhật</button>
</form>
@endsection
