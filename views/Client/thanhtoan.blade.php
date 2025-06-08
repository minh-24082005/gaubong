@extends('Client.layouts.main')
@section('title', 'Thanh toán')
@section('content')
<style>
    .checkout-title {
        color: #388e3c;
        font-weight: bold;
        letter-spacing: 1px;
    }
    .billing-form label {
        color: #388e3c;
        font-weight: 500;
    }
    .form-control {
        border-radius: 12px;
        border: 1px solid #c8e6c9;
        box-shadow: none;
    }
    .form-control:focus {
        border-color: #43a047;
        box-shadow: 0 0 0 2px #c8e6c9;
    }
    .btn-primary {
        background: #43a047;
        border: none;
        border-radius: 20px;
        font-weight: 600;
        transition: 0.2s;
    }
    .btn-primary:hover {
        background: #2e7031;
    }
    .cart-detail {
        border-radius: 12px;
        border: 1px solid #c8e6c9;
        background: #f9fff9;
        box-shadow: 0 2px 8px rgba(56, 142, 60, 0.08);
    }
    .cart-detail h3 {
        color: #388e3c;
        font-weight: bold;
    }
    .cart-detail .total-price span:last-child {
        color: #43a047;
        font-size: 1.2em;
        font-weight: bold;
    }
    .radio label, .checkbox label {
        color: #388e3c;
        font-weight: 500;
    }
    .billing-heading {
        color: #43a047;
        font-weight: bold;
    }
    .alert-danger, .alert-success {
        border-radius: 12px;
    }
    .icon-shopping_cart {
        color: #43a047;
    }
    .breadcrumbs a {
        color: #43a047;
        font-weight: 500;
    }
    .breadcrumbs span {
        color: #388e3c;
    }
</style>
<div class="hero-wrap hero-bread" style="background-image: url('/assets/client/images/bg_1.jpg');">
    <div class="container">
        <div class="row no-gutters slider-text align-items-center justify-content-center">
            <div class="col-md-9 ftco-animate text-center">
                <p class="breadcrumbs"><span class="mr-2"><a href="/">Trang chủ</a></span> <span>Thanh toán</span></p>
                <h1 class="mb-0 bread checkout-title"><i class="fas fa-credit-card"></i> Thanh toán</h1>
            </div>
        </div>
    </div>
</div>
<section class="ftco-section">
    <div class="container">
        @if (isset($_SESSION['error']))
            <div class="alert alert-danger">
                {{ $_SESSION['error'] }}
            </div>
        @endif

        <div class="row justify-content-center">
            <div class="col-xl-7 ftco-animate">
                <form action="/checkout/store" method="POST" class="billing-form" id="checkoutForm">
                    <h3 class="mb-4 billing-heading"><i class="fas fa-user"></i> Thông tin thanh toán</h3>
                    <div class="row align-items-end">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="ten">Họ và tên <span class="text-danger">*</span></label>
                                <input type="text" name="ten" class="form-control" required
                                    value="{{ isset($_SESSION['user']['name']) ? $_SESSION['user']['name'] : '' }}">
                                <div class="invalid-feedback">Vui lòng nhập họ tên</div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="dien_thoai">Số điện thoại <span class="text-danger">*</span></label>
                                <input type="text" name="dien_thoai" class="form-control" required
                                    value="{{ isset($_SESSION['user']['dien_thoai']) ? $_SESSION['user']['dien_thoai'] : '' }}">
                                <div class="invalid-feedback">Vui lòng nhập số điện thoại hợp lệ</div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="email">Email <span class="text-danger">*</span></label>
                                <input type="email" name="email" class="form-control" required
                                    value="{{ isset($_SESSION['user']['email']) ? $_SESSION['user']['email'] : '' }}">
                                <div class="invalid-feedback">Vui lòng nhập email hợp lệ</div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="dia_chi">Địa chỉ <span class="text-danger">*</span></label>
                                <input type="text" name="dia_chi" class="form-control" required
                                    value="{{ isset($_SESSION['user']['dia_chi']) ? $_SESSION['user']['dia_chi'] : '' }}">
                                <div class="invalid-feedback">Vui lòng nhập địa chỉ</div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="ghi_chu">Ghi chú</label>
                                <textarea name="ghi_chu" class="form-control" rows="3"></textarea>
                            </div>
                        </div>
                    </div>
            </div>
            <div class="col-xl-5">
                <div class="row mt-5 pt-3">
                    <div class="col-md-12 d-flex mb-5">
                        <div class="cart-detail cart-total p-3 p-md-4">
                            <h3 class="billing-heading mb-4"><i class="fas fa-list"></i> Chi tiết đơn hàng</h3>
                            @if (isset($cartItems) && count($cartItems) > 0)
                                @foreach ($cartItems as $item)
                                    <div class="d-flex justify-content-between mb-3">
                                        <div>
                                            <h6>{{ $item['product_name'] }}</h6>
                                            <p class="text-muted">Size: {{ $item['kich_co'] }}</p>
                                            <p class="text-muted">Số lượng: {{ $item['soluong'] }}</p>
                                        </div>
                                        <div>
                                            <p>{{ number_format($item['tong_gia']) }}đ</p>
                                        </div>
                                    </div>
                                @endforeach
                                <hr>
                                <p class="d-flex total-price">
                                    <span>Tổng tiền</span>
                                    <span>{{ number_format($total) }}đ</span>
                                </p>
                            @else
                                <p class="text-center">Giỏ hàng trống</p>
                            @endif
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="cart-detail p-3 p-md-4">
                            <h3 class="billing-heading mb-4"><i class="fas fa-money-check-alt"></i> Phương thức thanh toán</h3>
                            <div class="form-group">
                                <div class="col-md-12">
                                    <div class="radio">
                                        <label><input type="radio" name="phuong_thuc_thanh_toan" value="cod"
                                                class="mr-2" required> Thanh toán khi nhận hàng (COD)</label>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-md-12">
                                    <div class="radio">
                                        <label><input type="radio" name="phuong_thuc_thanh_toan" value="banking"
                                                class="mr-2"> Chuyển khoản ngân hàng</label>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-md-12">
                                    <div class="checkbox">
                                        <label><input type="checkbox" name="terms" required class="mr-2"> Tôi
                                            đồng ý với các điều khoản và điều kiện</label>
                                    </div>
                                </div>
                            </div>
                            <p><button type="submit" class="btn btn-primary py-3 px-4"><i class="fas fa-paper-plane"></i> Đặt hàng</button></p>
                        </div>
                    </div>
                </div>
            </div>
            </form>
        </div>
    </div>
</section>
<section class="ftco-section ftco-no-pt ftco-no-pb py-5 bg-light">
    <div class="container py-4">
        <div class="row d-flex justify-content-center py-5">
            <div class="col-md-6">
                <h2 style="font-size: 22px; color: #388e3c;" class="mb-0"><i class="fas fa-envelope-open-text"></i> Subcribe to our Newsletter</h2>
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
<script>
    document.getElementById('checkoutForm').addEventListener('submit', function(e) {
        if (!this.checkValidity()) {
            e.preventDefault();
            e.stopPropagation();
        }
        this.classList.add('was-validated');
    });
</script>
<!-- Font Awesome CDN for icons -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"/>
@endsection
