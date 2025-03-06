

@extends('layout')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-lg-5">
                <div class="breadcrumb-content">

                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb mt-3">
                            <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                            <li class="breadcrumb-item active" aria-current="page">{{ Auth::user()->name}}: Các đơn hàng của bạn</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
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
                        <td>{{ number_format($order->total_amount) }}</td>
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
