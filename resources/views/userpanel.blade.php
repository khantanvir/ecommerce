<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>{{ (!empty($page_title))?$page_title:'' }}</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="robots" content="all,follow">
    <!-- Bootstrap CSS-->
    <link rel="stylesheet" href="{{ URL::to('public/frontend/vendor/bootstrap/css/bootstrap.min.css' ) }}">
    <!-- Font Awesome CSS-->
    <link rel="stylesheet" href="{{ URL::to('public/frontend/vendor/font-awesome/css/font-awesome.min.css' ) }}">
    <!-- Google fonts - Roboto -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:100,300,400,700">
    <!-- owl carousel-->
    <link rel="stylesheet" href="{{ URL::to('public/frontend/vendor/owl.carousel/assets/owl.carousel.css' ) }}">
    <link rel="stylesheet" href="{{ URL::to('public/frontend/vendor/owl.carousel/assets/owl.theme.default.css' ) }}">
    <!-- theme stylesheet-->
    <link rel="stylesheet" href="{{ URL::to('public/frontend/css/style.default.css' ) }}" id="theme-stylesheet">
    <!-- Custom stylesheet - for your changes-->
    <link rel="stylesheet" href="{{ URL::to('public/frontend/css/custom.css' ) }}">
    <!-- Favicon-->
    <link rel="shortcut icon" href="{{ URL::to('public/frontend/favicon.png' ) }}">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
   
  </head>
  <body>
    <!-- navbar-->
    <header class="header mb-5">
      <!--
      *** TOPBAR ***
      _________________________________________________________
      -->
      <div id="top">
        <div id="login-modal" tabindex="-1" role="dialog" aria-labelledby="Login" aria-hidden="true" class="modal fade">
          <div class="modal-dialog modal-sm">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title">Customer login</h5>
                <button type="button" data-dismiss="modal" aria-label="Close" class="close"><span aria-hidden="true">×</span></button>
              </div>
              <div class="modal-body">
                <form action="customer-orders.html" method="post">
                  <div class="form-group">
                    <input id="email-modal" type="text" placeholder="email" class="form-control">
                  </div>
                  <div class="form-group">
                    <input id="password-modal" type="password" placeholder="password" class="form-control">
                  </div>
                  <p class="text-center">
                    <button class="btn btn-primary"><i class="fa fa-sign-in"></i> Log in</button>
                  </p>
                </form>
                <p class="text-center text-muted">Not registered yet?</p>
                <p class="text-center text-muted"><a href="register.html"><strong>Register now</strong></a>! It is easy and done in 1 minute and gives you access to special discounts and much more!</p>
              </div>
            </div>
          </div>
        </div>
        <!-- *** TOP BAR END ***-->
        
        
      </div>
      <nav class="navbar navbar-expand-lg">
        <div class="container"><a href="index.html" class="navbar-brand home"><img src="{{ URL::to('public/frontend/img/logo.png' ) }}" alt="Obaju logo" class="d-none d-md-inline-block"><img src="{{ URL::to('public/frontend/img/logo-small.png' ) }}" alt="Obaju logo" class="d-inline-block d-md-none"><span class="sr-only">Obaju - go to homepage</span></a>
          <div class="navbar-buttons">
            <button type="button" data-toggle="collapse" data-target="#navigation" class="btn btn-outline-secondary navbar-toggler"><span class="sr-only">Toggle navigation</span><i class="fa fa-align-justify"></i></button>
            <button type="button" data-toggle="collapse" data-target="#search" class="btn btn-outline-secondary navbar-toggler"><span class="sr-only">Toggle search</span><i class="fa fa-search"></i></button><a href="basket.html" class="btn btn-outline-secondary navbar-toggler"><i class="fa fa-shopping-cart"></i></a>
          </div>
          <div id="navigation" class="collapse navbar-collapse">
            <ul class="navbar-nav mr-auto">
              <li class="nav-item"><a href="{{ URL::to('/') }}" class="nav-link active">Home</a></li>
              <li class="nav-item"><a href="{{ URL::to('/mens') }}" class="nav-link active">Men</a></li>
              <li class="nav-item"><a href="{{ URL::to('/womens') }}" class="nav-link active">Women</a></li>
              @if(Auth::check())
              <li class="nav-item"><a href="{{ URL::to('signout') }}" class="nav-link active">Logout</a></li>
              @else
              <li class="nav-item"><a href="{{ URL::to('login') }}" class="nav-link active">Login</a></li>
              @endif
              
              
            </ul>
            <div class="navbar-buttons d-flex justify-content-end">
              <!-- /.nav-collapse-->
              <div id="search-not-mobile" class="navbar-collapse collapse"></div><a data-toggle="collapse" href="#search" class="btn navbar-btn btn-primary d-none d-lg-inline-block"><span class="sr-only">Toggle search</span><i class="fa fa-search"></i></a>
              <div id="basket-overview" class="navbar-collapse collapse d-none d-lg-block"><a href="{{ URL::to('view-cart') }}" class="btn btn-primary navbar-btn"><i class="fa fa-shopping-cart"></i></span>
                @if(!empty(Session::get('cart')))
                <span id="cart_count">{{ count(Session::get('cart')) }}</span><span> items in cart</span>
                @else
                <span id="cart_count">0</span><span> items in cart</span>
                @endif
              </a></div>
            </div>
          </div>
        </div>
      </nav>
      <div id="search" class="collapse">
        <div class="container">
          <form role="search" class="ml-auto">
            <div class="input-group">
              <input type="text" placeholder="Search" class="form-control">
              <div class="input-group-append">
                <button type="button" class="btn btn-primary"><i class="fa fa-search"></i></button>
              </div>
            </div>
          </form>
        </div>
      </div>
    </header>
    @yield('frontend')
    <div id="footer">
      <div class="container">
        <div class="row">
          <div class="col-lg-3 col-md-6">
            <h4 class="mb-3">Pages</h4>
            <ul class="list-unstyled">
              <li><a href="text.html">About us</a></li>
              <li><a href="text.html">Terms and conditions</a></li>
              <li><a href="faq.html">FAQ</a></li>
              <li><a href="contact.html">Contact us</a></li>
            </ul>
            <hr>
            <h4 class="mb-3">User section</h4>
            <ul class="list-unstyled">
              <li><a href="#" data-toggle="modal" data-target="#login-modal">Login</a></li>
              <li><a href="register.html">Regiter</a></li>
            </ul>
          </div>
          <!-- /.col-lg-3-->
          <div class="col-lg-3 col-md-6">
            <h4 class="mb-3">Top categories</h4>
            <h5>Men</h5>
            <ul class="list-unstyled">
              <li><a href="category.html">T-shirts</a></li>
              <li><a href="category.html">Shirts</a></li>
              <li><a href="category.html">Accessories</a></li>
            </ul>
            <h5>Ladies</h5>
            <ul class="list-unstyled">
              <li><a href="category.html">T-shirts</a></li>
              <li><a href="category.html">Skirts</a></li>
              <li><a href="category.html">Pants</a></li>
              <li><a href="category.html">Accessories</a></li>
            </ul>
          </div>
          <!-- /.col-lg-3-->
          <div class="col-lg-3 col-md-6">
            <h4 class="mb-3">Where to find us</h4>
            <p><strong>Obaju Ltd.</strong><br>13/25 New Avenue<br>New Heaven<br>45Y 73J<br>England<br><strong>Great Britain</strong></p><a href="contact.html">Go to contact page</a>
            <hr class="d-block d-md-none">
          </div>
          <!-- /.col-lg-3-->
          <div class="col-lg-3 col-md-6">
            <h4 class="mb-3">Get the news</h4>
            <p class="text-muted">Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas.</p>
            <form>
              <div class="input-group">
                <input type="text" class="form-control"><span class="input-group-append">
                  <button type="button" class="btn btn-outline-secondary">Subscribe!</button></span>
              </div>
              <!-- /input-group-->
            </form>
            <hr>
            <h4 class="mb-3">Stay in touch</h4>
            <p class="social"><a href="#" class="facebook external"><i class="fa fa-facebook"></i></a><a href="#" class="twitter external"><i class="fa fa-twitter"></i></a><a href="#" class="instagram external"><i class="fa fa-instagram"></i></a><a href="#" class="gplus external"><i class="fa fa-google-plus"></i></a><a href="#" class="email external"><i class="fa fa-envelope"></i></a></p>
          </div>
          <!-- /.col-lg-3-->
        </div>
        <!-- /.row-->
      </div>
      <!-- /.container-->
    </div>
    <!-- /#footer-->
    <!-- *** FOOTER END ***-->
    
    
    <!--
    *** COPYRIGHT ***
    _________________________________________________________
    -->
    <div id="copyright">
      <div class="container">
        <div class="row">
          <div class="col-lg-6 mb-2 mb-lg-0">
            <p class="text-center text-lg-left">©2019 Your name goes here.</p>
          </div>
          <div class="col-lg-6">
            <p class="text-center text-lg-right">Template design by <a href="https://bootstrapious.com/">Bootstrapious</a>
              <!-- If you want to remove this backlink, pls purchase an Attribution-free License @ https://bootstrapious.com/p/obaju-e-commerce-template. Big thanks!-->
            </p>
          </div>
        </div>
      </div>
    </div>
    <!-- *** COPYRIGHT END ***-->
    <!-- JavaScript files-->
    <script src="{{ URL::to('public/frontend/vendor/jquery/jquery.min.js' ) }}"></script>
    <script src="{{ URL::to('public/frontend/vendor/bootstrap/js/bootstrap.bundle.min.js' ) }}"></script>
    <script src="{{ URL::to('public/frontend/vendor/jquery.cookie/jquery.cookie.js' ) }}"> </script>
    <script src="{{ URL::to('public/frontend/vendor/owl.carousel/owl.carousel.min.js' ) }}"></script>
    <script src="{{ URL::to('public/frontend/vendor/owl.carousel2.thumbs/owl.carousel2.thumbs.js' ) }}"></script>
    <script src="{{ URL::to('public/frontend/js/front.js' ) }}"></script>
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    <script src="https://cdn.jsdelivr.net/gh/gitbrent/bootstrap4-toggle@3.6.1/js/bootstrap4-toggle.min.js"></script>
    <script>
		@if(Session::has('success'))
		toastr.options =
		{
			"closeButton" : true,
			"progressBar" : true,
			"timeOut": "10000",
			"extendedTimeOut": "1000",
			"showEasing": "swing",
			"hideEasing": "linear",
		}
				toastr.success("{{ session('success') }}");
		@endif
	  
		@if(Session::has('error'))
		toastr.options =
		{
			"closeButton" : true,
			"progressBar" : true,
			"timeOut": "10000",
			"positionClass": "toast-top-right",
			"extendedTimeOut": "1000",
			"showEasing": "swing",
			"hideEasing": "linear",
		}
				toastr.error("{{ session('error') }}");
		@endif
	  
		@if(Session::has('info'))
		toastr.options =
		{
			"closeButton" : true,
			"progressBar" : true,
			"timeOut": "10000",
			"extendedTimeOut": "1000",
			"showEasing": "swing",
			"hideEasing": "linear",
		}
				toastr.info("{{ session('info') }}");
		@endif
	  
		@if(Session::has('warning'))
		toastr.options =
		{
			"closeButton" : true,
			"progressBar" : true,
			"timeOut": "10000",
			"extendedTimeOut": "1000",
			"showEasing": "swing",
			"hideEasing": "linear",
		}
				toastr.warning("{{ session('warning') }}");
		@endif
	  </script>
	  <script type="text/javascript">
		$.ajaxSetup({
			headers: {
				'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
			}
		});
		</script>
    <script type="text/javascript">
      function addToCart(){
        var quantity = $('#quantity').val();
        var product_url = $('#product_url').val();
        if(quantity !=="" && product_url !==""){
            $.ajax({
                url: '{{ URL::to('add-to-cart') }}',
                data: { 'quantity':quantity,'product_url':product_url },
                type: 'POST',
                dataType: 'html',
                success:function (result) {
                    data = JSON.parse(result);
                    if(data['result']['key'] == "200"){
                      console.log(result);
                        $('#cart_count').html(data['result']['count']);
                    }
                    if(data['result']['key'] == "101"){
                        alert(data['result']['val']);
                    }
                    if(data['result']['key'] == "102"){
                        alert(data['result']['val']);
                    }
                },
                error:function(exception){alert('Exeption:'+JSON.stringify(exception));}
            });
        }else{
            return false;
        }
    }

    function addToCartFromList(x) {
        var quantity = 1;
        var product_url = $('#product_url'+x).val();
        if(quantity !=="" && product_url !==""){
            $.ajax({
                url: '{{ URL::to('add-to-cart') }}',
                data: { 'quantity':quantity,'product_url':product_url },
                type: 'POST',
                dataType: 'html',
                success:function (result) {
                    data = JSON.parse(result);
                    if(data['result']['key'] == "200"){
                       $('#cart_count').html(data['result']['count']);
                    }
                    if(data['result']['key'] == "101"){
                        alert(data['result']['val']);
                    }
                    if(data['result']['key'] == "102"){
                        alert(data['result']['val']);
                    }
                },
                error:function(exception){alert('Exeption:'+JSON.stringify(exception));}
            });
        }else{
            return false;
        }
    }
    </script>
  </body>
</html>