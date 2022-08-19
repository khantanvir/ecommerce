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
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                <li aria-current="page" class="breadcrumb-item active">Shopping cart</li>
              </ol>
            </nav>
          </div>
          <div id="basket" class="col-lg-9">
            <div class="box">
              <form method="post" action="checkout1.html">
                <h1>Shopping cart</h1>
                <p class="text-muted">You currently have {{ count($carts) }} item(s) in your cart.</p>
                <div class="table-responsive">
                  <table class="table">
                    <thead>
                      <tr>
                        <th colspan="2">Product</th>
                        <th>Quantity</th>
                        <th>Unit price</th>
                        <th colspan="2">Total</th>
                      </tr>
                    </thead>
                    <tbody>
                        <?php $subtotal = 0; ?>
                        @forelse ($carts as $cart)
                        <?php $product = \App\Models\Product\Product::where('id',$cart['product_id'])->first(); ?>
                        <tr>
                            <td><a href="{{ URL::to('details/'.$product->url) }}"><img src="{{ URL::to('public/main/image/'.$product->image) }}" alt="{{ $product->title }}"></a></td>
                            <td><a href="{{ URL::to('details/'.$product->url) }}">{{ $product->title }}</a></td>
                            <td>
                                {{ $cart['quantity'] }}
                            </td>
                            <td>${{ $cart['price'] }}</td>
                            <td>${{ $cart['quantity'] * $cart['price'] }}</td>
                            <td><a href="{{ URL::to('remove-from-cart-page/'.$product->id) }}"><i class="fa fa-trash-o"></i></a></td>
                          </tr>
                          <?php $subtotal+= $cart['quantity'] * $cart['price']?>
                        @empty
                            
                        @endforelse
                      
                    </tbody>
                    <tfoot>
                      <tr>
                        <th colspan="5">Total</th>
                        <th colspan="2">${{ $subtotal }}</th>
                      </tr>
                    </tfoot>
                  </table>
                </div>
                <!-- /.table-responsive-->
                <div class="box-footer d-flex justify-content-between flex-column flex-lg-row">
                  <div class="left"><a href="{{ URL::to('/mens') }}" class="btn btn-outline-secondary"><i class="fa fa-chevron-left"></i> Continue shopping</a></div>
                  <div class="right">
                    <button type="submit" class="btn btn-primary">Proceed to checkout <i class="fa fa-chevron-right"></i></button>
                  </div>
                </div>
              </form>
            </div>
            
          </div>
          <!-- /.col-lg-9-->
          <div class="col-lg-3">
            <div class="box">
              <div class="box-header">
                <h4 class="mb-0">Coupon code</h4>
              </div>
              <p class="text-muted">If you have a coupon code, please enter it in the box below.</p>
              <form>
                <div class="input-group">
                  <input type="text" class="form-control"><span class="input-group-append">
                    <button type="button" class="btn btn-primary"><i class="fa fa-gift"></i></button></span>
                </div>
                <!-- /input-group-->
              </form>
            </div>
          </div>
          <!-- /.col-md-3-->
        </div>
      </div>
    </div>
  </div>
  @endsection