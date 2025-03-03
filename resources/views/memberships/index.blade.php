@extends('admin.admin')

@section('main')
<h2>Danh sách thẻ thành viên</h2>

<table class="table">
    <thead>
        <tr>
            <th>ID</th>
            <th>Tên</th>
            <th>Điểm</th>
            <th>Cấp độ</th>
            <th>Hành động</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($memberships as $membership)
        <tr>
            <td>{{ $membership->id }}</td>
            <td>{{ $membership->user->name }}</td>
            <td>{{ $membership->points }}</td>
            <td>{{ $membership->membership_level }}</td>
            <td>
                <a href="{{ route('memberships.show', $membership->id) }}" class="btn btn-info">Xem</a>
                <a href="{{ route('memberships.edit', $membership->id) }}" class="btn btn-warning">Chỉnh sửa</a>
                <form action="{{ route('memberships.destroy', $membership->id) }}" method="POST" style="display:inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger" onclick="return confirm('Bạn có chắc muốn xóa?')">Xóa</button>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>

{{ $memberships->links() }} <!-- Pagination -->
@endsection
