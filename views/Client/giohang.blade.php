@extends('Client.layouts.main')
@section('title', 'Giỏ hàng')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <h2 class="text-center mb-4">Giỏ hàng của bạn</h2>
            @if (empty($giohang))
                <p class="text-center">Giỏ hàng của bạn hiện đang trống.</p>
            @else
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Tên sản phẩm</th>
                            <th>Kích cỡ</th>
                            <th>Số lượng</th>
                            <th>Giá</th>
                            <th>Thao tác</th>
                        </tr>
                    </thead>
                    <tbody>
@foreach ($giohang as $item)
<tr>
    <td><img src="/path/to/uploads/{{ $item['hinhanh'] }}" width="50"></td>
    <td>{{ $item['product_name'] }}</td>
    <td>{{ $item['kich_co'] }}</td>
    <td>{{ number_format($item['gia'], 0, ',', '.') }}₫</td>
    <td>{{ $item['soluong'] }}</td>
    <td>{{ number_format($item['tong_gia'], 0, ',', '.') }}₫</td>
</tr>
@endforeach

                    </tbody>
                </table>

                <div class="text-end">
                    <strong>Tổng tiền: </strong> 
                    {{ number_format($tong_tien, 0, ',', '.') }} VND
                </div>

                <div class="text-center mt-4">
                    <a href="/checkout" class="btn btn-success">Thanh toán</a>
                </div>
            @endif
        </div>
    </div>

@endsection