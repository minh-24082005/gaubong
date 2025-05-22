@extends('Admin.layout.sidebar')
@section('content')
    <h1>Chỉnh sửa danh mục</h1>
    <div class="row">
        <div class="col-12 col-xl-8 mb-4 mb-lg-0">
            <div class="card">
                <h5 class="card-header">Chỉnh sửa danh mục</h5>
                <div class="card-body">
                    <div class="table-responsive">
                        <form action="/admin/categories/update/{{ $category['id'] }}" method="POST"
                            enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="mb-3 row">
                                <label for="name" class="col-4 col-form-label">Name</label>
                                <div class="col-8">
                                    <input type="text" class="form-control" name="ten" id="name"
                                        value="{{ $category['ten'] }}" />
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label for="name" class="col-4 col-form-label">Miêu tả</label>
                                <div class="col-8">
                                    <textarea name="mieuta" id="content" cols="30" rows="10">{{ $category['mieuta'] }}</textarea>
                                </div>

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