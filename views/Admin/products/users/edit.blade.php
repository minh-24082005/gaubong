  @extends('Admin.layout.sidebar')
  @section('title', 'Cập nhật người dùng')

  @section('content')
      <section class="content-header">
          <div class="container-fluid">
              <div class="row mb-2">
                  <div class="col-sm-6">
                      <h1>Cập nhật người dùng</h1>
                  </div>
                  <div class="col-sm-6">
                      <ol class="breadcrumb float-sm-right">
                          <li class="breadcrumb-item"><a href="#">Home</a></li>
                          <li class="breadcrumb-item active">Cập nhật người dùng</li>
                      </ol>
                  </div>
              </div>
          </div>
      </section>
      @include('admin.components.display-msg-fail')
      @include('admin.components.display-msg-success')
      @include('admin.components.display-error')
      <section class="content">
          <div class="container-fluid">
              <form action="/admin/users/update/{{ $user['id'] }}" method="post" enctype="multipart/form-data">

                  {{-- @php
                    var_dump($user);
                    die();
                @endphp --}}
                  <div class="row">
                      <!-- Form nhập thông tin -->
                      <div class="col-md-12">
                          <div class="card card-primary">
                              <div class="card-body">
                                  <div class="form-group">
                                      <label for="name">Họ tên</label>
                                      <input type="text" name="name" class="form-control" value="{{ $user['name'] ?? '' }}" required maxlength="50">
                                  </div>
                                  <div class="form-group">
                                      <label for="email">Email</label>
                                      <input type="email" name="email" class="form-control" value="{{ $user['email'] ?? '' }}" required maxlength="100">
                                  </div>
                                  <div class="form-group">
                                      <label for="dien_thoai">Điện thoại</label>
                                      <input type="text" name="dien_thoai" class="form-control" value="{{ $user['dien_thoai'] ?? '' }}" maxlength="20">
                                  </div>
                                  <div class="form-group">
                                      <label for="dia_chi">Địa chỉ</label>
                                      <input type="text" name="dia_chi" class="form-control" value="{{ $user['dia_chi'] ?? '' }}" maxlength="255">
                                  </div>
                                  <div class="form-group">
                                      <label for="thanhpho">Thành phố</label>
                                      <input type="text" name="thanhpho" class="form-control" value="{{ $user['thanhpho'] ?? '' }}" maxlength="100">
                                  </div>
                                  <div class="form-group">
                                      <label for="type">Loại tài khoản</label>
                                      <select name="type" class="form-control">
                                          <option value="admin" {{ ($user['type'] ?? '') == 'admin' ? 'selected' : '' }}>Admin</option>
                                          <option value="client" {{ ($user['type'] ?? '') == 'client' ? 'selected' : '' }}>Khách hàng</option>
                                      </select>
                                  </div>
                                  
                              </div>
                              <div class="card-footer">
                                  <button type="submit" class="btn btn-outline-primary d-flex align-items-center ">
                                      <span><i class="fas fa-save"></i></span>
                                      <span class="ml-2">Cập nhật dữ liệu</span>
                                  </button>
                              </div>
                          </div>
                      </div>
                  </div>
              </form>

          </div>
      </section>
  @endsection
