@extends('layout')

@section('content')
    <p>Loại thẻ: {{ $membership->membership_level }}</p>
    <p>Ưu đãi: {{ $membership->discount_rate }}%</p>
    <p>Giá gốc: {{ number_format($order->total_amount, 0, ',', '.') }} VND</p>
    <p>Giảm giá: -{{ number_format($order->discount, 0, ',', '.') }} VND</p>
    <p>Giá sau giảm: <strong>{{ number_format($order->final_amount, 0, ',', '.') }} VND</strong></p>

@endsection
