@extends('layout')

@section('content')
    <div class="container">
        <h2>Gio hang cua ban</h2>
        <table class="table table-hover">
            <thead>
                <tr>
                    <th>STT</th>
                    <th>Anh</th>
                    <th>Ten sp</th>
                    <th>Gia sp</th>
                    <th>So luong</th>

                    <th>Tong tien</th>
                    <th>Action</th>

                    {{-- <th>Loai san pham</th> --}}
                </tr>
            </thead>
            <tbody>
                @foreach ($cart->items as $item )
                <tr>
                    <td>{{ $loop->index + 1 }}</td>
                    <td>
                        @if (isset($item['image']))
                            <img src="{{ asset('storage/' . $item['image']) }}" alt="{{ $item['name'] }}" width="50px" height="50px">
                        @endif
                    </td>

                    <td>{{ $item['name'] }}</td>
                    <td>{{ $item['price'] }}</td>
                    <td>
                        <form action="{{ route('cart.update', $item['id']) }}" method="get">
                            <input type="number" name="quantity" style="width: 60px; text-align:center" value="{{ $item['quantity'] }}">
                            <button type="submit">Cap nhat</button>
                        </form>
                    </td>

                    <td>{{ $item['quantity'] * $item['price'] }}</td>
                    <td>
                        <a onclick="return cofirm('are you sure?') " href="{{ route('cart.delete', $item['id']) }}" class="btn btn-danger">delete</a>
                    </td>

                </tr>
                @endforeach
                <tr>
                    <th colspan="5" class="text-right">Tong so luong</th>
                    <th colspan="2">{{ $cart->totalQuantity }} (san pham)</th>
                </tr>

                {{-- <tr>
                    {{ $product->category->name ?? 'No category' }}
                </tr> --}}
                {{-- <tr>
                    {{ $item['category_name'] ?? 'Không có danh mục' }}
                </tr> --}}

                <tr>
                    <th colspan="5" class="text-right">Tong tien</th>
                    <th colspan="2">{{number_format($cart->totalPrice) }}vnd</th>
                </tr>

                {{-- <tr>
                    {{ $item['category_name'] ?? 'Không có danh mục' }}
                </tr> --}}
            </tbody>
        </table>
        <div class="text-center ">
            <a href="{{ route('products.index') }}"  class="btn btn-primary btn-sm">Tiep tuc mua hang</a>

            @if ( $cart->totalQuantity > 0)
            <a href="{{ route('cart.clear') }}" onclick="return cofirm('Are you sure?')" class="btn btn-danger btn-sm">Xoa het hang</a>
            <form action="{{ route('cart.placeOrder') }}" method="POST">
                @csrf
                <button type="submit" class="btn-sm btn-success mt-3">Dat hang</button>
            </form>

            @else
            <hr>
            <div class="alert alert-success" role="alert">
                <h4 class="alert-heading">Gio hang trong</h4>
                <p>Vui long tiep tuc mua hang</p>
            </div>
            @endif
        </div>
        <div class="d-flex justify-content-center mt-3">
            <form action="{{ url('/vnpay_payment') }}" method="POST" class="text-center">
                @csrf

                <input name="total" value={{ $cart->totalPrice }} type="hidden">
                <input name="cart" value="{{ json_encode($cart->items) }}" type="hidden">
                {{-- <p>Tổng tiền: {{ $cart->totalPrice }}</p> --}}
                @if ($cart->totalPrice > 0)
                    <button type="submit" class="btn btn-success btn-sm" name="redirect" >Thanh toán bằng VnPay</button>
                @endif

            </form>
        </div>
    </div>




@endsection
