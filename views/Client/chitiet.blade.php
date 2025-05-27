@extends('Client.layouts.main')
@section('content')


    


  <section class="ftco-section">
    <div class="container">
      <div class="row justify-content-center mb-3 pb-3">
        <div class="col-md-12 heading-section text-center ftco-animate">
        </div>
      </div>         
    </div>
    <div class="container">
      <div class="row">
        <div class="col-md-6 col-lg-6 ftco-animate">
          <img src="{{ file_url($product['p_hinhanh']) }}" alt="{{ $product['p_ten'] }}" class="img-fluid">
        </div>
        <div class="col-md-6 col-lg-6 ftco-animate">
          <h3>{{ $product['p_ten'] }}</h3>
          
          <form id="variant-form">
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
    {{ isset($variants[0]) ? 'Số lượng: ' . $variants[0]['soluong'] : 'Chưa có số lượng' }}
  </p>
<div class="form-group">
  <label for="so_luong">Chọn số lượng:</label>
  <input type="number" id="so_luong" name="so_luong" class="form-control" min="1"
         max="{{ isset($variants[0]) ? $variants[0]['soluong'] : 1 }}"
         value="1">
</div>

</form>


          <button type="button" class="btn btn-primary">Thêm vào giỏ hàng</button>
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

<script>
document.getElementById('kichco').addEventListener('change', function () {
    const selectedOption = this.options[this.selectedIndex];
    const gia = selectedOption.getAttribute('data-gia');
    const soluong = selectedOption.getAttribute('data-soluong');

    document.getElementById('gia-hien-thi').textContent = parseInt(gia).toLocaleString('vi-VN') + ' VND';
    document.getElementById('soluong-hien-thi').textContent = 'Số lượng: ' + soluong;

    // Cập nhật input số lượng tối đa
    const soLuongInput = document.getElementById('so_luong');
    soLuongInput.max = soluong;
    if (parseInt(soLuongInput.value) > parseInt(soluong)) {
        soLuongInput.value = soluong; // Giới hạn lại nếu lớn hơn tồn kho
    }
});
</script>


@endsection       