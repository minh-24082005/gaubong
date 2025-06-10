@extends('Client.layouts.main')
@section('content')
<section class="ftco-section ftco-no-pb ftco-no-pt bg-light">
  <div class="container">
    <div class="row">
      <div class="col-md-5 p-md-5 img img-2 d-flex justify-content-center align-items-center" style="background-image: url(images/about.jpg);">
        <a href="https://vimeo.com/45830194" class="icon popup-vimeo d-flex justify-content-center align-items-center">
          <span class="icon-play"></span>
        </a>
      </div>
      <div class="col-md-7 py-5 wrap-about pb-md-5 ftco-animate">
        <div class="heading-section-bold mb-4 mt-md-5">
          <div class="ml-md-0">
            <h2 class="mb-4">Chào mừng đến với Teddy.vn - Cửa hàng Gấu Bông Dễ Thương</h2>
          </div>
        </div>
        <div class="pb-md-5">
          <p>Chúng tôi chuyên cung cấp các loại gấu bông dễ thương, mềm mại và chất lượng cao dành cho mọi lứa tuổi. Từ những mẫu gấu nhỏ nhắn đến các gấu bông khổng lồ, bạn sẽ tìm thấy món quà hoàn hảo tại Teddy.vn.</p>
          <p>Hãy khám phá bộ sưu tập độc đáo và đặt hàng ngay hôm nay để mang về một người bạn bông mềm đáng yêu!</p>
          <p><a href="#" class="btn btn-primary">Mua ngay</a></p>
        </div>
      </div>
    </div>
  </div>
</section>

<section class="ftco-section ftco-no-pt ftco-no-pb py-5 bg-light">
  <div class="container py-4">
    <div class="row d-flex justify-content-center py-5">
      <div class="col-md-6">
        <h2 style="font-size: 22px;" class="mb-0">Đăng ký nhận bản tin</h2>
        <span>Nhận thông báo về mẫu gấu mới và các khuyến mãi đặc biệt</span>
      </div>
      <div class="col-md-6 d-flex align-items-center">
        <form action="#" class="subscribe-form">
          <div class="form-group d-flex">
            <input type="text" class="form-control" placeholder="Nhập địa chỉ email">
            <input type="submit" value="Đăng ký" class="submit px-3">
          </div>
        </form>
      </div>
    </div>
  </div>
</section>

