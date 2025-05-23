@extends('Admin.layout.sidebar')
@section('content')
    <h1>thêm sản phẩm</h1>
<div>
    <div class="row">
        <div class="col-12 col-xl-8 mb-4 mb-lg-0">
            <div class="card">
                <h5 class="card-header">Latest transactions</h5>
                <div class="card-body">
                    <div class="table-responsive">
                        <form action="/admin/product/store" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="mb-3 row">
                                <label for="name" class="col-4 col-form-label">Tên sản phẩm</label>
                                <div class="col-8">
                                    <input type="text" class="form-control" name="ten" id="name" />
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label for="name" class="col-4 col-form-label">giá</label>
                                <div class="col-8">
                                    <input type="number" class="form-control" name="gia_coso" id="name" min="0"/>
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label for="name" class="col-4 col-form-label">số lượng</label>
                                <div class="col-8">
                                    <input type="number" class="form-control" name="hangcosan" id="name" min="0"/>
                                </div>
                            </div>                           

                            <div class="mb-3 row">
                                <label for="name" class="col-4 col-form-label">miêu tả</label>
                                <div class="col-8">
                                    <textarea name="mota" id="content" cols="30" rows="10"></textarea>
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label for="name" class="col-4 col-form-label">mã hàng</label>
                                <div class="col-8">
                                    <input type="text" class="form-control" name="ma_hang" id="name" />
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label for="" class="col-4 col-form-label">danh mục</label>
                                <select name="id_danhmuc" id="">
                                    @foreach ($categories as $category)
                                        <option value="{{ $category['id'] }}">{{ $category['ten'] }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="mb-3 row">
                                <label for="" class="col-4 col-form-label">hình ảnh</label>
                                <input type="file" name="hinhanh" id="">
                            </div>

                            <div class="mb-3 row">
                                <label for="" class="col-4 col-form-label">trạng thái</label>
                                <select name="trang_thai" id="">
                              
                                        <option value="còn">còn hàng</option>
                                        <option value="hết">hết hàng</option>
                                </select>
                            <div class="mb-3 row">
                            <div class="offset-sm-4 col-sm-8">
                                <button type="submit" class="btn btn-primary">
                                    Submit
                                </button>

                                <a href="/admin/categories" class="btn btn-warning">
                                    Back to list
                                </a>
                            </div>
                        </div>
                            </div>
@endsection
     @section('scripts')
    <script src="https://cdn.ckeditor.com/4.22.1/standard/ckeditor.js"></script>

    <script>
        CKEDITOR.replace('content');
    </script>
@endsection    