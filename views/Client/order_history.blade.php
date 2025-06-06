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
        color: #fff;
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
                        <td>{{ $order['ngay_capnhat'] }}</td>
                        <td>
                            <span class="order-status {{ strtolower(str_replace(' ', '', $order['trangthai'])) }}">
                                @if($order['trangthai'] == 'xử lý') Đang xử lý
                                @elseif($order['trangthai'] == 'danggiao') Đang giao
                                @elseif($order['trangthai'] == 'hoanthanh') Hoàn thành
                                @elseif($order['trangthai'] == 'huy') Đã hủy
                                @else {{ $order['trangthai'] }}
                                @endif
                            </span>
                        </td>
                        <td>{{ number_format($order['tong_gia']) }}đ</td>
                        <td>
                            <button class="btn btn-sm btn-info" type="button" data-toggle="collapse" data-target="#order-{{ $order['id'] }}">Xem</button>
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
                                            <th>Mã biến thể</th>
                                            <th>Số lượng</th>
                                            <th>Giá</th>
                                            <th>Tổng</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($order['items'] as $item)
                                            <tr>
                                                <td>{{ $item['id_sanpham'] }}</td>
                                                <td>{{ $item['id_bien'] }}</td>
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
<!-- Font Awesome CDN for icons -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"/>
@endsection 