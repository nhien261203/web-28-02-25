

@extends('layout')

@section('content')
    <div class="container">
        <h1>Hello {{ Auth::user()->name }}</h1>
        <h2>Lịch sử các đơn đặt hàng của bạn</h2>
        @if($orders->isEmpty())
            <p>Bạn chưa có đơn hàng nào.</p>
        @else

        <!-- Navbar cho trạng thái đơn hàng -->


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
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $order->user_id }}</td>
                        <td>{{ $order->status }}</td>
                        <td>{{ $order->total_amount }}</td>
                        <td>
                            <a href="{{ route('orderUser.show', ['id' => $order->id]) }}">
                                <button class="btn btn-success"><i class="fas fa-eye"></i></button>
                            </a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        @endif
    </div>
@endsection
