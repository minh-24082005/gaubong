@extends('Admin.layout.sidebar')

@section('content')
    <div class="container-fluid">
        <h1 class="mb-4">Danh sách sản phẩm</h1>

        <!-- Form tìm kiếm -->
        <form method="GET" action="" class="input-group mb-4 w-50">
            <input type="text" name="keyword" class="form-control" placeholder="Tìm sản phẩm..." value="{{ htmlspecialchars($keyword) }}">
            <button class="btn btn-primary" type="submit">Tìm kiếm</button>
        </form>

        <!-- Nút tạo sản phẩm -->
        <div class="mb-3 text-end">
            <a href="/admin/product/create" class="btn btn-success">
                <i class="bi bi-plus-circle"></i> Thêm sản phẩm
            </a>
        </div>

        <!-- Bảng danh sách sản phẩm -->
        <div class="card shadow">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered table-hover align-middle">
                        <thead class="table-light">
                            <tr>
                                <th>ID</th>
                                <th>Sản phẩm</th>
                                <th>Danh mục</th>
                                <th>Giá</th>
                                <th>Trạng thái</th>
                                <th>Hình ảnh</th>
                                <th>Ngày tạo</th>
                                <th>Ngày cập nhật</th>
                                <th>Thao tác</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($products as $product)
                                <tr>
                                    <td>{{ $product['p_id'] }}</td>
                                    <td>{{ $product['p_ten'] }}</td>
                                    <td>{{ $product['c_ten'] }}</td>
                                    <td>{{ number_format($product['p_gia_coso'], 0, ',', '.') }}₫</td>
                                    <td>
                                        <span class="badge bg-{{ $product['p_trang_thai'] === 'còn' ? 'success' : 'secondary' }}">
                                            {{ ucfirst($product['p_trang_thai']) }} hàng
                                        </span>
                                    </td>
                                    <td>
                                        <img src="{{ file_url($product['p_hinhanh']) }}" width="100" class="img-thumbnail" alt="Ảnh sản phẩm">
                                    </td>
                                    <td>{{ $product['p_created_at'] }}</td>
                                    <td>{{ $product['p_update_at'] }}</td>
                                    <td>
                                        <a href="/admin/product/show/{{ $product['p_id'] }}" class="btn btn-info btn-sm mb-1">Xem</a>
                                        <a href="/admin/product/edit/{{ $product['p_id'] }}" class="btn btn-warning btn-sm mb-1">Sửa</a>
                                        <a href="/admin/product/delete/{{ $product['p_id'] }}" class="btn btn-danger btn-sm" onclick="return confirm('Bạn có chắc chắn muốn xóa?')">Xóa</a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <!-- Phân trang -->
                <nav aria-label="Page navigation">
                    <ul class="pagination justify-content-center mt-4">
                        <li class="page-item {{ $page <= 1 ? 'disabled' : '' }}">
                            <a class="page-link" href="?page={{ $page - 1 }}" tabindex="-1">&laquo;</a>
                        </li>

                        @for ($i = 1; $i <= $totalPage; $i++)
                            <li class="page-item {{ $i == $page ? 'active' : '' }}">
                                <a class="page-link" href="?page={{ $i }}">{{ $i }}</a>
                            </li>
                        @endfor

                        <li class="page-item {{ $page >= $totalPage ? 'disabled' : '' }}">
                            <a class="page-link" href="?page={{ $page + 1 }}">&raquo;</a>
                        </li>
                    </ul>
                </nav>

            </div>
        </div>
    </div>
@endsection
