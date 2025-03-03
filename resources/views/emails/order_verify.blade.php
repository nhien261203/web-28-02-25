<div style="border: 3px solid">
    <h3>Hi {{ $order->user->name }}</h3>

    <p>Content verify</p>

    <h4>Your order detail</h4>
    <table border="1" cellpadding="5" cellspacing="0">
        <tr>
            <th>Stt</th>
            <th>Product name</th>
            <th>Price</th>
            <th>Quantity</th>
            {{-- <th>Totalprice</th> --}}
        </tr>
        @foreach ($order->products as $product)
        <tr>
            <th>{{ $loop->index+1 }}</th>
            <th>{{  $product->name }}</th>
            <th>{{ $product->pivot->price }}</th>
            <th>{{ $product->pivot->quantity }}</th>
            {{-- <th>{{$product->total_amount}}</th> --}}

        </tr>
        @endforeach

    </table>
</div>
