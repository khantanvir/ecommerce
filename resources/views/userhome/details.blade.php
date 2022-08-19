@extends('userpanel')
@section('frontend')
<div id="all">
    <div id="content">
      <div class="container">
        <div class="row">
          
          <div class="col-lg-3 order-2 order-lg-1">
            <!--
            *** MENUS AND FILTERS ***
            _________________________________________________________
            -->
            <div class="card sidebar-menu mb-4">
                <div class="card-header">
                  <h3 class="h4 card-title">Categories</h3>
                </div>
                <div class="card-body">
                  <ul class="nav nav-pills flex-column category-menu">
                    <li><a href="{{ URL::to('mens') }}" class="nav-link">Men <span class="badge badge-secondary">42</span></a>
                    </li>
                    <li><a href="{{ URL::to('womens') }}" class="nav-link">Women <span class="badge badge-secondary">42</span></a>
                    </li>
                    
                  </ul>
                </div>
              </div>
          </div>
          <div class="col-lg-9 order-1 order-lg-2">
            <div id="productMain" class="row">
              <?php $more_images = explode(",",$details->more_images); ?>
              <div class="col-md-6">
                <div data-slider-id="1" class="owl-carousel shop-detail-carousel">
                  @foreach ($more_images as $image)
                  <div class="item"> <img src="{{ URL::to('public/main/moreimages/'.$image) }}" alt="" class="img-fluid"></div>
                  @endforeach
                  
                </div>
                
              </div>
              <div class="col-md-6">
                <input type="hidden" name="" id="quantity" value="1">
                <input type="hidden" name="" id="product_url" value="{{ $details->url }}">
                <div class="box">
                  <h1 class="text-center">{{ $details->title }}</h1>
                  <p class="price">{{ "$".$details->selling_price }}</p>
                  <p class="text-center buttons"><a onclick="addToCart()" href="javascript://" class="btn btn-primary"><i class="fa fa-shopping-cart"></i> Add to cart</a></p>
                </div>
                <div data-slider-id="1" class="owl-thumbs">
                  @foreach ($more_images as $image)
                  <button class="owl-thumb-item"><img src="{{ URL::to('public/main/moreimages/'.$image) }}" alt="" class="img-fluid"></button>
                  @endforeach
                </div>
              </div>
            </div>
            <div id="details" class="box">
              {!! $details->description !!}
            </div>
          </div>
          <!-- /.col-md-9-->
        </div>
      </div>
    </div>
  </div>
  @endsection