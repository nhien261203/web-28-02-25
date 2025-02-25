<div style="border: 3px solid">
    <h3>Hi {{ $order->customer->name }}</h3>

    <p>Content verify</p>

    <h4>Your order detail</h4>
    <table border="1" cellpadding="5" cellspacing="0">
        <tr>
            <th>Stt</th>
            <th>Product name</th>
            <th>Price</th>
            <th>Quantity</th>
            <th>Totalprice</th>
        </tr>
        @foreach ($order->details as $detail)
        <tr>
            <th>{{ $loop->index+1}}</th>
            <th>{{  $detail->product->name}}</th>
            <th>{{$detail->price}}</th>
        </tr>

        @endforeach
    </table>
</div>
