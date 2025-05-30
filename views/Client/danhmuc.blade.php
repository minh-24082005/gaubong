@extends('Client.layouts.main')

@section('content')

{{-- Form tìm kiếm & sắp xếp --}}
<form method="GET" action="">
    {{-- Giữ lại ID danh mục nếu có --}}
    @if ($category_id)
        <input type="hidden" name="id" value="{{ $category_id }}">
    @endif

    <input type="text" name="keyword" value="{{ $keyword ?? '' }}" placeholder="Nhập từ khóa (chỉ tìm kiếm)">
    
    <select name="sort">
        <option value="">Mặc định</option>
        <option value="asc" {{ ($sort ?? '') == 'asc' ? 'selected' : '' }}>Giá thấp đến cao</option>
        <option value="desc" {{ ($sort ?? '') == 'desc' ? 'selected' : '' }}>Giá cao đến thấp</option>
    </select>
    
    <button type="submit" class="btn btn-primary">Tìm</button>
</form>

<div class="container mt-4">

    {{-- Danh mục --}}
    <div class="mb-4">
        <h4>Danh mục sản phẩm:</h4>
        <ul class="list-unstyled d-flex flex-wrap gap-2">
            @foreach ($category as $cat)
                <li>
                    <a href="/danhmuc?id={{ $cat['id'] }}" class="btn btn-outline-primary {{ $category_id == $cat['id'] ? 'active' : '' }}">
                        {{ $cat['ten'] }}
                    </a>
                </li>
            @endforeach
        </ul>
    </div>

    {{-- Sản phẩm --}}
    <div class="row">
        @forelse ($products as $product)
            <div class="col-md-3">
                <div class="card mb-4">
                    <img src="{{ file_url($product['hinhanh']) }}" class="card-img-top" alt="{{ $product['ten'] }}">
                    <div class="card-body text-center">
                        <h5 class="card-title">{{ $product['ten'] }}</h5>
                        <p class="text-danger">{{ number_format($product['gia_coso']) }} đ</p>
                        <a href="/chitiet/{{ $product['id'] }}" class="btn btn-sm btn-primary">Xem chi tiết</a>
                    </div>
                </div>
            </div>
        @empty
            <p class="text-muted">Không có sản phẩm nào.</p>
        @endforelse
    </div>

    {{-- Phân trang --}}
    @if ($totalPage > 1)
        <nav>
            <ul class="pagination justify-content-center">
                {{-- Nút Trước --}}
                <li class="page-item {{ $page <= 1 ? 'disabled' : '' }}">
                    <a class="page-link" href="/danhmuc?id={{ $category_id }}&page={{ $page - 1 }}&keyword={{ urlencode($keyword) }}&sort={{ $sort }}">«</a>
                </li>

                {{-- Các số trang --}}
                @for ($i = 1; $i <= $totalPage; $i++)
                    <li class="page-item {{ $i == $page ? 'active' : '' }}">
                        <a class="page-link" href="/danhmuc?id={{ $category_id }}&page={{ $i }}&keyword={{ urlencode($keyword) }}&sort={{ $sort }}">{{ $i }}</a>
                    </li>
                @endfor

                {{-- Nút Tiếp --}}
                <li class="page-item {{ $page >= $totalPage ? 'disabled' : '' }}">
                    <a class="page-link" href="/danhmuc?id={{ $category_id }}&page={{ $page + 1 }}&keyword={{ urlencode($keyword) }}&sort={{ $sort }}">»</a>
                </li>
            </ul>
        </nav>
    @endif

</div>

@endsection
