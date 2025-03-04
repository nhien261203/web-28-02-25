@extends('admin.admin')

@section('main')
<div class="container">
    <h2>Chỉnh sửa tin tức</h2>
    <form action="{{ route('blogs.update', $news->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label>Tiêu đề:</label>
            <input type="text" name="title" class="form-control" value="{{ $news->title }}" required>
        </div>
        <div class="form-group">
            <label>Nội dung:</label>
            <textarea name="content" class="form-control" required>{{ $news->content }}</textarea>
        </div>
        <div class="form-group">
            <label>Hình ảnh:</label>
            <input type="file" name="image" class="form-control">
            @if ($news->image)
                <img src="{{ asset('storage/' . $news->image) }}" width="200">
            @endif
        </div>
        <div class="form-group mb-2">
            <label for="" class="fw-bold">Trạng thái</label>


            <div class="radio mt-1">
                <label for="" >
                    <input type="radio" name="status" id="" value="1" {{$news->status == 1 ? 'checked' : ''}}>
                    Hiển thị
                </label>
            </div>

            <div class="radio">
                <label for="">
                    <input type="radio" name="status" id="" value="0" {{$news->status == 0 ? 'checked' : ''}}>
                    Tạm ẩn
                </label>
            </div>
        </div>
        <button type="submit" class="btn btn-success">Cập nhật</button>
    </form>
</div>
@endsection
