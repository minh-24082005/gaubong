@extends('Client.layouts.main')
@section('content')


    


  <section class="ftco-section">
    <div class="container">
      <div class="row justify-content-center mb-3 pb-3">
        <div class="col-md-12 heading-section text-center ftco-animate">
        </div>
      </div>         
    </div>
    <form id="variant-form">
    <div class="container">
      <div class="row">
        <div class="col-md-6 col-lg-6 ftco-animate">
          <img src="{{ file_url($product['p_hinhanh']) }}" alt="{{ $product['p_ten'] }}" class="img-fluid">
        </div>
        <div class="col-md-6 col-lg-6 ftco-animate">
          <h3>{{ $product['p_ten'] }}</h3>
          

  <div class="form-group">
    <label for="kichco">Chọn kích cỡ:</label>
    <select id="kichco" class="form-control">
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

  <p id="gia-hien-thi">
    {{ isset($variants[0]) ? number_format($variants[0]['gia'], 0, ',', '.') . ' VND' : number_format($product['p_gia_coso'], 0, ',', '.') . ' VND' }}
  </p>
  <p id="soluong-hien-thi">
    {{ isset($variants[0]) ? 'Số lượng: ' . $variants[0]['soluong'] : 'hết hàng' }}
  </p>

  <div class="form-group">
    <label for="so_luong">Chọn số lượng:</label>
    <input type="number" id="so_luong" name="so_luong" class="form-control" min="0"
           max="{{ isset($variants[0]) ? $variants[0]['soluong'] : 0 }}"
           value="0">
  </div>

  <button type="button" id="add-to-cart" class="btn btn-primary">Thêm vào giỏ hàng</button>
  <div id="cart-message" class="mt-3 text-success" style="display: none;">
    ✅ Đã thêm vào giỏ hàng thành công!
  </div>
</form>
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
    const selectedOption = this.options[this.selectedIndex];
    const gia = selectedOption.getAttribute('data-gia');
    const soluong = selectedOption.getAttribute('data-soluong');

    document.getElementById('gia-hien-thi').textContent = parseInt(gia).toLocaleString('vi-VN') + ' VND';
    document.getElementById('soluong-hien-thi').textContent = 'Số lượng: ' + soluong;

    const soLuongInput = document.getElementById('so_luong');
    soLuongInput.max = soluong;
    if (parseInt(soLuongInput.value) > parseInt(soluong)) {
        soLuongInput.value = soluong;
    }
});

// ✅ Xử lý khi click nút "Thêm vào giỏ hàng"
document.getElementById('add-to-cart').addEventListener('click', function () {
    // Hiển thị thông báo
    const message = document.getElementById('cart-message');
    message.style.display = 'block';
    setTimeout(() => {
        message.style.display = 'none';
    }, 2500);

    // 👉 Cập nhật số lượng trên icon giỏ hàng
    const cartCountElement = document.getElementById('cart-count');
    let currentCount = parseInt(cartCountElement.textContent.replace(/\D/g, '')) || 0;
    let addedQuantity = parseInt(document.getElementById('so_luong').value) || 1;
    let newCount = currentCount + addedQuantity;
    cartCountElement.textContent = `[${newCount}]`;
});
</script>

@endsection       