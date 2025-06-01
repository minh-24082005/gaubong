<!-- Navbar -->
<nav class="navbar navbar-expand-lg navbar-dark ftco_navbar bg-dark ftco-navbar-light" id="ftco-navbar">
  <div class="container">
    <a class="navbar-brand" href="/">Vegefoods</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#ftco-nav"
      aria-controls="ftco-nav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="oi oi-menu"></span> Menu
    </button>

    <div class="collapse navbar-collapse" id="ftco-nav">
      <ul class="navbar-nav ml-auto">
        <li class="nav-item active"><a href="/" class="nav-link">Home</a></li>
        <li class="nav-item active"><a href="/danhmuc" class="nav-link">Danh mục</a></li>
        <li class="nav-item"><a href="about.html" class="nav-link">About</a></li>
        <li class="nav-item"><a href="blog.html" class="nav-link">Blog</a></li>
        <li class="nav-item"><a href="contact.html" class="nav-link">Contact</a></li>
        <li class="nav-item cta cta-colored">
          <a href="cart.html" class="nav-link">Giỏ hàng <span class="icon-shopping_cart"></span></a>
        </li>
		<li class="nav-item active">
	 <div class="container mt-2">
      <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#loginModal">Đăng nhập</button>
      <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#registerModal">Đăng ký</button>
     </div>
        </li>
		 {{-- <li class="nav-item active">
		 <div class="container text-center mt-3">
        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#loginModal"> đăng nhập</button>
           </div>
        </li> --}}
      </ul>
	  
    </div>
  </div>
  
</nav>

<!-- Modal Đăng ký -->
<div class="modal fade" id="registerModal" tabindex="-1" aria-labelledby="registerModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">

      <div class="modal-header">
        <h5 class="modal-title" id="registerModalLabel">Tạo tài khoản mới</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Đóng"></button>
      </div>

      <div class="modal-body">
        <form>
          <div class="mb-3">
            <label for="fullname" class="form-label">Họ và tên:</label>
            <input type="text" class="form-control" id="fullname" required>
          </div>

          <div class="mb-3">
            <label for="registerEmail" class="form-label">Email:</label>
            <input type="email" class="form-control" id="registerEmail" required>
          </div>

          <div class="mb-3">
            <label for="registerPassword" class="form-label">Mật khẩu:</label>
            <input type="password" class="form-control" id="registerPassword" required>
          </div>

          <div class="mb-3">
            <label for="confirmPassword" class="form-label">Xác nhận mật khẩu:</label>
            <input type="password" class="form-control" id="confirmPassword" required>
          </div>

          <button type="submit" class="btn btn-success w-100">Đăng ký</button>
        </form>
      </div>

    </div>
  </div>
</div>

<!-- Modal đăng nhập Bootstrap 5 -->
<div class="modal fade" id="loginModal" tabindex="-1" aria-labelledby="loginModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">

      <div class="modal-header">
        <h5 class="modal-title" id="loginModalLabel">Đăng nhập tài khoản</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Đóng"></button>
      </div>

      <div class="modal-body">
        <form>
          <div class="mb-3">
            <label for="email" class="form-label">Email:</label>
            <input type="email" class="form-control" id="email" required>
          </div>

          <div class="mb-3">
            <label for="password" class="form-label">Mật khẩu:</label>
            <input type="password" class="form-control" id="password" required>
          </div>

          <button type="submit" class="btn btn-primary w-100">đăng nhập</button>
        </form>

        <hr>
        <p class="text-center">
          Khách hàng mới? <a href="#">Tạo tài khoản</a><br>
          <a href="#">Khôi phục mật khẩu</a>
        </p>
      </div>

    </div>
  </div>
</div>

<!-- Bootstrap 5 JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>




<section id="home-section" class="hero">
	<div class="home-slider owl-carousel">

		@foreach($banners as $product)
			<div class="slider-item" style="background-image: url('{{ file_url($product['anh']) }}');"></div>
		@endforeach


	</div>
</section>

    