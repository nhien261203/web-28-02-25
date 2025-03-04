@extends('admin.admin')

@section('main')
<h2>Quản lý bình luận</h2>

<table>
    <thead>
        <tr>
            <th>Người dùng</th>
            <th>Sản phẩm</th>
            <th>Bình luận</th>
            <th>Trạng thái</th>
            <th>Hành động</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($comments as $comment)
            <tr>
                <td>{{ $comment->user->name }}</td>
                <td>{{ $comment->product->name }}</td>
                <td>{{ $comment->comment }}</td>

                <td>
                    
                        @if ($comment->status)
                            <span class="text-success">Hiển thị</span>
                        @else
                            <span class="text-danger">Tạm ẩn</span>
                        @endif


                </td>
                <td>
                    @if ($comment->status == 0)
                        <a href="{{ route('comments.approve', $comment->id) }}" class="btn btn-primary">Duyệt</a>
                    @endif
                    <a href="{{ route('comments.delete', $comment->id) }}" class="btn btn-danger">Xóa</a>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>
@endsection
