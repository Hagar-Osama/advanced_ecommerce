<header class="header-style-1">

    <!-- ============================================== TOP MENU ============================================== -->
    <div class="top-bar animate-dropdown">
      <div class="container">
        <div class="header-top-inner">
          <div class="cnt-account">
            <ul class="list-unstyled">
              <li><a href="{{route('user.dashboard',['locale' => app()->getLocale()])}}"><i class="icon fa fa-user"></i>My Account</a></li>
              <li><a href="#"><i class="icon fa fa-heart"></i>Wishlist</a></li>
              <li><a href="#"><i class="icon fa fa-shopping-cart"></i>My Cart</a></li>
              <li><a href="#"><i class="icon fa fa-check"></i>Checkout</a></li>
              @guest
              <li><a href="{{route('login')}}"><i class="icon fa fa-lock"></i>Login</a></li>
              @else
              <li style="color:white">Hello, Welcome {{ucFirst(auth()->guard('web')->user()->name)}}.</li>
              @endguest
            </ul>
          </div>
          <!-- /.cnt-account -->

          <div class="cnt-block">
            <ul class="list-unstyled list-inline">
              <li class="dropdown dropdown-small"> <a href="#" class="dropdown-toggle" data-hover="dropdown" data-toggle="dropdown"><span class="value">USD </span><b class="caret"></b></a>
                <ul class="dropdown-menu">
                  <li><a href="#">USD</a></li>
                  <li><a href="#">INR</a></li>
                  <li><a href="#">GBP</a></li>
                </ul>
              </li>
              <li class="dropdown dropdown-small"> <a href="#" class="dropdown-toggle" data-hover="dropdown" data-toggle="dropdown"><span class="value">English </span><b class="caret"></b></a>
                <ul class="dropdown-menu">
                    @foreach(config('app.languages') as $language)
                  <li><a href="{{route(Route::currentRouteName(), ['locale' => $language['locale']])}}">{{$language['name']}}</a></li>
                  @endforeach

                </ul>
              </li>
            </ul>
            <!-- /.list-unstyled -->
          </div>
          <!-- /.cnt-cart -->
          <div class="clearfix"></div>
        </div>
        <!-- /.header-top-inner -->
      </div>
      <!-- /.container -->
    </div>
    <!-- /.header-top -->
    <!-- ============================================== TOP MENU : END ============================================== -->
    <div class="main-header">
      <div class="container">
        <div class="row">
          <div class="col-xs-12 col-sm-12 col-md-3 logo-holder">
            <!-- ============================================================= LOGO ============================================================= -->
            <div class="logo"> <a href="{{route('home', ['locale' => app()->getLocale()])}}"> <img src="{{asset('endUser/assets/images/logo.png')}}" alt="logo"> </a> </div>
            <!-- /.logo -->
            <!-- ============================================================= LOGO : END ============================================================= --> </div>
          <!-- /.logo-holder -->

          <div class="col-xs-12 col-sm-12 col-md-7 top-search-holder">
            <!-- /.contact-row -->
            <!-- ============================================================= SEARCH AREA ============================================================= -->
            <div class="search-area">
              <form>
                <div class="control-group">
                  <ul class="categories-filter animate-dropdown">
                    <li class="dropdown"> <a class="dropdown-toggle"  data-toggle="dropdown" href="category.html">Categories <b class="caret"></b></a>
                      <ul class="dropdown-menu" role="menu" >
                        <li class="menu-header">Computer</li>
                        <li role="presentation"><a role="menuitem" tabindex="-1" href="category.html">- Clothing</a></li>
                        <li role="presentation"><a role="menuitem" tabindex="-1" href="category.html">- Electronics</a></li>
                        <li role="presentation"><a role="menuitem" tabindex="-1" href="category.html">- Shoes</a></li>
                        <li role="presentation"><a role="menuitem" tabindex="-1" href="category.html">- Watches</a></li>
                      </ul>
                    </li>
                  </ul>
                  <input class="search-field" placeholder="Search here..." />
                  <a class="search-button" href="#" ></a> </div>
              </form>
            </div>
            <!-- /.search-area -->
            <!-- ============================================================= SEARCH AREA : END ============================================================= --> </div>
          <!-- /.top-search-holder -->

          <div class="col-xs-12 col-sm-12 col-md-2 animate-dropdown top-cart-row">
            <!-- ============================================================= SHOPPING CART DROPDOWN ============================================================= -->

            <div class="dropdown dropdown-cart"> <a href="#" class="dropdown-toggle lnk-cart" data-toggle="dropdown">
              <div class="items-cart-inner">
                <div class="basket"> <i class="glyphicon glyphicon-shopping-cart"></i> </div>
                <div class="basket-item-count"><span class="count">2</span></div>
                <div class="total-price-basket"> <span class="lbl">cart -</span> <span class="total-price"> <span class="sign">$</span><span class="value">600.00</span> </span> </div>
              </div>
              </a>
              <ul class="dropdown-menu">
                <li>
                  <div class="cart-item product-summary">
                    <div class="row">
                      <div class="col-xs-4">
                        <div class="image"> <a href="detail.html"><img src="{{asset('endUser/assets/images/cart.jpg')}}" alt=""></a> </div>
                      </div>
                      <div class="col-xs-7">
                        <h3 class="name"><a href="index.php?page-detail">Simple Product</a></h3>
                        <div class="price">$600.00</div>
                      </div>
                      <div class="col-xs-1 action"> <a href="#"><i class="fa fa-trash"></i></a> </div>
                    </div>
                  </div>
                  <!-- /.cart-item -->
                  <div class="clearfix"></div>
                  <hr>
                  <div class="clearfix cart-total">
                    <div class="pull-right"> <span class="text">Sub Total :</span><span class='price'>$600.00</span> </div>
                    <div class="clearfix"></div>
                    <a href="checkout.html" class="btn btn-upper btn-primary btn-block m-t-20">Checkout</a> </div>
                  <!-- /.cart-total-->

                </li>
              </ul>
              <!-- /.dropdown-menu-->
            </div>
            <!-- /.dropdown-cart -->

            <!-- ============================================================= SHOPPING CART DROPDOWN : END============================================================= --> </div>
          <!-- /.top-cart-row -->
        </div>
        <!-- /.row -->

      </div>
      <!-- /.container -->

    </div>
    <!-- /.main-header -->

    <!-- ============================================== NAVBAR ============================================== -->
    <div class="header-nav animate-dropdown">
      <div class="container">
        <div class="yamm navbar navbar-default" role="navigation">
          <div class="navbar-header">
         <button data-target="#mc-horizontal-menu-collapse" data-toggle="collapse" class="navbar-toggle collapsed" type="button">
         <span class="sr-only">Toggle navigation</span> <span class="icon-bar"></span> <span class="icon-bar"></span> <span class="icon-bar"></span> </button>
          </div>
          <div class="nav-bg-class">
            <div class="navbar-collapse collapse" id="mc-horizontal-menu-collapse">
              <div class="nav-outer">
                <ul class="nav navbar-nav">
                  <li class="active dropdown yamm-fw"> <a href="{{route('home', ['locale' => app()->getLocale()])}}" data-hover="dropdown" class="dropdown-toggle">{{trans('homePage.home')}}</a> </li>
                  @foreach($categories as $category)
                  <li class="dropdown yamm mega-menu"> <a href="home.html" data-hover="dropdown" class="dropdown-toggle" data-toggle="dropdown">{{$category->name->{app()->getLocale()} }}</a>
                    <ul class="dropdown-menu container">
                      <li>
                        <div class="yamm-content ">
                          <div class="row">
                            @if(count($category->children) > 0)
                            @foreach($category->children as $child)
                            <div class="col-xs-12 col-sm-6 col-md-2 col-menu">
                              <h2 class="title">{{$child->name->{app()->getLocale()} }}</h2>
                              @if(count($child->children) > 0)
                              @foreach($child->children as $item)
                              <ul class="links">
                                <li><a href="#">{{$item->name->{app()->getLocale()} }}</a></li>

                              </ul>
                              @endforeach
                              @endif
                            </div>
                            @endforeach
                            @endif


                            <div class="col-xs-12 col-sm-6 col-md-4 col-menu banner-image"> <img class="img-responsive" src="{{asset('endUser/assets/images/banners/top-menu-banner.jpg')}}" alt=""> </div>
                            <!-- /.yamm-content -->
                          </div>
                        </div>
                      </li>
                    </ul>
                  </li>
                  <li class="dropdown mega-menu">
                  <a href="category.html"  data-hover="dropdown" class="dropdown-toggle" data-toggle="dropdown">Electronics <span class="menu-label hot-menu hidden-xs">hot</span> </a>
                    <ul class="dropdown-menu container">
                      <li>
                        <div class="yamm-content">
                          <div class="row">
                            <div class="col-xs-12 col-sm-12 col-md-2 col-menu">
                              <h2 class="title">Laptops</h2>
                              <ul class="links">
                                <li><a href="#">Gaming</a></li>
                                <li><a href="#">Laptop Skins</a></li>
                                <li><a href="#">Apple</a></li>
                                <li><a href="#">Dell</a></li>
                                <li><a href="#">Lenovo</a></li>
                                <li><a href="#">Microsoft</a></li>
                                <li><a href="#">Asus</a></li>
                                <li><a href="#">Adapters</a></li>
                                <li><a href="#">Batteries</a></li>
                                <li><a href="#">Cooling Pads</a></li>
                              </ul>
                            </div>
                            <!-- /.col -->

                            <div class="col-xs-12 col-sm-12 col-md-2 col-menu">
                              <h2 class="title">Desktops</h2>
                              <ul class="links">
                                <li><a href="#">Routers & Modems</a></li>
                                <li><a href="#">CPUs, Processors</a></li>
                                <li><a href="#">PC Gaming Store</a></li>
                                <li><a href="#">Graphics Cards</a></li>
                                <li><a href="#">Components</a></li>
                                <li><a href="#">Webcam</a></li>
                                <li><a href="#">Memory (RAM)</a></li>
                                <li><a href="#">Motherboards</a></li>
                                <li><a href="#">Keyboards</a></li>
                                <li><a href="#">Headphones</a></li>
                              </ul>
                            </div>
                            <!-- /.col -->

                            <div class="col-xs-12 col-sm-12 col-md-2 col-menu">
                              <h2 class="title">Cameras</h2>
                              <ul class="links">
                                <li><a href="#">Accessories</a></li>
                                <li><a href="#">Binoculars</a></li>
                                <li><a href="#">Telescopes</a></li>
                                <li><a href="#">Camcorders</a></li>
                                <li><a href="#">Digital</a></li>
                                <li><a href="#">Film Cameras</a></li>
                                <li><a href="#">Flashes</a></li>
                                <li><a href="#">Lenses</a></li>
                                <li><a href="#">Surveillance</a></li>
                                <li><a href="#">Tripods</a></li>
                              </ul>
                            </div>
                            <!-- /.col -->
                            <div class="col-xs-12 col-sm-12 col-md-2 col-menu">
                              <h2 class="title">Mobile Phones</h2>
                              <ul class="links">
                                <li><a href="#">Apple</a></li>
                                <li><a href="#">Samsung</a></li>
                                <li><a href="#">Lenovo</a></li>
                                <li><a href="#">Motorola</a></li>
                                <li><a href="#">LeEco</a></li>
                                <li><a href="#">Asus</a></li>
                                <li><a href="#">Acer</a></li>
                                <li><a href="#">Accessories</a></li>
                                <li><a href="#">Headphones</a></li>
                                <li><a href="#">Memory Cards</a></li>
                              </ul>
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-4 col-menu custom-banner"> <a href="#"><img alt="" src="{{asset('endUser/assets/images/banners/banner-side.png')}}"></a> </div>
                          </div>
                          <!-- /.row -->
                        </div>
                        <!-- /.yamm-content --> </li>
                    </ul>
                  </li>
                  @endforeach
                  <li class="dropdown hidden-sm"> <a href="category.html">Health & Beauty <span class="menu-label new-menu hidden-xs">new</span> </a> </li>
                  <li class="dropdown hidden-sm"> <a href="category.html">Watches</a> </li>
                  <li class="dropdown"> <a href="contact.html">Jewellery</a> </li>
                  <li class="dropdown"> <a href="contact.html">Shoes</a> </li>
                  <li class="dropdown"> <a href="contact.html">Kids & Girls</a> </li>
                  <li class="dropdown"> <a href="#" class="dropdown-toggle" data-hover="dropdown" data-toggle="dropdown">Pages</a>
                    <ul class="dropdown-menu pages">
                      <li>
                        <div class="yamm-content">
                          <div class="row">
                            <div class="col-xs-12 col-menu">
                              <ul class="links">
                                <li><a href="home.html">Home</a></li>
                                <li><a href="category.html">Category</a></li>
                                <li><a href="detail.html">Detail</a></li>
                                <li><a href="shopping-cart.html">Shopping Cart Summary</a></li>
                                <li><a href="checkout.html">Checkout</a></li>
                                <li><a href="blog.html">Blog</a></li>
                                <li><a href="blog-details.html">Blog Detail</a></li>
                                <li><a href="contact.html">Contact</a></li>
                                <li><a href="sign-in.html">Sign In</a></li>
                                <li><a href="my-wishlist.html">Wishlist</a></li>
                                <li><a href="terms-conditions.html">Terms and Condition</a></li>
                                <li><a href="track-orders.html">Track Orders</a></li>
                                <li><a href="product-comparison.html">Product-Comparison</a></li>
                                <li><a href="faq.html">FAQ</a></li>
                                <li><a href="404.html">404</a></li>
                              </ul>
                            </div>
                          </div>
                        </div>
                      </li>
                    </ul>
                  </li>
                  <li class="dropdown  navbar-right special-menu"> <a href="#">Todays offer</a> </li>
                </ul>
                <!-- /.navbar-nav -->
                <div class="clearfix"></div>
              </div>
              <!-- /.nav-outer -->
            </div>
            <!-- /.navbar-collapse -->

          </div>
          <!-- /.nav-bg-class -->
        </div>
        <!-- /.navbar-default -->
      </div>
      <!-- /.container-class -->

    </div>
    <!-- /.header-nav -->
    <!-- ============================================== NAVBAR : END ============================================== -->

  </header>
