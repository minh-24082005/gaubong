  @extends('Admin.layout.sidebar')
@section('content')
<div class="container mt-4">
    <h2 class="mb-4 text-success">Danh sách đơn hàng</h2>
    @if(session('msg'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('msg') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
    <table class="table table-bordered table-hover align-middle border-success">
        <thead class="bg-success text-white">
            <tr>
                <th>ID</th>
                <th>Khách hàng</th>
                <th>Email</th>
                <th>Điện thoại</th>
                <th>Tổng mặt hàng</th>
                <th>Tổng giá</th>
                <th>Trạng thái</th>
                <th>Ngày cập nhật</th>
                <th>Hành động</th>
            </tr>
        </thead>
        <tbody>
            @foreach($orders as $order)
            <tr>
                <td class="text-success fw-bold">{{ $order['id'] }}</td>
                <td>{{ $order['ten'] }}</td>
                <td>{{ $order['email'] }}</td>
                <td>{{ $order['dien_thoai'] }}</td>
                <td>{{ $order['tong_mathang'] }}</td>
                <td class="text-success">{{ number_format($order['tong_gia']) }}₫</td>
                <td>
                    <span class="badge bg-{{ $order['trangthai']==='đã hủy' ? 'danger' : ($order['trangthai']==='đã giao' ? 'success' : 'warning') }}">
                        {{ $order['trangthai'] }}
                    </span>
                </td>
                <td>{{ $order['ngay_capnhat'] }}</td>
                <td>
                    <a href="/admin/orders/{{ $order['id'] }}/show" class="btn btn-success btn-sm">Chi tiết</a>
                    <a href="/admin/orders/{{ $order['id'] }}/edit" class="btn btn-outline-success btn-sm">Sửa</a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    {{-- PHÂN TRANG --}}
    @if(isset($totalPage) && $totalPage > 1)
    <nav aria-label="Page navigation">
        <ul class="pagination justify-content-end">
            @php $query = $_GET; @endphp
            <li class="page-item {{ $page <= 1 ? 'disabled' : '' }}">
                @php $query['page'] = $page-1; @endphp
                <a class="page-link text-success" href="?{{ http_build_query($query) }}">&laquo;</a>
            </li>
            @for($i = 1; $i <= $totalPage; $i++)
                @php $query['page'] = $i; @endphp
                <li class="page-item {{ $i == $page ? 'active' : '' }}">
                    <a class="page-link {{ $i == $page ? 'bg-success border-success text-white' : 'text-success' }}" href="?{{ http_build_query($query) }}">{{ $i }}</a>
                </li>
            @endfor
            <li class="page-item {{ $page >= $totalPage ? 'disabled' : '' }}">
                @php $query['page'] = $page+1; @endphp
                <a class="page-link text-success" href="?{{ http_build_query($query) }}">&raquo;</a>
            </li>
        </ul>
    </nav>
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
