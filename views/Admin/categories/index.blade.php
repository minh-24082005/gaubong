  @extends('Admin.layout.sidebar')
@section('content')
    <h1>Danh sách danh mục</h1>
<a href="/admin/categories/create">thêm danh mục</a>


    <div class="row">
    <div class="col-12 col-xl-15 mb-4 mb-lg-0">
        <div class="card">
            <h5 class="card-header">Latest transactions</h5>
            <a href="/admin/categories/create" class="btn btn-sm btn-success">Create</a>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">ID</th>
                                <th scope="col">tên</th>
                                <th scope="col">miêu tả</th>

                            </tr>
                        </thead>
                        <tbody>
                           @foreach ($categories as $category)
                            <tr>
                <td>{{ $category['id'] }}</td>
                <td>{{ $category['ten'] }}</td>
                <td>{!! $category['mieuta'] !!}</td>
                <td>{{ $category['created_at'] }}</td>
                <td>{{ $category['updated_at'] }}</td>


                              
                                <td>
                                    <a href="/admin/product/show/{{ $product['p_id'] }}" class="btn btn-sm btn-primary">show</a>
                                    <a href="/admin/categories/edit/{{ $category['id'] }}" class="btn btn-sm btn-primary">edit</a>
                                    <a href="/admin/categories/delete/{{ $category['id'] }}" class="btn btn-sm btn-primary">delete</a>
                                
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
