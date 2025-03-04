@extends('admin.admin')

@section('main')
<div class="container">
    <h2>Thêm tin tức</h2>
    <form action="{{ route('blogs.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="form-group">
            <label>Tiêu đề:</label>
            <input type="text" name="title" class="form-control" required>
        </div>
        <div class="form-group">
            <label>Nội dung:</label>
            <textarea name="content" class="form-control" required></textarea>
        </div>
        <div class="form-group">
            <label>Hình ảnh:</label>
            <input type="file" name="image" class="form-control">
        </div>
        <div class="form-group">
            <label for="" class="fw-bold">Trang thai</label>


            <div class="radio mt-1">
                <label for="" >
                    <input type="radio" name="status" id="" value="1">
                    Hien thi
                </label>
            </div>

            <div class="radio">
                <label for="">
                    <input type="radio" name="status" id="" value="0" checked>
                    Tam an
                </label>
            </div>
        </div>
        <button type="submit" class="btn btn-success">Lưu</button>
    </form>
</div>
@endsection
