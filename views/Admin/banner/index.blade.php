  @extends('Admin.layout.sidebar')
@section('content')
    <h1>Danh sách danh mục</h1>



    <div class="row">
    <div class="col-12 col-xl-15 mb-4 mb-lg-0">
        <div class="card">
            <h5 class="card-header">Latest transactions</h5>
            <a href="/admin/banner/create" class="btn btn-sm btn-success">Create</a>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">ID</th>
                                <th scope="col">ảnh</th>
                            
                                

                            </tr>
                        </thead>
                        <tbody>
                           @foreach ($banners as $banner)
                            <tr>
                <td>{{ $banner['id'] }}</td>
               <td><img src="{{file_url ($banner['anh'])}}" width="150" alt="Ảnh sản phẩm"></td>
               
                <td>{{ $category['created_at'] }}</td>
                <td>{{ $category['updated_at'] }}</td>
                                <td>
                                    <a href="/admin/banner/edit/{{ $banner['id'] }}" class="btn btn-warning btn-sm mb-1">Sửa</a>
                                    <a href="/admin/banner/delete/{{ $banner['id'] }}" class="btn btn-danger btn-sm" onclick="return confirm('Bạn có chắc chắn muốn xóa?')">Xóa</a>
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
