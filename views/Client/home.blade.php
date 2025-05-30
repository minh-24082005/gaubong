@extends('Client.layouts.main')
@section('content')
<body class="goto-here">
<div class="container my-4">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <form method="GET" action="" class="d-flex">
                <input type="text" name="keyword" class="form-control me-2" placeholder="Tìm kiếm..." value="{{ $keyword }}">
                <button type="submit" class="btn btn-primary">Tìm kiếm</button>
            </form>
        </div>
    </div>
</div>




  <section class="ftco-section">


     
  
    <div class="container">
      <div class="row">
		  
 @if (empty($keyword) &&$page == 1)

			<div class="container">
				<div class="row no-gutters ftco-services">
          <div class="col-md-3 text-center d-flex align-self-stretch ftco-animate">
            <div class="media block-6 services mb-md-0 mb-4">
              <div class="icon bg-color-1 active d-flex justify-content-center align-items-center mb-2">
            		<span class="flaticon-shipped"></span>
              </div>
              <div class="media-body">
                <h3 class="heading">Free Shipping</h3>
                <span>On order over $100</span>
              </div>
            </div>      
          </div>
          <div class="col-md-3 text-center d-flex align-self-stretch ftco-animate">
            <div class="media block-6 services mb-md-0 mb-4">
              <div class="icon bg-color-2 d-flex justify-content-center align-items-center mb-2">
            		<span class="flaticon-diet"></span>
              </div>
              <div class="media-body">
                <h3 class="heading">Always Fresh</h3>
                <span>Product well package</span>
              </div>
            </div>    
          </div>
          <div class="col-md-3 text-center d-flex align-self-stretch ftco-animate">
            <div class="media block-6 services mb-md-0 mb-4">
              <div class="icon bg-color-3 d-flex justify-content-center align-items-center mb-2">
            		<span class="flaticon-award"></span>
              </div>
              <div class="media-body">
                <h3 class="heading">Superior Quality</h3>
                <span>Quality Products</span>
              </div>
            </div>      
          </div>
          <div class="col-md-3 text-center d-flex align-self-stretch ftco-animate">
            <div class="media block-6 services mb-md-0 mb-4">
              <div class="icon bg-color-4 d-flex justify-content-center align-items-center mb-2">
            		<span class="flaticon-customer-service"></span>
              </div>
              <div class="media-body">
                <h3 class="heading">Support</h3>
                <span>24/7 Support</span>
              </div>
            </div>      
          </div>
        </div>
			</div> 
      <br><br><br>
              <div class="col-md-12 heading-section text-center ftco-animate">
          <span class="subheading">Featured Products</span>
          <h2 class="mb-4">Our Products</h2>
        </div>      
	
 
  <h1 class="mt-5 mb-4 text-center">Sản phẩm hót</h1>
  <div class="row">
    @foreach ($products as $product)
      <div class="col-md-6 col-lg-3 ftco-animate">
        <div class="product">
          <a href="#" class="img-prod">
            <img class="img-fluid" src="{{ file_url($product['hinhanh']) }}" alt="{{ $product['ten'] }}">
            <div class="overlay"></div>  
          </a>
          <div class="text py-3 pb-4 px-3 text-center">
            <h3><a href="#">{{ $product['ten'] }}</a></h3>
            <div class="d-flex justify-content-center">
              <div class="pricing">
                <p class="price"><span class="price-sale">{{ number_format($product['gia_coso'], 0, ',', '.') }} VND</span></p>
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
@endif

      </div>


<h1>sản phẩm</h1>

      <div class="row">
        @foreach ($productss as $product)
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
   <!-- kết thúc row sản phẩm cũ -->

      <!-- Phân trang nằm dưới các sản phẩm, căn giữa -->
      <div class="container text-center mt-4">
        <nav aria-label="Page navigation">
          <ul class="pagination justify-content-center">
            <li class="page-item {{ $page <= 1 ? 'disabled' : '' }}">
              <a class="page-link" href="?page={{ $page - 1 }}" tabindex="-1">&laquo;</a>
            </li>

            @for ($i = 1; $i <= $totalPage; $i++)
              <li class="page-item {{ $i == $page ? 'active' : '' }}">
                <a class="page-link" href="?page={{ $i }}">{{ $i }}</a>
              </li>
            @endfor

            <li class="page-item {{ $page >= $totalPage ? 'disabled' : '' }}">
              <a class="page-link" href="?page={{ $page + 1 }}">&raquo;</a>
            </li>
          </ul>
        </nav>
      </div>

    </div>
  </section>
</body>

@endsection