<section class="ftco-section ftco-counter img" id="section-counter" style="background-image: url(images/bg_3.jpg);">
  <div class="container">
    <div class="row justify-content-center py-5">
      <div class="col-md-10">
        <div class="row">
          <div class="col-md-3 d-flex justify-content-center counter-wrap ftco-animate">
            <div class="block-18 text-center">
              <div class="text">
                <strong class="number" data-number="10000">0</strong>
                <span>Khách hàng hài lòng</span>
              </div>
            </div>
          </div>
          <div class="col-md-3 d-flex justify-content-center counter-wrap ftco-animate">
            <div class="block-18 text-center">
              <div class="text">
                <strong class="number" data-number="50">0</strong>
                <span>Chi nhánh toàn quốc</span>
              </div>
            </div>
          </div>
          <div class="col-md-3 d-flex justify-content-center counter-wrap ftco-animate">
            <div class="block-18 text-center">
              <div class="text">
                <strong class="number" data-number="500">0</strong>
                <span>Đối tác cung cấp</span>
              </div>
            </div>
          </div>
          <div class="col-md-3 d-flex justify-content-center counter-wrap ftco-animate">
            <div class="block-18 text-center">
              <div class="text">
                <strong class="number" data-number="30">0</strong>
                <span>Giải thưởng</span>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<section class="ftco-section testimony-section">
  <div class="container">
    <div class="row justify-content-center mb-5 pb-3">
      <div class="col-md-7 heading-section ftco-animate text-center">
        <span class="subheading">Lời chứng thực</span>
        <h2 class="mb-4">Khách hàng hài lòng nói gì</h2>
        <p>Rất xa nơi đây, sau những ngọn núi chữ, cách xa các quốc gia Vokalia và Consonantia, có những văn bản mù sinh sống.</p>
      </div>
    </div>
    <div class="row ftco-animate">
      <div class="col-md-12">
        <div class="carousel-testimony owl-carousel">
          <div class="item">
            <div class="testimony-wrap p-4 pb-5">
              <div class="user-img mb-5" style="background-image: url(images/person_1.jpg)">
                <span class="quote d-flex align-items-center justify-content-center">
                  <i class="icon-quote-left"></i>
                </span>
              </div>
              <div class="text text-center">
                <p class="mb-5 pl-4 line">Rất xa nơi đây, sau những ngọn núi chữ, cách xa các quốc gia Vokalia và Consonantia, có những văn bản mù sinh sống.</p>
                <p class="name">Garreth Smith</p>
                <span class="position">Giám đốc Marketing</span>
              </div>
            </div>
          </div>
          <div class="item">
            <div class="testimony-wrap p-4 pb-5">
              <div class="user-img mb-5" style="background-image: url(images/person_2.jpg)">
                <span class="quote d-flex align-items-center justify-content-center">
                  <i class="icon-quote-left"></i>
                </span>
              </div>
              <div class="text text-center">
                <p class="mb-5 pl-4 line">Rất xa nơi đây, sau những ngọn núi chữ, cách xa các quốc gia Vokalia và Consonantia, có những văn bản mù sinh sống.</p>
                <p class="name">Garreth Smith</p>
                <span class="position">Nhà thiết kế giao diện</span>
              </div>
            </div>
          </div>
          <div class="item">
            <div class="testimony-wrap p-4 pb-5">
              <div class="user-img mb-5" style="background-image: url(images/person_3.jpg)">
                <span class="quote d-flex align-items-center justify-content-center">
                  <i class="icon-quote-left"></i>
                </span>
              </div>
              <div class="text text-center">
                <p class="mb-5 pl-4 line">Rất xa nơi đây, sau những ngọn núi chữ, cách xa các quốc gia Vokalia và Consonantia, có những văn bản mù sinh sống.</p>
                <p class="name">Garreth Smith</p>
                <span class="position">Thiết kế UI</span>
              </div>
            </div>
          </div>
          <div class="item">
            <div class="testimony-wrap p-4 pb-5">
              <div class="user-img mb-5" style="background-image: url(images/person_1.jpg)">
                <span class="quote d-flex align-items-center justify-content-center">
                  <i class="icon-quote-left"></i>
                </span>
              </div>
              <div class="text text-center">
                <p class="mb-5 pl-4 line">Rất xa nơi đây, sau những ngọn núi chữ, cách xa các quốc gia Vokalia và Consonantia, có những văn bản mù sinh sống.</p>
                <p class="name">Garreth Smith</p>
                <span class="position">Lập trình viên Web</span>
              </div>
            </div>
          </div>
          <div class="item">
            <div class="testimony-wrap p-4 pb-5">
              <div class="user-img mb-5" style="background-image: url(images/person_1.jpg)">
                <span class="quote d-flex align-items-center justify-content-center">
                  <i class="icon-quote-left"></i>
                </span>
              </div>
              <div class="text text-center">
                <p class="mb-5 pl-4 line">Rất xa nơi đây, sau những ngọn núi chữ, cách xa các quốc gia Vokalia và Consonantia, có những văn bản mù sinh sống.</p>
                <p class="name">Garreth Smith</p>
                <span class="position">Chuyên viên phân tích hệ thống</span>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<section class="ftco-section bg-light">
  <div class="container">
    <div class="row no-gutters ftco-services">
      <div class="col-lg-3 text-center d-flex align-self-stretch ftco-animate">
        <div class="media block-6 services mb-md-0 mb-4">
          <div class="icon bg-color-1 active d-flex justify-content-center align-items-center mb-2">
            <span class="flaticon-shipped"></span>
          </div>
          <div class="media-body">
            <h3 class="heading">Miễn phí giao hàng</h3>
            <span>Cho đơn từ 500.000đ</span>
          </div>
        </div>      
      </div>
      <div class="col-lg-3 text-center d-flex align-self-stretch ftco-animate">
        <div class="media block-6 services mb-md-0 mb-4">
          <div class="icon bg-color-2 d-flex justify-content-center align-items-center mb-2">
            <span class="flaticon-diet"></span>
          </div>
          <div class="media-body">
            <h3 class="heading">Gấu bông mới 100%</h3>
            <span>Đóng gói cẩn thận</span>
          </div>
        </div>    
      </div>
      <div class="col-lg-3 text-center d-flex align-self-stretch ftco-animate">
        <div class="media block-6 services mb-md-0 mb-4">
          <div class="icon bg-color-3 d-flex justify-content-center align-items-center mb-2">
            <span class="flaticon-award"></span>
          </div>
          <div class="media-body">
            <h3 class="heading">Chất lượng cao</h3>
            <span>Vải nhung mềm, an toàn</span>
          </div>
        </div>      
      </div>
      <div class="col-lg-3 text-center d-flex align-self-stretch ftco-animate">
        <div class="media block-6 services mb-md-0 mb-4">
          <div class="icon bg-color-4 d-flex justify-content-center align-items-center mb-2">
            <span class="flaticon-customer-service"></span>
          </div>
          <div class="media-body">
            <h3 class="heading">Hỗ trợ tận tình</h3>
            <span>Phục vụ 24/7</span>
          </div>
        </div>      
      </div>
    </div>
  </div>
</section>


@endsection