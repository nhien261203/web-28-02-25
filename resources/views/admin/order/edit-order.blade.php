@extends('admin.admin')

@section('main')
    <h1>Chỉnh sửa đơn hàng</h1>

    <form action="{{ route('order.update', $order->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label for="status">Trạng thái đơn hàng:</label>
            <input type="text" name="status" id="status" class="form-control" value="{{ $order->status }}" required>
        </div>

        <button type="submit" class="btn btn-primary">Cập nhật</button>
    </form>
@endsection
