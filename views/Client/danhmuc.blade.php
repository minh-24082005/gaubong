@extends('Client.layouts.main')

@section('content')
<h2>chọn kích thước</h2>

<div class="container mt-4">

    {{-- Hiển thị danh sách danh mục --}}
    <div class="mb-4">
        <h4>Danh mục sản phẩm:</h4>
        <ul class="list-unstyled d-flex flex-wrap gap-2">
            @foreach ($category as $cat)
                <li>
                    <a href="/danhmuc?id={{ $cat['id'] }}" class="btn btn-outline-primary">
                        {{ $cat['ten'] }}
                    </a>
                </li>
            @endforeach
        </ul>
    </div>

    {{-- Hiển thị sản phẩm --}}
    <div class="row">
        @if ($category_id == 0)
            {{-- Nếu chưa chọn danh mục, hiển thị 10 sản phẩm mới nhất --}}
            @forelse ($productss as $product)
                <div class="col-md-3">
                    <div class="card mb-4">
                        <img src="{{ file_url($product['hinhanh']) }}" class="card-img-top" alt="{{ $product['ten'] }}">
                        <div class="card-body">
                            <h5 class="card-title">{{ $product['ten'] }}</h5>
                            <p class="text-danger">{{ number_format($product['gia_coso']) }} đ</p>
                            <a href="/chitiet/{{ $product['id'] }}" class="btn btn-sm btn-primary">Chi tiết</a>
                        </div>
                    </div>
                </div>
            @empty
                <p class="text-muted">Không có sản phẩm nào.</p>
            @endforelse
        @else
            {{-- Nếu đã chọn danh mục, hiển thị sản phẩm phân trang --}}
            @forelse ($products as $product)
                <div class="col-md-3">
                    <div class="card mb-4">
                        <img src="{{ file_url($product['hinhanh']) }}" class="card-img-top" alt="{{ $product['ten'] }}">
                        <div class="card-body">
                            <h5 class="card-title">{{ $product['ten'] }}</h5>
                            <p class="text-danger">{{ number_format($product['gia_coso']) }} đ</p>
                            <a href="/chitiet/{{ $product['id'] }}" class="btn btn-sm btn-primary">Chi tiết</a>
                        </div>
                    </div>
                </div>
            @empty
                <p class="text-muted">Không có sản phẩm nào trong danh mục này.</p>
            @endforelse
        @endif
    </div>

    {{-- Hiển thị phân trang nếu có danh mục --}}
@if ($category_id && $totalPage > 1)
    <nav>
        <ul class="pagination justify-content-center">

            {{-- Nút "Trước" --}}
            <li class="page-item {{ $page <= 1 ? 'disabled' : '' }}">
                <a class="page-link" href="/danhmuc?id={{ $category_id }}&page={{ $page - 1 }}">«</a>
            </li>

            {{-- Các số trang --}}
            @for ($i = 1; $i <= $totalPage; $i++)
                <li class="page-item {{ $i == $page ? 'active' : '' }}">
                    <a class="page-link" href="/danhmuc?id={{ $category_id }}&page={{ $i }}">{{ $i }}</a>
                </li>
            @endfor

            {{-- Nút "Tiếp" --}}
            <li class="page-item {{ $page >= $totalPage ? 'disabled' : '' }}">
                <a class="page-link" href="/danhmuc?id={{ $category_id }}&page={{ $page + 1 }}">»</a>
            </li>

        </ul>
    </nav>
@endif


</div>
@endsection
