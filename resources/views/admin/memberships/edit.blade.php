@extends('admin.admin')

@section('main')
<h2>Chỉnh sửa thẻ thành viên</h2>

<form action="{{ route('memberships.update', $membership->id) }}" method="POST">
    @csrf
    @method('PUT')
    <div class="form-group">
        <label for="points">Điểm</label>
        <input type="number" class="form-control" name="points" value="{{ $membership->points }}" required>
    </div>


    <button type="submit" class="btn btn-success">Lưu</button>
</form>
@endsection
