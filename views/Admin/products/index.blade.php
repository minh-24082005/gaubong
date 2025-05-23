@extends('Admin.layout.sidebar')
@section('content')
    <h1>Danh sách sản phẩm</h1>
    <div class="row">
        <form method="GET" action="">
    <input type="text" name="keyword" placeholder="Tìm sản phẩm..." value="<?= htmlspecialchars($keyword) ?>">
    <button type="submit">Tìm kiếm</button>
</form>
        <div class="col-12 col-xl-15 mb-4 mb-lg-0">
            <div class="card">
                <a href="/admin/product/create" class="btn btn-sm btn-success">Create</a>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col">ID</th>
                                    <th scope="col">sản phẩm</th>
                                    <th scope="col">danh mục</th>
                                    <th scope="col">giá</th>
                                    <th scope="col">trạng thái</th>
                                    <th scope="col">hình ảnh</th>
                                    <th scope="col">created_at</th>
                                    <th scope="col">updated_at</th>
                                    <th scope="col">thao tác</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($products as $product)
                                    <tr>

                                        <td>{{ $product['p_id'] }}</td>
                                        <td>{{ $product['p_ten'] }}</td>
                                        <td>{{ $product['c_ten'] }}</td>
                                        <td>{{ $product['p_gia_coso'] }}</td>
                                        <td>{{ $product['p_trang_thai'] }} hàng</td>
                                        <td><img src="{{file_url ($product['p_hinhanh'])}}" width="150" alt="Ảnh sản phẩm"></td>
                                        <td>{{ $product['p_created_at'] }}</td>
                                        <td>{{ $product['p_update_at'] }}</td>
                                        <td>
                                            <a href="/admin/product/show/{{ $product['p_id'] }}"
                                                class="btn btn-sm btn-primary">show</a>
                                            <a href="/admin/product/edit/{{ $product['p_id'] }}"
                                                class="btn btn-sm btn-primary">edit</a>
                                            <a href="/admin/product/delete/{{ $product['p_id'] }}"
                                                class="btn btn-sm btn-primary">delete</a>

                                        </td>
                                    </tr>
                                @endforeach


                            </tbody>
                        </table>
                    </div>

                </div>
            </div>
        </div>

        <nav aria-label="Page navigation">
            <ul class="pagination justify-content-center">

                {{-- Nút Previous --}}
                <li class="page-item {{ $page <= 1 ? 'disabled' : '' }}">
                    <a class="page-link" href="?page={{ $page - 1 }}" tabindex="-1">
                        &laquo;
                    </a>
                </li>

                {{-- Các số trang --}}
                @for ($i = 1; $i <= $totalPage; $i++)
                    <li class="page-item {{ $i == $page ? 'active' : '' }}">
                        <a class="page-link" href="?page={{ $i }}">{{ $i }}</a>
                    </li>
                @endfor

                {{-- Nút Next --}}
                <li class="page-item {{ $page >= $totalPage ? 'disabled' : '' }}">
                    <a class="page-link" href="?page={{ $page + 1 }}">
                        &raquo;
                    </a>
                </li>

            </ul>
        </nav>

@endsection