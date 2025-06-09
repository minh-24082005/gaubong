  @extends('Admin.layout.sidebar')
@section('content')
<div class="container mt-4">
    <h2 class="text-success">Chỉnh sửa đơn hàng #{{ $order['id'] }}</h2>
    <form action="/admin/orders/{{ $order['id'] }}/update" method="POST" class="card p-4 shadow-sm border-success">
        <div class="row">
            <div class="col-md-6 mb-3">
                <label class="form-label">Tên khách hàng</label>
                <input type="text" name="ten" class="form-control border-success" value="{{ $order['ten'] }}" required>
            </div>
            <div class="col-md-6 mb-3">
                <label class="form-label">Email</label>
                <input type="email" name="email" class="form-control border-success" value="{{ $order['email'] }}" required>
            </div>
            <div class="col-md-6 mb-3">
                <label class="form-label">Số điện thoại</label>
                <input type="text" name="dien_thoai" class="form-control border-success" value="{{ $order['dien_thoai'] }}" required>
            </div>
            <div class="col-md-6 mb-3">
                <label class="form-label">Địa chỉ</label>
                <input type="text" name="dia_chi" class="form-control border-success" value="{{ $order['dia_chi'] }}" required>
            </div>
            <div class="col-md-6 mb-3">
                <label class="form-label">Thành phố</label>
                <input type="text" name="vanchuyen_thanhpho" class="form-control border-success" value="{{ $order['vanchuyen_thanhpho'] }}">
            </div>
            <div class="col-md-6 mb-3">
                <label class="form-label">Tổng mặt hàng</label>
                <input type="number" name="tong_mathang" class="form-control border-success" value="{{ $order['tong_mathang'] }}" min="1" required>
            </div>
            <div class="col-md-6 mb-3">
                <label class="form-label">Tổng giá</label>
                <input type="number" name="tong_gia" class="form-control border-success" value="{{ $order['tong_gia'] }}" min="0" required>
            </div>
            <div class="col-md-6 mb-3">
                <label class="form-label fw-bold">Trạng thái đơn hàng</label>
                <select name="trangthai" class="form-select border-success text-success" required>
                    <?php
                    $trangThaiHienTai = $order['trangthai'];
                    $trangThaiList = [
                        'xử lý' => 'Xử lý',
                        'vận chuyển' => 'Vận chuyển',
                        'đã giao' => 'Đã giao',
                        'đã hủy' => 'Đã hủy',
                    ];
                    foreach ($trangThaiList as $value => $label):
                        $disabled = false;
                        // Nếu đang ở trạng thái "vận chuyển" thì không cho chọn lại "xử lý" hoặc "đã hủy"
                        if ($trangThaiHienTai === 'vận chuyển' && ($value === 'xử lý' || $value === 'đã hủy') && $value !== $trangThaiHienTai) {
                            $disabled = true;
                        }
                        // Nếu đang ở trạng thái "đã giao" hoặc "đã hủy" thì chỉ cho giữ nguyên
                        if (($trangThaiHienTai === 'đã giao' || $trangThaiHienTai === 'đã hủy') && $value !== $trangThaiHienTai) {
                            $disabled = true;
                        }
                        // Nếu đang ở trạng thái "xử lý" thì cho phép chuyển sang bất kỳ trạng thái nào khác
                    ?>
                        <option value="<?= $value ?>" <?= $trangThaiHienTai === $value ? 'selected' : '' ?> <?= $disabled ? 'disabled' : '' ?>><?= $label ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
        </div>
        <button type="submit" class="btn btn-success">Lưu thay đổi</button>
        <a href="/admin/orders" class="btn btn-outline-success ms-2">Quay lại</a>
    </form>
    @if(session('msg'))
        <div class="alert alert-success alert-dismissible fade show mt-3" role="alert">
            {{ session('msg') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
</div>
@endsection
@section('scripts')
<script>
    // Hiển thị popup thông báo nếu có
    if(document.querySelector('.alert')){
        setTimeout(()=>{
            let alert = document.querySelector('.alert');
            if(alert) alert.classList.remove('show');
        }, 3000);
    }
</script>
@endsection
