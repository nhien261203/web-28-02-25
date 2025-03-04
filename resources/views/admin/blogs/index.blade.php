@extends('admin.admin')

@section('main')
{{-- <div class="container">
    <h2>Danh sách tin tức</h2>
    <a href="{{ route('blogs.create') }}" class="btn btn-primary">Thêm tin tức</a>
    @foreach ($news as $item)
        <div class="card mt-3">
            <div class="card-body">
                <h5>{{ $item->title }}</h5>
                <p>{{ $item->content }}</p>
                @if ($item->image)
                    <img src="{{ asset('storage/' . $item->image) }}" width="200">
                @endif
                <a href="{{ route('blogs.edit', $item->id) }}" class="btn btn-warning">Sửa</a>
                <form action="{{ route('blogs.destroy', $item->id) }}" method="POST" class="d-inline">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">Xóa</button>
                </form>
            </div>
        </div>
    @endforeach
</div> --}}
<h2>Danh sách tin tức</h2>

<table class="table">
    <thead>
        <tr>
            <th>STT</th>
            <th>Title</th>
            <th>Content</th>
            <th>Image</th>
            <th>Trạng thái</th>
            <th>Hành động</th>
        </tr>
    </thead>
    <tbody>
        <a href="{{ route('blogs.create') }}" class="btn btn-primary">Thêm tin tức</a>
        @foreach ($news as $item)
        <tr>
            <td>{{  $loop->iteration }}</td>
            <td>{{ $item->title }}</td>
            <td>{{ Str::limit($item->content, 100, '...') }}</td>

            <td>
                @if ($item->image)
                    <img src="{{ asset('storage/' . $item->image) }}" width="200">
                @endif
            </td>
            <td>
                @if ($item->status)
                    <span class="text-success">Hiển thị</span>
                @else
                    <span class="text-danger">Tạm ẩn</span>
                @endif
            </td>

            <td>
                <a href="{{ route('blogs.edit', $item->id) }}" class="btn btn-warning mb-2">Sửa</a>
                <form action="{{ route('blogs.destroy', $item->id) }}" method="POST" class="d-inline">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">Xóa</button>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
@endsection
