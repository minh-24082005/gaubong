  @extends('Admin.layout.sidebar')
@section('content')
<div class="container mt-4">
    <h2 class="text-success">Chi tiết đơn hàng #{{ $order['id'] }}</h2>
    <div class="card mb-4 border-success">
        <div class="card-body">
            <div class="row mb-2">
                <div class="col-md-4">
                    <h5 class="fw-bold text-success">Thông tin người đặt</h5>
                    <div><b>{{ $order['ten'] }}</b></div>
                    <div>Email: {{ $order['email'] }}</div>
                    <div>Số điện thoại: {{ $order['dien_thoai'] }}</div>
                </div>
                <div class="col-md-4">
                    <h5 class="fw-bold text-success">Người nhận</h5>
                    <div><b>{{ $order['ten'] }}</b></div>
                    <div>Email: {{ $order['email'] }}</div>
                    <div>Số điện thoại: {{ $order['dien_thoai'] }}</div>
                    <div>Địa chỉ: {{ $order['dia_chi'] }}</div>
                </div>
                <div class="col-md-4">
                    <h5 class="fw-bold text-success">Thông tin</h5>
                    <div><b>Mã đơn hàng: DH-{{ $order['id'] }}</b></div>
                    <div>
                        Trạng thái: 
                        <span class="badge bg-{{ $order['trangthai']==='đã hủy' ? 'danger' : ($order['trangthai']==='đã giao' ? 'success' : ($order['trangthai']==='vận chuyển' ? 'primary' : 'warning')) }}">
                            {{ ucfirst($order['trangthai']) }}
                        </span>
                    </div>
                    <div>Tổng tiền: {{ number_format($order['tong_gia']) }} ₫</div>
                    <div>Ghi chú: {{ $order['ghichu'] ?? 'Không có' }}</div>
                    <div>Địa chỉ: {{ $order['dia_chi'] }}</div>
                    <div>Thanh toán: {{ $order['thanhtoan'] ?? 'Không có' }}</div>
                    <div class="text-end">Ngày đặt: {{ date('d-m-Y', strtotime($order['ngay_capnhat'])) }}</div>
                </div>
            </div>
        </div>
    </div>
    <h5 class="text-success">Sản phẩm trong đơn hàng</h5>
    <table class="table table-bordered table-hover align-middle border-success">
        <thead class="bg-success text-white">
            <tr>
                <th>ID</th>
                <th>ID Sản phẩm</th>
                <th>ID Biến thể</th>
                <th>Số lượng</th>
                <th>Giá</th>
                <th>Tổng giá</th>
            </tr>
        </thead>
        <tbody>
            @foreach($order['items'] as $item)
            <tr>
                <td class="text-success fw-bold">{{ $item['id'] }}</td>
                <td>{{ $item['id_sanpham'] }}</td>
                <td>{{ $item['id_bien'] }}</td>
                <td>{{ $item['soluong'] }}</td>
                <td class="text-success">{{ number_format($item['gia']) }}₫</td>
                <td class="text-success">{{ number_format($item['tong_gia']) }}₫</td>
            </tr>
            @endforeach
        </tbody>
    </table>
    <a href="/admin/orders" class="btn btn-success mt-3">Quay lại</a>
</div>
@endsection
