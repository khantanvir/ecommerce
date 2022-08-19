@extends('userpanel')
@section('frontend')
<div id="all">
    <div id="content">
      <div class="container">
        <div class="row">
          <div class="col-lg-12">
            <!-- breadcrumb-->
            <nav aria-label="breadcrumb">
              <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ URL::to('/') }}">Home</a></li>
                <li aria-current="page" class="breadcrumb-item active">Mens</li>
              </ol>
            </nav>
          </div>
          <div class="col-lg-3">
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
            
            <div class="banner"><a href="#"><img src="{{ URL::to('public/frontend/img/banner.jpg' ) }}" alt="sales 2014" class="img-fluid"></a></div>
          </div>
          <div class="col-lg-9">
            <div class="row products">
              @forelse ($mens_item as $item)
              <div class="col-lg-4 col-md-6">
                <div class="product">
                  <div class="flip-container">
                    <div class="flipper">
                      <div class="front"><a href="{{ URL::to('details/'.$item->url) }}"><img src="{{ URL::to('public/main/image/'.$item->image ) }}" alt="" class="img-fluid"></a></div>
                      <div class="back"><a href="{{ URL::to('details/'.$item->url) }}"><img src="{{ URL::to('public/main/image/'.$item->image ) }}" alt="" class="img-fluid"></a></div>
                    </div>
                  </div><a href="detail.html" class="invisible"><img src="{{ URL::to('public/main/image/'.$item->image ) }}" alt="" class="img-fluid"></a>
                  <div class="text">
                    <input type="hidden" id="product_url{{ $item->id }}" value="{{ $item->url }}" >
                    <h3><a href="{{ URL::to('details/'.$item->url) }}">{{ $item->title }}</a></h3>
                    <p class="buttons"><a href="{{ URL::to('details/'.$item->url) }}" class="btn btn-outline-secondary">View detail</a><a onclick="addToCartFromList({{ $item->id }})" href="javascript://" class="btn btn-primary"><i class="fa fa-shopping-cart"></i>Add to cart</a></p>
                  </div>
                </div>
              </div>
              @empty
              <p class="bg-danger text-white p-1">No Item Found</p>
              @endforelse
            </div>
            <div class="pages">
              <p class="loadMore"><a href="#" class="btn btn-primary btn-lg"><i class="fa fa-chevron-down"></i> Load more</a></p>
              <nav aria-label="Page navigation example" class="d-flex justify-content-center">
                <ul class="pagination">
                    {!! $mens_item->links() !!}
                </ul>
              </nav>
            </div>
          </div>
          <!-- /.col-lg-9-->
        </div>
      </div>
    </div>
  </div>
@endsection