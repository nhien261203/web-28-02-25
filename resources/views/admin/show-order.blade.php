@extends('admin.admin')

@section('main')

    <h2>Chi tiet don hang</h2>
    <p>Ma don hang: {{ $order->id }}</p>
    <p>User_id: {{ $order->user_id }} </p>
    <p>Trang thai: {{ $order->status }}</p>
    <p>Tong tien: {{ $order->total_amount}}</p>
    <p>Ngay Order: {{$order->created_at->format('d/m/Y')}}</p>

    <h3>San pham trong don hang</h3>
    <table class="table table-hover">
        <thead>
            <tr>
                <th>Ten san pham</th>
                <th>So luong</th>
                <th>Gia san pham</th>
                <th>Tong tien</th>
                <th>Loai san pham</th>

            </tr>
        </thead>
        <tbody>
            @foreach ($order->products as $product )
                <tr>
                    <td>{{ $product->name }}</td>
                    <td>{{ $product->pivot->quantity }}</td>
                    <td>{{ $product->pivot->price  }}</td>
                    <td>{{ $product->pivot->quantity * $product->pivot->price }}</td>
                    <td>{{ $product->category->name ?? 'loi!!!'}}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

@endsection
