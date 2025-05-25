@extends('admin.layout.sidebar')

@section('content')
<div class="container-fluid">
    <h2 class="mb-4">Chi tiết sản phẩm</h2>

    <div class="card shadow mb-4">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h5 class="mb-0">Thông tin sản phẩm</h5>
            <a href="/admin/users/create" class="btn btn-success btn-sm">
                <i class="bi bi-plus-circle"></i> Tạo mới
            </a>
        </div>

        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered align-middle">
                    <thead class="table-light">
                        <tr>
                            <th scope="col" style="width: 25%">Trường dữ liệu</th>
                            <th scope="col">Giá trị</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($product as $field => $value)
                            <tr>
                                <td class="fw-bold text-uppercase">{{ $field }}</td>
                                <td>
                                    @switch($field)
                                        @case('p_hinhanh')
                                            <img src="{{ file_url($value) }}" width="200" class="img-thumbnail" alt="Hình ảnh sản phẩm">
                                            @break

                                        @default
                                            {!! (($value)) !!}
                                    @endswitch
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
