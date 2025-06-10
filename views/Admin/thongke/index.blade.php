@extends('Admin.layout.sidebar')
@section('content')
<div class="container mt-4">
    <h3>Thống kê sản phẩm đã giao</h3>
    <table class="table table-bordered table-striped mt-3">
        <thead>
            <tr>
                <th>Mã SP</th>
                <th>Tên SP</th>
                <th>Biến thể</th>
                <th>Giá</th>
                <th>Số lượng đã giao</th>
                <th>Doanh thu</th>
            </tr>
        </thead>
        <tbody>
            @foreach($sanPhamDaGiao as $item)
                <tr>
                    <td>{{ $item['ma_san_pham'] }}</td>
                    <td>{{ $item['ten_san_pham'] }}</td>
                    <td>{{ $item['kich_co'] }}</td>
                    <td>{{ number_format($item['gia'], 0, ',', '.') }} đ</td>
                    <td>{{ $item['so_luong_da_giao'] }}</td>
                    <td>{{ number_format($item['tong_doanh_thu'], 0, ',', '.') }} đ</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
