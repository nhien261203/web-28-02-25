@extends('admin.admin')

@section('main')
<div class="container">
    <h2>Chỉnh sửa bình luận</h2>
    <form action="{{ route('comments.update', $comment->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="content" class="form-label">Nội dung bình luận</label>
            <textarea name="content" id="content" class="form-control" rows="4" required>{{ old('content', $comment->comment) }}</textarea>
        </div>

        <div class="mb-3">
            <label for="status" class="form-label">Trạng thái</label>
            <select name="status" id="status" class="form-control">
                <option value="1" {{ $comment->status == 1 ? 'selected' : '' }}>Hiển thị</option>
                <option value="0" {{ $comment->status == 0 ? 'selected' : '' }}>Tạm ẩn</option>
            </select>
        </div>

        <button type="submit" class="btn btn-primary">Cập nhật</button>
        <a href="{{ route('comments.index') }}" class="btn btn-secondary">Quay lại</a>
    </form>
</div>
@endsection
