@extends('Admin.layout.sidebar')

@section('content')
<div class="container-fluid">
    <h2 class="mb-4">Thêm sản phẩm</h2>
    <div class="card shadow">
        <div class="card-header">
            <h5 class="mb-0">Thông tin sản phẩm</h5>
        </div>
        <div class="card-body">
            <form action="/admin/product/store" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="mb-3">
                    <label for="name" class="form-label">Tên sản phẩm</label>
                    <input type="text" class="form-control" name="ten" id="name" required>
                </div>

                <div class="mb-3">
                    <label for="gia_coso" class="form-label">Giá</label>
                    <input type="number" class="form-control" name="gia_coso" id="gia_coso" min="0" required>
                </div>

                <div class="mb-3">
                    <label for="hangcosan" class="form-label">Số lượng</label>
                    <input type="number" class="form-control" name="hangcosan" id="hangcosan" min="0" required>
                </div>

                <div class="mb-3">
                    <label for="mota" class="form-label">Miêu tả</label>
                    <textarea name="mota" id="content" class="form-control" rows="5"></textarea>
                </div>

                <div class="mb-3">
                    <label for="ma_hang" class="form-label">Mã hàng</label>
                    <input type="text" class="form-control" name="ma_hang" id="ma_hang" required>
                </div>

                <div class="mb-3">
                    <label for="id_danhmuc" class="form-label">Danh mục</label>
                    <select name="id_danhmuc" id="id_danhmuc" class="form-select" required>
                        @foreach ($categories as $category)
                            <option value="{{ $category['id'] }}">{{ $category['ten'] }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-3">
                    <label for="hinhanh" class="form-label">Hình ảnh</label>
                    <input type="file" class="form-control" name="hinhanh" id="hinhanh">
                </div>

                <div class="mb-3">
                    <label for="trang_thai" class="form-label">Trạng thái</label>
                    <select name="trang_thai" id="trang_thai" class="form-select">
                        <option value="còn">Còn hàng</option>
                        <option value="hết">Hết hàng</option>
                    </select>
                </div>

                <div class="d-flex justify-content-between">
                    <button type="submit" class="btn btn-primary">Submit</button>
                    <a href="/admin/categories" class="btn btn-warning">Back to list</a>
                </div>
            </form>
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
