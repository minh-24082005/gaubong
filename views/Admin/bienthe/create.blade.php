@extends('Admin.layout.sidebar')
@section('content')
    <h1>Thêm biến thể</h1>


    <form action="/admin/bienthe/store" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="mb-3">
            <label for="ten" class="form-label">kích cỡ </label>
            <input type="text" class="form-control" name="kich_co" id="ten" required placeholder="cm">
        </div>
        <div class="mb-3">
            <label for="id_sanpham" class="form-label">Sản phẩm</label>
            <select name="id_sanpham" id="id_sanpham" class="form-select" required>
                @foreach ($products as $product)
                    <option value="{{ $product['id'] }}">{{ $product['ten'] }}</option>
                @endforeach
            </select>
        </div>
        <div class="mb-3">
            <label for="gia" class="form-label">Giá</label>
            <input type="number" class="form-control" name="gia" id="gia" min="0" required>
        </div>
        <div class="mb-3">
            <label for="hangcosan" class="form-label">Số lượng</label>
            <input type="number" class="form-control" name="soluong" id="hangcosan" min="0" required>
        </div>
                        <div class="mb-3 row">
                            <div class="offset-sm-4 col-sm-8">
                                <button type="submit" class="btn btn-primary">
                                    Submit
                                </button>

                                <a href="/admin/bienthe" class="btn btn-warning">
                                    Back to list
                                </a>
                            </div>
                        </div>


@endsection
    