  @extends('Admin.layout.sidebar')
@section('title', 'Danh sách người dùng')

@section('content')
    {{-- <nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="#">Home</a></li>
        <li class="breadcrumb-item active" aria-current="page">Overview</li>
    </ol>
</nav> --}}
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Danh sách người dùng</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Danh sách người dùng</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>
    @include('admin.components.display-msg-fail')
    @include('admin.components.display-msg-success')
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <a href="/admin/users/create" class="btn btn-primary">
                                <span><i class="fas fa-plus"></i></span>
                                <span class="ml-2">Thêm mới dữ liệu</span>
                            </a>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table id="example1" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>STT</th>
                                        <th>Họ và tên</th>
                                        <th>Email</th>
                                        <th>Điện thoại</th>
                                        <th>Địa chỉ</th>
                                        <th>Thành phố</th>
                                        <th>Vai trò</th>
                                        <th class="text-center">Hành động</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($dataUser as $index => $user)
                                        <tr>

                                            <td>{{ $index + 1 }}</td>
                                           
                                            <td>{{ $user['name'] }}</td>
                                            <td>{{ $user['email'] }}</td>
                                            <td>{{ $user['dien_thoai'] }}</td>
                                            <td>{{ $user['dia_chi'] }}</td>
                                            <td>{{ $user['thanhpho'] }}</td>
                                            <td>
                                                @if ($user['type'] == 'admin')
                                                    <span class="badge bg-danger">Quản trị viên</span>
                                                @else
                                                    <span class="badge bg-info">Người dùng</span>
                                                @endif
                                            </td>
                                            <td class="text-center">
                                                <a href="/admin/users/show/{{ $user['id'] }}"
                                                    class="btn btn-primary">Show<i class="fa-solid fa-eye"></i></a>
                                                <a href="/admin/users/edit/{{ $user['id'] }}"
                                                    class="btn btn-warning text-light">Edit<i
                                                        class="fa-solid fa-pen-to-square"></i></a>
                                                <a onclick="return confirm('Bạn có muốn xóa không?')"
                                                    href="/admin/users/delete/{{ $user['id'] }}"
                                                    class="btn btn-danger">Delete<i class="fa-solid fa-trash-can"></i></a>
                                            </td>
                                        </tr>
                                    @endforeach
                                     <tfoot>
                                    <tr>
                                        <th>STT</th>
                                        <th>Họ và tên</th>
                                        <th>Email</th>
                                        <th>Điện thoại</th>
                                        <th>Địa chỉ</th>
                                        <th>Thành phố</th>
                                        <th>Vai trò</th>
                                        <th class="text-center">Hành động</th>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
        </div>
        <!-- /.container-fluid -->
    </section>
@endsection
