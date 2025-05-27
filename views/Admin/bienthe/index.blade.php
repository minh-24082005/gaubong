@extends('Admin.layout.sidebar')
@section('content')
    <h1>Danh sách biến thể</h1>
    <a href="/admin/bienthe/create" class="btn btn-sm btn-success">Thêm sản phẩm</a>
    <div class="row">
        <div class="col-12 col-xl-15 mb-4 mb-lg-0">
            <div class="card">
                <h5 class="card-header">Danh sách biến thể</h5>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col">ID</th>
                                    <th scope="col">Kích cỡ</th>
                                    <th scope="col">Sản phẩm</th>
                                    <th scope="col">Giá</th>
                                    <th scope="col">Số lượng</th>
                                    <th scope="col">Hành động</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($bienthes as $bienthe)
                                    <tr>
                                        <td>{{ $bienthe['b_id'] }}</td>
                                        <td>{{ $bienthe['b_kich_co'] }}cm</td>
                                        <td>{{ $bienthe['p_ten'] }}</td>
                                        <td>{{$bienthe['b_gia'] }}đ</td>
                                        <td>{{ $bienthe['b_soluong'] }}</td>
                                        <td>
                                            <a href="/admin/bienthe/edit/{{ $bienthe['b_id'] }}" class="btn btn-warning btn-sm mb-1">Sửa</a>
                                            <a href="/admin/bienthe/delete/{{ $bienthe['b_id'] }}" class="btn btn-danger btn-sm" onclick="return confirm('Bạn có chắc chắn muốn xóa?')">Xóa</a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                </div>
            </div>
        </div>

@endsection