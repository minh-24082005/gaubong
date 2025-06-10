@extends('Client.layouts.main')
@section('title', 'Lịch sử đơn hàng')
@section('content')
<style>
    .order-history-title {
        color: #388e3c;
        font-weight: bold;
        letter-spacing: 1px;
    }
    .table-order {
        border-radius: 12px;
        overflow: hidden;
        box-shadow: 0 2px 8px rgba(56, 142, 60, 0.08);
        background: #fff;
    }
    .table-order th {
        background: #43a047;
        color: #fff;
        border: none;
    }
    .table-order td {
        vertical-align: middle;
        border-color: #c8e6c9;
    }
    .btn-info {
        background: #43a047;
        border: none;
        color: #fff;
        font-weight: 500;
        border-radius: 20px;
        transition: 0.2s;
    }
    .btn-info:hover {
        background: #2e7031;
        color: #fff;
    }
    .order-status {
        font-weight: bold;
        padding: 4px 12px;
        border-radius: 12px;
        display: inline-block;
    }
    .order-status.xuly { background: #fbc02d; color: #fff; }
    .order-status.danggiao { background: #1976d2; }
    .order-status.hoanthanh { background: #388e3c; }
    .order-status.huy { background: #e53935; }
    .table-order .collapse td {
        background: #f1f8e9;
    }
    .table-order th, .table-order td {
        border: 1px solid #c8e6c9 !important;
    }
    .table-order .table-sm th {
        background: #c8e6c9;
        color: #388e3c;
    }
    .table-order .table-sm td {
        background: #f9fff9;
    }
    .table-order .table-bordered.table-hover tbody tr:hover {
        background: #e8f5e9;
    }
    .order-icon {
        color: #43a047;
        margin-right: 6px;
        font-size: 18px;
    }
    .btn-cancel {
        background: #e53935;
        border: none;
        color: #fff;
        font-weight: 500;
        border-radius: 20px;
        transition: 0.2s;
        margin-left: 8px;
    }
    .btn-cancel:hover {
        background: #c62828;
        color: #fff;
    }
    .modal-custom .modal-content {
        border-radius: 15px;
        border: none;
    }
    .modal-custom .modal-header {
        background: #43a047;
        color: white;
        border-radius: 15px 15px 0 0;
        border: none;
    }
    .modal-custom .modal-body {
        padding: 25px;
        text-align: center;
    }
    .modal-custom .modal-footer {
        border-top: none;
        padding: 15px 25px 25px;
    }
    .modal-custom .btn-close {
        color: white;
    }
    .modal-custom .alert-icon {
        font-size: 48px;
        color: #43a047;
        margin-bottom: 20px;
    }
    .toast-custom {
        background: #43a047;
        color: white;
    }
</style>
<div class="container py-5">
    <h2 class="mb-4 order-history-title"><i class="order-icon fas fa-history"></i>Lịch sử đơn hàng của bạn</h2>
    @if(count($orders) == 0)
        <div class="alert alert-info">Bạn chưa có đơn hàng nào.</div>
    @else
        <div class="table-responsive">
            <table class="table table-bordered table-order">
                <thead>
                    <tr>
                        <th><i class="fas fa-receipt"></i> Mã đơn</th>
                        <th><i class="fas fa-receipt"></i> tổng mặt hàng</th>
                        <th><i class="fas fa-calendar-alt"></i> Ngày đặt</th>
                        <th><i class="fas fa-info-circle"></i> Trạng thái</th>
                        <th><i class="fas fa-money-bill-wave"></i> Tổng tiền</th>
                        <th><i class="fas fa-eye"></i> Chi tiết</th>
                    </tr>
                </thead>
                <tbody>
                @foreach($orders as $order)
                    <tr>
                        <td>#{{ $order['id'] }}</td>
                        <td>{{ $order['tong_mathang'] }}</td>
                        <td>{{ $order['ngay_capnhat'] }}</td>
                        <td>
                            @if($order['trangthai'] == 'xử lý')
                                <button class="btn btn-warning btn-sm" >Đang xử lý</button>
                            @elseif($order['trangthai'] == 'vận chuyển')
                                <button class="btn btn-info btn-sm">Đang giao</button>
                            @elseif($order['trangthai'] == 'đã giao')
                                <button class="btn btn-success btn-sm">Đã giao</button>
                            @elseif($order['trangthai'] == 'đã hủy')
                                <button class="btn btn-danger btn-sm">Đã hủy</button>
                            @else
                                <button class="btn btn-secondary btn-sm">{{ $order['trangthai'] }}</button>
                            @endif
                        </td>
                        <td>{{ number_format($order['tong_gia']) }}đ</td>
                        <td>
                            <button class="btn btn-sm btn-info" type="button" data-toggle="collapse" data-target="#order-{{ $order['id'] }}">Xem</button>
                            @if($order['trangthai'] == 'xử lý')
                                <button  class="btn btn-sm btn-cancel"  onclick="confirmCancel({{ $order['id'] }})">Hủy đơn</button>
                            @else
                                <button class="btn btn-sm btn-cancel"  onclick="showCancelAlert('{{ $order['trangthai'] }}')">Hủy đơn</button>
                            @endif
                        </td>
                    </tr>
                    <tr class="collapse" id="order-{{ $order['id'] }}">
                        <td colspan="5">
                            <table class="table table-sm mb-0">
                                <tbody>
                                    <tr>
                                        <th style="width: 180px;">Địa chỉ nhận</th>
                                        <td>{{ $order['dia_chi'] }}</td>
                                    </tr>
                                    <tr>
                                        <th>Số điện thoại</th>
                                        <td>{{ $order['dien_thoai'] }}</td>
                                    </tr>
                                    <tr>
                                        <th>Email</th>
                                        <td>{{ $order['email'] }}</td>
                                    </tr>
                                    <tr>
                                        <th>Ghi chú</th>
                                        <td>{{ $order['ghi_chu'] ?? '' }}</td>
                                    </tr>
                                </tbody>
                            </table>
                            <hr>
                            <strong>Chi tiết sản phẩm:</strong>
                            <div class="table-responsive">
                                <table class="table table-bordered table-hover mb-0">
                                    <thead>
                                        <tr>
                                            <th>Mã sản phẩm</th>
                                            <th>ảnh</th>
                                            <th>Tên sản phẩm</th>
                                            <th>kích thước</th>
                                            <th>Số lượng</th>
                                            <th>Giá</th>
                                            <th>Tổng</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($order['items'] as $item)
                                            <tr>
                                                <td>{{ $item['id_sanpham'] }}</td>
                                                <td><img src="{{file_url($item['hinh_sanpham']) }}" alt="ảnh sản phẩm" style="width: 60px; height: auto;"></td>
                                                <td>{{ $item['ten_sanpham'] }}</td>
                                                <td>{{ $item['kich_co'] }}cm</td>
                                                <td>{{ $item['soluong'] }}</td>
                                                <td>{{ number_format($item['gia']) }}đ</td>
                                                <td>{{ number_format($item['tong_gia']) }}đ</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    @endif
    <section class="ftco-section ftco-no-pt ftco-no-pb py-5 bg-light">
        <div class="container py-4">
            <div class="row d-flex justify-content-center py-5">
                <div class="col-md-6">
                    <h2 style="font-size: 22px;" class="mb-0">Subcribe to our Newsletter</h2>
                    <span>Get e-mail updates about our latest shops and special offers</span>
                </div>
                <div class="col-md-6 d-flex align-items-center">
                    <form action="#" class="subscribe-form">
                        <div class="form-group d-flex">
                            <input type="text" class="form-control" placeholder="Enter email address">
                            <input type="submit" value="Subscribe" class="submit px-3">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
</div>

<!-- Modal thông báo không thể hủy đơn -->
<div class="modal fade modal-custom" id="cancelAlertModal" tabindex="-1" aria-labelledby="cancelAlertModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="cancelAlertModalLabel">Không thể hủy đơn hàng</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <i class="fas fa-exclamation-circle alert-icon"></i>
                <h4 class="mb-3">Thông báo</h4>
                <p id="cancelAlertMessage" class="mb-0"></p>
            </div>
            <div class="modal-footer justify-content-center">
                <button type="button" class="btn btn-success px-4" data-bs-dismiss="modal">Đóng</button>
            </div>
        </div>
    </div>
</div>

<!-- Modal xác nhận hủy đơn -->
<div class="modal fade modal-custom" id="confirmCancelModal" tabindex="-1" aria-labelledby="confirmCancelModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="confirmCancelModalLabel">Xác nhận hủy đơn hàng</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <i class="fas fa-question-circle alert-icon"></i>
                <h4 class="mb-3">Bạn có chắc chắn muốn hủy đơn hàng này?</h4>
                <p class="mb-0">Hành động này không thể hoàn tác.</p>
            </div>
            <div class="modal-footer justify-content-center">
                <button type="button" class="btn btn-secondary px-4" data-bs-dismiss="modal">Đóng</button>
                <form id="cancelOrderForm" method="POST">
                    @csrf
                    <button type="submit" class="btn btn-danger">Xác nhận hủy</button>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Toast thông báo -->
<div class="position-fixed bottom-0 end-0 p-3" style="z-index: 11">
    <div id="toast" class="toast toast-custom" role="alert" aria-live="assertive" aria-atomic="true">
        <div class="toast-header">
            <strong class="me-auto">Thông báo</strong>
            <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
        </div>
        <div class="toast-body" id="toastMessage"></div>
    </div>
</div>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>

<script>
let currentOrderId = null;
let cancelAlertModal;
let confirmCancelModal;
let toast;

document.addEventListener('DOMContentLoaded', function() {
    // Khởi tạo các modal
    cancelAlertModal = new bootstrap.Modal(document.getElementById('cancelAlertModal'));
    confirmCancelModal = new bootstrap.Modal(document.getElementById('confirmCancelModal'));
    toast = new bootstrap.Toast(document.getElementById('toast'));

    // Gán sự kiện cho nút xác nhận hủy
    document.getElementById('confirmCancelBtn').addEventListener('click', function() {
        cancelOrder();
    });
});

function showCancelAlert(status) {
    const statusMap = {
        'vận chuyển': 'đang vận chuyển',
        'đã giao': 'đã giao',
        'đã hủy': 'đã hủy'
    };
    const statusText = statusMap[status] || status;
    document.getElementById('cancelAlertMessage').textContent = `Bạn không thể hủy đơn khi đơn hàng đang ${statusText}`;
    cancelAlertModal.show();
}

function confirmCancel(orderId) {
    // Cập nhật action của form
    document.getElementById('cancelOrderForm').action = '/cancel-order/' + orderId;
    // Hiển thị modal
    var modal = new bootstrap.Modal(document.getElementById('confirmCancelModal'));
    modal.show();
}

function showToast(message) {
    document.getElementById('toastMessage').textContent = message;
    toast.show();
}

function cancelOrder() {
    if (!currentOrderId) return;

    const button = document.getElementById('confirmCancelBtn');
    button.disabled = true;
    button.innerHTML = '<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Đang xử lý...';

    fetch(`/cancel-order/${currentOrderId}`, {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-Requested-With': 'XMLHttpRequest'
        }
    })
    .then(response => {
        if (!response.ok) {
            throw new Error('Network response was not ok');
        }
        return response.json();
    })
    .then(data => {
        confirmCancelModal.hide();
        if (data.success) {
            showToast(data.message);
            setTimeout(() => {
                location.reload();
            }, 1500);
        } else {
            showToast(data.message || 'Có lỗi xảy ra khi hủy đơn hàng');
        }
    })
    .catch(error => {
        console.error('Error:', error);
        confirmCancelModal.hide();
        showToast('Có lỗi xảy ra khi hủy đơn hàng');
    })
    .finally(() => {
        button.disabled = false;
        button.innerHTML = 'Xác nhận hủy';
    });
}
</script>

<!-- Font Awesome CDN for icons -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"/>
@endsection 