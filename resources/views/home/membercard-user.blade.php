

@extends('layout')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-lg-5">
                <div class="breadcrumb-content">

                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb mt-3">
                            <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                            <li class="breadcrumb-item active" aria-current="page">{{ Auth::user()->name}}: Thẻ thành viên</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>

        <div class="row d-flex justify-content-center">
            <div class="col-md-5 text-center">
                <h3>Thông tin thẻ thành viên</h3>
                @if ($membership)
                    <p ><strong>Cấp độ:</strong> {{ $membership->membership_level }}</p>
                    <p><strong>Điểm tích lũy:</strong> {{ number_format($membership->points) }}</p>
                    <p><strong>Tỷ lệ giảm giá:</strong> {{ $membership->discount_rate }}%</p>
                @else
                    <p>Bạn chưa có thẻ thành viên.</p>
                @endif
            </div>



            {{-- <div class="col-md-8">
                <h3>Lịch sử đơn hàng</h3>
                @if ($orders->count() > 0)
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>Mã đơn hàng</th>
                                <th>Ngày đặt hàng</th>
                                <th>Tổng tiền</th>
                                <th>Trạng thái</th>
                                <th>Chi tiết</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($orders as $order)
                                <tr>
                                    <td>{{ $order->id }}</td>
                                    <td>{{ $order->created_at->format('d/m/Y H:i') }}</td>
                                    <td>{{ sprintf('%.2f',$order->total_amount) }} VND</td>
                                    <td>{{ $order->status }}</td>

                                    <td>
                                        <a href="{{ route('orderUser.show', ['id' => $order->id]) }}">
                                            <button class="btn btn-success"><i class="fas fa-eye"></i></button>
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                @else
                    <p>Bạn chưa có đơn hàng nào.</p>
                @endif
            </div> --}}
        </div>
    </div>
@endsection
