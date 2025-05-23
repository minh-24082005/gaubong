@extends('admin.layout.sidebar');
@section('content')
    <h1> danh sách banner</h1>
    <div class="row">
        <div class="col-12 col
            -xl-8 mb-4 mb-lg-0">
            <div class="card">
                <h5 class="card-header">Latest transactions</h5>
                <div class="card-body">
                    <div class="table-responsive">
                        <form action="/admin/banner/store" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="mb-3 row">
                                <label for="name" class="col-4 col-form-label">tải ảnh</label>
                                <div class="col-8">
                                    <input type="file" class="form-control" name="anh" id="name"/>
                                </div>
                            </div>
                            </div> </div> </div> </div> 
                                                <div class="mb-3 row">
                            <div class="offset-sm-4 col-sm-8">
                                <button type="submit" class="btn btn-primary">
                                    Submit
                                </button>

                                <a href="/admin/banner" class="btn btn-warning">
                                    Back to list
                                </a>
                            </div>
                        </div></div>
@endsection