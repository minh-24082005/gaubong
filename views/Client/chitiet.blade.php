@extends('Client.layouts.main')
@section('content')


    


  <section class="ftco-section">
    <div class="container">
      <div class="row justify-content-center mb-3 pb-3">
        <div class="col-md-12 heading-section text-center ftco-animate">
        </div>
      </div>         
    </div>
    

  <form id="variant-form" action="/giohang/add" enctype="multipart/form-data" method="POST">

  <div class="container">
    <div class="row">
      <div class="col-md-6 col-lg-6 ftco-animate">
        <img src="{{ file_url($product['p_hinhanh']) }}" alt="{{ $product['p_ten'] }}" class="img-fluid rounded shadow-sm">
      </div>
      <div class="col-md-6 col-lg-6 ftco-animate">
        <h3 class="mb-4">{{ $product['p_ten'] }}</h3>

        <div class="mb-3">
          <label for="kichco" class="form-label">Chọn kích cỡ</label>
          <select id="kichco" name="variant_id" class="form-select">
            @foreach ($variants as $variant)
              <option 
                value="{{ $variant['id'] }}" 
                data-gia="{{ $variant['gia'] }}" 
                data-soluong="{{ $variant['soluong'] }}">
                  {{ $variant['kich_co'] }} cm
              </option>
            @endforeach
          </select>
        </div>

        <div class="mb-3">
          <strong>Giá:</strong> 
          <span id="gia-hien-thi" class="text-danger fw-bold">
            {{ isset($variants[0]) ? number_format($variants[0]['gia'], 0, ',', '.') . ' VND' : number_format($product['p_gia_coso'], 0, ',', '.') . ' VND' }}
          </span>
        </div>

        <div class="mb-3">
          <strong>Kho:</strong> 
          <span id="soluong-hien-thi">
            {{ isset($variants[0]) ? 'Số lượng: ' . $variants[0]['soluong'] : 'Hết hàng' }}
          </span>
        </div>
<!-- THÊM VÀO TRONG <form> -->
<input type="hidden" name="id_sanpham" value="{{ $product['p_id'] }}">
<input type="hidden" name="id_user" value="{{ $_SESSION['user']['id'] ?? '' }}">

        <div class="mb-3">
          <label for="so_luong" class="form-label">Chọn số lượng</label>
          <input type="number" id="so_luong" name="so_luong" class="form-control" min="1"
                max="{{ isset($variants[0]) ? $variants[0]['soluong'] : 0 }}"
                value="1">
        </div>

        <!-- Hidden inputs nếu cần -->
        <input type="hidden" name="gia" id="gia-hidden" value="{{ $variants[0]['gia'] ?? 0 }}">
        
        <button type="submit" id="add-to-cart" class="btn btn-success btn-lg w-100 mt-3">
          <i class="bi bi-cart-plus me-2"></i> Thêm vào giỏ hàng
        </button>

        <!-- Toast -->
        <div class="toast-container position-fixed top-0 end-0 p-3" style="z-index: 1055;">
          <div id="cart-toast" class="toast text-white bg-success" role="alert" aria-live="assertive" aria-atomic="true">
            <div class="d-flex">
              <div class="toast-body">
                ✅ Đã thêm vào giỏ hàng thành công!
              </div>
              <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast"></button>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</form>
@if(isset($_SESSION['user']))
<h1>{{$_SESSION['user']['name']}}</h1>
@endif

        </div>
      </div>
    </div>

  <!-- ... phần trên giữ nguyên ... -->

<div class="row mt-5">
  <div class="col-md-12">
    <div class="card p-4 shadow-sm border-0">
      <h4 class="mb-3 font-weight-bold text-uppercase">Mô tả sản phẩm</h4>
      <p style="line-height: 1.8; font-size: 16px;">
        {!! $product['p_mota'] !!}

      </p>
    </div>
  </div>
</div>

<!-- ... phần dưới giữ nguyên ... -->

  </section>
  <h3 class="text-xl font-semibold mt-8 mb-4">Sản phẩm liên quan</h3>
      <div class="row">
        @foreach ($relatedProducts as $product)
          <div class="col-md-6 col-lg-3 ftco-animate">
            <div class="product">
              <a href="/chitiet/{{$product['p_id']}}" class="img-prod">
                <img class="img-fluid" src="{{ file_url($product['p_hinhanh']) }}" alt="">
                <div class="overlay"></div>  
              </a>
              <div class="text py-3 pb-4 px-3 text-center">
                <h3><a href="#">{{ $product['p_ten'] }}</a></h3>
                <div class="d-flex justify-content-center">
                  <div class="pricing">
                    <p class="price"><span class="price-sale">{{ number_format($product['p_gia_coso'], 0, ',', '.') }} VND</span></p>
                  </div>
                </div>
                <div class="bottom-area d-flex px-3">
                  <div class="m-auto d-flex">
                    <a href="#" class="add-to-cart d-flex justify-content-center align-items-center text-center">
                      <span><i class="ion-ios-menu"></i></span>
                    </a>
                    <a href="#" class="buy-now d-flex justify-content-center align-items-center mx-1">
                      <span><i class="ion-ios-cart"></i></span>
                    </a>
                    <a href="#" class="heart d-flex justify-content-center align-items-center">
                      <span><i class="ion-ios-heart"></i></span>
                    </a>
                  </div>
                </div>
              </div>
            </div>
          </div>
        @endforeach
      </div>

<script>
document.getElementById('kichco').addEventListener('change', function () {
    const selected = this.options[this.selectedIndex];
    const gia = selected.getAttribute('data-gia');
    const soluong = selected.getAttribute('data-soluong');

    document.getElementById('gia-hien-thi').textContent = parseInt(gia).toLocaleString('vi-VN') + ' VND';
    document.getElementById('soluong-hien-thi').textContent = 'Số lượng: ' + soluong;

    const soLuongInput = document.getElementById('so_luong');
    soLuongInput.max = soluong;
    if (parseInt(soLuongInput.value) > parseInt(soluong)) {
        soLuongInput.value = soluong;
    }
});

// ✅ Xử lý thêm vào giỏ hàng và toast
document.getElementById('add-to-cart').addEventListener('click', function () {
    const toastEl = document.getElementById('cart-toast');
    const toast = new bootstrap.Toast(toastEl);
    toast.show();

    // 👉 Cập nhật số lượng icon giỏ hàng
    const cartCountElement = document.getElementById('cart-count');
    let currentCount = parseInt(cartCountElement.textContent.replace(/\D/g, '')) || 0;
    let addedQuantity = parseInt(document.getElementById('so_luong').value) || 1;
    cartCountElement.textContent = `[${currentCount + addedQuantity}]`;
});
</script>



@endsection       