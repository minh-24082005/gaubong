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
                            <th>ảnh</th>
                            <th>Tên sản phẩm</th>
                            <th>Kích cỡ</th>
                            <th>Số lượng</th>
                            <th>số lượng</th> 
                            <th>Giá</th>
                           
                            <th>Thao tác</th>
                        </tr>
                    </thead>
                    <tbody>
@foreach ($giohang as $item)
<tr>
<td><img src="{{ file_url($item['hinhanh']) }}" width="50"></td>
    <td>{{ $item['product_name'] }}</td>
    <td>{{ $item['kich_co'] }}</td>
    <td>{{ number_format($item['gia'], 0, ',', '.') }}₫</td>
    <td>{{ $item['soluong'] }}</td>
    <td>{{ number_format($item['tong_gia'], 0, ',', '.') }}₫</td>
    <td>
    <form action="/giohang/update" method="POST" style="display:inline-block">
        <input type="hidden" name="item_id" value="{{ $item['id'] }}">
        <button type="submit" name="action" value="decrease" class="btn btn-sm btn-secondary">-</button>
        <span>{{ $item['soluong'] }}</span>
        <button type="submit" name="action" value="increase" class="btn btn-sm btn-secondary">+</button>
    </form>

    <form action="/giohang/delete" method="POST" style="display:inline-block" onsubmit="return confirm('Bạn có chắc muốn xoá?');">
        <input type="hidden" name="item_id" value="{{ $item['id'] }}">
        <button type="submit" class="btn btn-sm btn-danger">🗑️</button>
    </form>
</td>

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