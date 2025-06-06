@extends('Client.layouts.main')
@section('title', 'Giỏ hàng')
@section('content')
<div class="container my-5">
    <div class="row justify-content-center">
        <div class="col-md-15">
            <div class="card shadow-sm">
                <div class="card-header text-center bg-primary text-white">
                    <h4 class="mb-0">🛒 Giỏ hàng của bạn</h4>
                </div>
                <div class="card-body">
                    @if (empty($giohang))
                        <p class="text-center text-muted">Giỏ hàng của bạn hiện đang trống.</p>
                    @else
                        <div class="table-responsive">
                            <table class="table table-bordered align-middle text-center">
                                <thead class="table-light">
                                    <tr>
                                        <th>Ảnh</th>
                                        <th>Tên sản phẩm</th>
                                        <th>Kích cỡ</th>
                                        <th>Giá</th>
                                        <th>Số lượng</th>
                                        <th>Tổng</th>
                                        <th>Thao tác</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($giohang as $item)
                                    <tr>
                                        <td><img src="{{ file_url($item['hinhanh']) }}" width="60" class="rounded"></td>
                                        <td>{{ $item['product_name'] }}</td>
                                        <td>{{ $item['kich_co'] }}cm</td>
                                        <td>{{ number_format($item['gia'], 0, ',', '.') }}₫</td>
                                        <td>
                                            <form action="/giohang/update" method="POST" class="d-inline">
                                                <input type="hidden" name="item_id" value="{{ $item['id'] }}">
                                                <button type="submit" name="action" value="decrease" class="btn btn-sm btn-outline-secondary">−</button>
                                                <span class="mx-2">{{ $item['soluong'] }}</span>
                                                <button type="submit" name="action" value="increase" class="btn btn-sm btn-outline-secondary">+</button>
                                            </form>
                                        </td>
                                        <td>{{ number_format($item['tong_gia'], 0, ',', '.') }}₫</td>
                                        <td>
                                            <form action="/giohang/delete" method="POST" onsubmit="return confirm('Bạn có chắc muốn xoá?');" class="d-inline">
                                                <input type="hidden" name="item_id" value="{{ $item['id'] }}">
                                                <button type="submit" class="btn btn-sm btn-outline-danger">
                                                    🗑️
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>

                        <div class="d-flex justify-content-end mt-4">
                            <h5><strong>Tổng tiền:</strong> {{ number_format($tong_tien, 0, ',', '.') }}₫</h5>
                        </div>

                        <div class="text-center mt-4">
                            <a href="/checkout" class="btn btn-success btn-lg px-5">Tiến hành thanh toán</a>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
