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
      <section class="content">
          <div class="container-fluid">
              <div class="row">
                  <div class="col-12">
                      <div class="card">
                          <!-- /.card-header -->
                          <div class="card-body">
                              <table id="example1" class="table table-bordered table-striped">
                                  <thead>
                                      <tr>
                                          <th>Trường dữ liệu</th>
                                          <th>Giá trị</th>
                                      </tr>
                                  </thead>
                                  <tbody>
                                      @foreach ($user as $field => $value)
                                          {{-- @php
                                            print_r($value);
                                            die();
                                        @endphp --}}
                                          <tr>
                                              <td>{{ strtoupper($field) }}</td>
                                              <td>
                                                  @switch($field)
                                                 

                                                      @case('password')
                                                          <p>**************</p>
                                                      @break

                                                      @case('type')
                                                          @if ($user['type'] == 'admin')
                                                              <span class="badge bg-danger">Quản trị viên</span>
                                                          @else
                                                              <span class="badge bg-info">Người dùng</span>
                                                          @endif
                                                      @break

                                                      @default
                                                          {{ $value }}
                                                  @endswitch
                                              </td>
                                          </tr>
                                      @endforeach
                                  </tbody>
                                  <tfoot>
                                      <tr>
                                          <th>Trường dữ liệu</th>
                                          <th>Giá trị</th>
                                      </tr>
                                  </tfoot>
                              </table>
                              <a href="/admin/users" class="btn btn-primary">Back to list</a>
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
