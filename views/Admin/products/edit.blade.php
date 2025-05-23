@extends('admin.layout.sidebar');
@section('content')
    <h1> sửa sản phẩm</h1>
 
<div class="row">
    <div class="col-12 col-xl-8 mb-4 mb-lg-0">
        <div class="card">
            <h5 class="card-header">Latest transactions</h5>
            <div class="card-body">
                <div class="table-responsive">
                    <form action="/admin/product/update/{{$product['p_id']}}" method="POST" enctype="multipart/form-data">
                        <div class="mb-3 row">
                            <label for="name" class="col-4 col-form-label">Name</label>
                            <div class="col-8">
                                <input type="text" class="form-control" name="ten" id="name"
                                value="{{  $product['p_ten']  }}"/>
                            </div>
                        </div>
                     
                        <div class="mb-3 row">
                            <label for="email" class="col-4 col-form-label">danh mục</label>               
                            <div class="col-8">
                                <select name="id_danhmuc" id="">
                                      @foreach ($categories as $danhmuc)
                                      <option @selected($danhmuc['id'] == $product['p_id_danhmuc']) value="{{ $danhmuc['id'] }}">
                                        {{ $danhmuc['ten'] }}</option>
                                       @endforeach 
                                </select>                      

                            </div>                     
                        </div>
                             

                        <div class="mb-3 row">
                            <label for="name" class="col-4 col-form-label">mô tả</label>
                            <div class="col-8">

                                <textarea name="mota" id="content">{{ !! $product['p_mota']}}</textarea>
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="name" class="col-4 col-form-label">giá</label>
                            <div class="col-8">
                                <input type="number" class="form-control" name="gia_coso" id="name"
                                value="{{  $product['p_gia_coso'] }}" min="0"/>
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="name" class="col-4 col-form-label">số lượng</label>
                            <div class="col-8">
                                <input type="number" class="form-control" name="hangcosan" id="name"
                                value="{{  $product['p_hangcosan'] }}" min="0" />
                            </div>
                        </div>                        


                       <div class="mb-3 row">
    <label for="avatar" class="col-4 col-form-label">ảnh</label>
    <div class="col-8">
        <input type="file" class="form-control" name="hinhanh" id="avatar" />
        <input type="hidden" name="old_hinhanh" value="{{ $product['p_hinhanh'] }}">
        <img src="{{file_url($product['p_hinhanh'])}}" width="100px">
    </div>
</div>
                   <div class="mb-3 row">
                                <label for="is_active" class="col-4 col-form-label">trạng thái</label>
                                <div class="col-8">
                                    còn hàng
                                    <input type="checkbox" class="form-checkbox" @checked($product['p_trang_thai']) value="còn"
                                        name="trang_thai" id="is_active" />
                                
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label for="is_sale" class="col-4 col-form-label">mã hàng</label>
                                <div class="col-8">
                                    <input type="text" class="form-checkbox"value="{{  $product['p_ma_hang'] }}"
                                        name="ma_hang" id="is_sale" />
                                </div>
                            </div>

                        <div class="mb-3 row">
                            <div class="offset-sm-4 col-sm-8">
                                <button type="submit" class="btn btn-primary">
                                    Submit
                                </button>

                                <a href="/admin/product" class="btn btn-warning">
                                    Back to list
                                </a>
                            </div>
                        </div>
                    </form>
                </div>
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