  @extends('Admin.layout.sidebar')
  @section('title', 'Thêm mới người dùng')

  @section('content')
      <section class="content-header">
          <div class="container-fluid">
              <div class="row mb-2">
                  <div class="col-sm-6">
                      <h1>Thêm mới người dùng</h1>
                  </div>
                  <div class="col-sm-6">
                      <ol class="breadcrumb float-sm-right">
                          <li class="breadcrumb-item"><a href="#">Home</a></li>
                          <li class="breadcrumb-item active">Thêm mới người dùng</li>
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
              <form action="/admin/users/store" method="post" enctype="multipart/form-data">
                  <div class="row">
                      <!-- Form nhập thông tin -->
                      <div class="col-md-12">
                          <div class="card card-primary">
                              <div class="card-body">
                                  <div class="form-group mb-3">
                                      <label>Tên</label>
                                      <input type="text" class="form-control" name="name"
                                          placeholder="Tên người dùng..." value="{{ $_SESSION['data']['name'] }}">
                                  </div>
                                  <div class="form-group mb-3">
                                      <label>Email</label>
                                      <input type="email" class="form-control" name="email"
                                          placeholder="Email người dùng..." value="{{ $_SESSION['data']['email'] }}">
                                  </div>
                                  <div class="form-group mb-3">
                                      <label>Password</label>
                                      <input type="password" class="form-control" name="password"
                                          placeholder="Password người dùng..." value="{{ $_SESSION['data']['password'] }}">
                                  </div>
                                  <div class="form-group mb-3">
                                      <label>Confirm Password</label>
                                      <input type="password" class="form-control" name="confirm_password"
                                          placeholder="Nhập lại mật khẩu..."
                                          value="{{ $_SESSION['data']['confirm_password'] }}">
                                  </div>
                                  <div class="form-group mb-3">
                                      <label>Điện thoại</label>
                                      <input type="text" class="form-control" name="dien_thoai" maxlength="20">
                                  </div>
                                  <div class="form-group mb-3">
                                      <label>Địa chỉ</label>
                                      <input type="text" class="form-control" name="dia_chi" maxlength="255">
                                  </div>
                                  <div class="form-group mb-3">
                                      <label>Thành phố</label>
                                      <input type="text" class="form-control" name="thanhpho" maxlength="100">
                                  </div>
                                  
                                  
                                  
                                 
                                  <div class="form-group mb-3">
                                      <label>Type</label>
                                      <select name="type" id="" class="form-control">
                                          <option value="admin">Admin</option>
                                          <option value="client">Client</option>
                                      </select>
                                  </div>

                              </div>
                              <div class="card-footer">
                                  <button type="submit" class="btn btn-outline-primary d-flex align-items-center ">
                                      <span><i class="fas fa-save"></i></span>
                                      <span class="ml-2">Thêm mới dữ liệu</span>
                                  </button>
                              </div>
                          </div>
                      </div>
                  </div>
              </form>

          </div>
      </section>
  @endsection
