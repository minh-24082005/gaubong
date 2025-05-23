@extends('admin.layout.sidebar')
@section('content')
<h1>chi tiết</h1>
<div class="row">
    <div class="col-12 col-xl-15 mb-4 mb-lg-0">
        <div class="card">
            <h5 class="card-header">Latest transactions</h5>
            <a href="/admin/users/create" class="btn btn-sm btn-success">Create</a>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">trường giữ liệu</th>
                                <th scope="col">giá trị</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($product as $field => $value)
                            <tr>
                                <td>{{ strtoupper($field) }}</td>
                                <td>
                                    @switch($field)
                                        @case('p_hinhanh')
                                            <img src="{{ file_url($value) }}" width="100px" alt="">
                                        @break
                                        @default
                                           {!! str_replace(['<p>', '</p>'], '', $value) !!}
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