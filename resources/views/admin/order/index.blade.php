

@extends('admin.admin')

@section('main')
    {{-- <h1>hello home admin</h1> --}}
    <h2>Các đơn đặt hàng</h2>

    <!-- Navbar cho trạng thái đơn hàng -->
    <nav class="navbar navbar-expand-lg navbar-light bg-light mb-3">
        <div class="container-fluid">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('order.index', ['status' => 'Chờ xác nhận']) }}">Chờ xác nhận</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('order.index', ['status' => 'Đã xác nhận']) }}">Đã xác nhận</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('order.index', ['status' => 'Đã thanh toán']) }}">Đã thanh toán</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('order.index', ['status' => 'Đang giao hàng']) }}">Đang giao hàng</a>
                </li>

            </ul>
        </div>
    </nav>

    <table class="table table-hover">
        <thead>
            <tr>
                <th>STT</th>
                <th>User ID</th>
                <th>Status Order</th>
                <th>Total Price</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($orders as $order)
                <tr>
                    <td>{{ $loop->iteration}}</td>
                    <td>{{ $order->user_id }}</td>
                    <td>{{ $order->status }}</td>
                    <td>{{ $order->total_amount }}</td>
                    <td>
                        <a href="{{ route('order.show', $order->id) }}" class="btn btn-success"><i class="fas fa-eye"></i></a>
                        <a href="{{ route('order.edit', $order->id) }}" class="btn btn-warning"><i class="fas fa-edit"></i></a>
                        <form action="{{ route('order.destroy', $order->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger" onclick="return confirm('Bạn có chắc chắn muốn xóa đơn hàng này?')">
                                <i class="fas fa-trash"></i>
                            </button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    {{ $orders->links() }}


@endsection
