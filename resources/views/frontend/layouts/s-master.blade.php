<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>@yield('title') - {{ config('app.name') }}</title>
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <meta name="keywords" content="HTML5 Template">
    <meta name="description" content="index">
    <meta name="author" content="SW-THEMES">
    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="">
    <script>
        WebFontConfig = {
            google: {
                families: ['Open+Sans:300,400,600,700', 'Poppins:300,400,500,600,700,800',
                    'Oswald:300,400,500,600,700,800', 'Playfair+Display:900', 'Shadows+Into+Light:400'
                ]
            }
        };
        (function(d) {
            var wf = d.createElement('script'),
                s = d.scripts[0];
            wf.src = 'assets/js/webfont.js';
            wf.async = true;
            s.parentNode.insertBefore(wf, s);
        })(document);
    </script>
    <!-- Plugins CSS File -->
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link rel="stylesheet" href="{{ asset('frontend/css/bootstrap.min.css') }}">
    <!-- Main CSS File -->
    <link rel="stylesheet" href="{{ asset('frontend/css/style.min.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/css/demo1.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('frontend/vendor/fontawesome-free/css/all.min.css') }}">
    <link rel="stylesheet" type="text/css"
        href="{{ asset('frontend/vendor/simple-line-icons/css/simple-line-icons.min.css') }}">
    <style>
        .product-default .product-details {
            padding: 10px;
            background-color: #ffffff;
        }

        /* main slider css starts */
        .main-slider {
            height: 332px;
            width: auto;
        }

        /* main slider css ends */
        /* custom tab css starts */
        .custom-tab {
            display: flex;
            background-color: #ffffff;
            border-radius: 25px;
        }

        .tab-image {
            height: 40px;
            width: 40px;
        }

        .tab-title {
            margin: 10px 0 0 0;
        }

        .product-image {
            height: 205px;
            width: 205px;
        }

        /* custom tab css ends */
        .home-slider img {
            height: 332px;
            object-position: center center;
        }

        @media(max-width: 991px) {
            .home-slider img {
                height: auto;
                object-position: center center;
            }

            /* custom tab css starts */
            a.custom-tab {
                display: contents;
                font-size: 0;
                background-color: #ffffff;
                justify-content: center;
            }

            .tab-image {
                margin: auto;
            }

            .tab-title {
                margin: 0;
                font-size: 10px;
                text-align: center;
            }

            /* custom tab css ends */
            .none991 {
                display: none;
            }
        }

        @media (max-width:767px) {
            .home-slider img {
                height: auto;
                object-position: center center;
            }

            .none767 {
                display: none;
            }
        }

        @media (max-width:567px) {
            .home-slider img {
                height: auto;
                object-position: center center;
            }

            .none567 {
                display: none;
            }
        }

        @media (max-width:449px) {
            .main-slider {
                height: 153px;
                width: max-content;
            }
        }

        .flash {
            text-align: right;
            padding: 5px 10px;
            border: 1px solid red;
            border-radius: 3px;
        }

    </style>
    <style>
        .product-default .product-details {
            padding: 10px;
            background-color: #ffffff;
        }

        /* custom tab css starts */
        .custom-tab {
            display: flex;
            background-color: #ffffff;
            border-radius: 25px;
        }

        .tab-image {
            height: 25px;
            width: 25px;
        }

        .tab-title {
            margin: 2px 0 0 0;
            font-weight: lighter;
        }

        /* custom tab css ends */

        /* sidebar css starts */
        .config-swatch-list {
            margin: 1.5rem 0 0;
            padding: 0;
            font-size: 0;
            list-style: none
        }

        .config-swatch-list li a {
            position: relative;
            display: block;
            width: 2.8rem;
            height: 2.8rem;
            margin: 3px 6px 3px 0;
            box-shadow: 0 0 3px 0 rgba(0, 0, 0, 0.2)
        }

        .config-swatch-list li .color-panel {
            display: inline-block;
            width: 1.7rem;
            height: 1.7rem;
            border: 1px solid #fff;
            transition: all 0.3s;
            margin-right: 1.5rem
        }

        .config-swatch-list li span:last-child {
            cursor: pointer
        }

        .config-swatch-list li:hover span:last-child {
            color: #ea6253
        }

        .config-swatch-list li.active a:before {
            display: inline-block;
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translateX(-50%) translateY(-50%);
            color: #fff;
            font-family: "porto";
            font-size: 1.1rem;
            line-height: 1;
            content: ""
        }

        .config-swatch-list a:focus .color-panel,
        .config-swatch-list a:hover .color-panel,
        .config-swatch-list li.active .color-panel {
            box-shadow: 0 0 0 0.1rem #dfdfdf
        }

        .widget .config-swatch-list {
            display: flex;
            flex-wrap: wrap;
            margin-top: 0.3rem
        }

        .widget .config-swatch-list li {
            display: -ms-flexbox;
            display: flex;
            -ms-flex-align: center;
            align-items: center;
            margin: 0;
            font-size: 1.3rem
        }

        .widget .config-swatch-list li a {
            margin: 3px 6px 3px 0;
            box-shadow: none
        }

        .product-single-filter .config-swatch-list {
            display: inline-flex;
            margin: 0
        }

        .sidebar-shop .config-swatch-list {
            display: block;
            margin-top: -2px
        }

        .sidebar-shop .config-swatch-list li a {
            margin-bottom: 13px;
            width: 16px;
            height: 16px;
            border: 1px solid #ccc;
            border-radius: 2px;
            color: #777;
            font-size: 13px;
            font-weight: 600;
            line-height: 15px;
            text-indent: 24px;
            white-space: nowrap
        }

        .sidebar-shop .config-swatch-list li a:before {
            text-indent: 0
        }

        .sidebar-shop .config-swatch-list li a.active,
        .sidebar-shop .config-swatch-list li a:hover {
            color: #ea6253
        }

        /* sidebar css ends */
        .product-image {
            height: 205px;
            width: 205px;
        }

    </style>
    @yield('css')
</head>

<body style="background-color: #f2f2f2;">
    <div class="page-wrapper">
        <div class="top-notice text-white bg-dark">
            <div class="container text-center">
                <h5 class="d-inline-block mb-0">
                    Get Up to
                    <b>40% OFF</b>
                    New-Season Styles
                </h5>
                <a href="demo1-shop.html" class="category">MEN</a>
                <a href="demo1-shop.html" class="category">WOMEN</a>
                <small>* Limited time only.</small>
                <button title="Close (Esc)" type="button" class="mfp-close">×</button>
            </div>
            <!-- End .container -->
        </div>
        <!-- End .top-notice -->
        @includeWhen($first_header ?? false, 'frontend.layouts.partials._header')
        @includeWhen($second_header ?? false, 'frontend.layouts.partials._s-header')
        <!-- End .header -->
        @yield('content')

        @include('frontend.layouts.partials._footer')
        <!-- End .footer -->
    </div>
     {{-- End .page-wrapper  --}}
    <div class="loading-overlay">
        <div class="bounce-loader">
            <div class="bounce1"></div>
            <div class="bounce2"></div>
            <div class="bounce3"></div>
        </div>
    </div>
    <div class="mobile-menu-overlay"></div>
    <!-- End .mobil-menu-overlay -->
    <div class="mobile-menu-container">
        <div class="mobile-menu-wrapper">
            <span class="mobile-menu-close">
                <i class="fa fa-times"></i>
            </span>
            <nav class="mobile-nav">
                <ul class="mobile-menu menu-with-icon">
                    <li>
                        <a href="demo1.html">
                            <i class="icon-home"></i>
                            Home
                        </a>
                    </li>
                    <li>
                        <a href="demo1-shop.html" class="sf-with-ul">
                            <i class="sicon-badge"></i>
                            Categories
                        </a>
                        <ul>
                            <li>
                                <a href="category.html">Full Width Banner</a>
                            </li>
                            <li>
                                <a href="category-banner-boxed-slider.html">Boxed Slider Banner</a>
                            </li>
                            <li>
                                <a href="category-banner-boxed-image.html">Boxed Image Banner</a>
                            </li>
                            <li>
                                <a href="https://www.portotheme.com/html/porto_ecommerce/category-sidebar-left.html">Left
                                    Sidebar</a>
                            </li>
                            <li>
                                <a href="category-sidebar-right.html">Right Sidebar</a>
                            </li>
                            <li>
                                <a href="category-off-canvas.html">Off Canvas Filter</a>
                            </li>
                            <li>
                                <a href="category-horizontal-filter1.html">Horizontal Filter 1</a>
                            </li>
                            <li>
                                <a href="category-horizontal-filter2.html">Horizontal Filter 2</a>
                            </li>
                            <li>
                                <a href="#">List Types</a>
                            </li>
                            <li>
                                <a href="category-infinite-scroll.html">
                                    Ajax Infinite Scroll
                                    <span class="tip tip-new">New</span>
                                </a>
                            </li>
                            <li>
                                <a href="category.html">3 Columns Products</a>
                            </li>
                            <li>
                                <a href="category-4col.html">4 Columns Products</a>
                            </li>
                            <li>
                                <a href="category-5col.html">5 Columns Products</a>
                            </li>
                            <li>
                                <a href="category-6col.html">6 Columns Products</a>
                            </li>
                            <li>
                                <a href="category-7col.html">7 Columns Products</a>
                            </li>
                            <li>
                                <a href="category-8col.html">8 Columns Products</a>
                            </li>
                        </ul>
                    </li>
                    <li>
                        <a href="demo1-product.html" class="sf-with-ul">
                            <i class="sicon-basket"></i>
                            Products
                        </a>
                        <ul>
                            <li>
                                <a href="#" class="nolink">PRODUCT PAGES</a>
                                <ul>
                                    <li>
                                        <a href="product.html">SIMPLE PRODUCT</a>
                                    </li>
                                    <li>
                                        <a href="product-variable.html">VARIABLE PRODUCT</a>
                                    </li>
                                    <li>
                                        <a href="product.html">SALE PRODUCT</a>
                                    </li>
                                    <li>
                                        <a href="product.html">FEATURED & ON SALE</a>
                                    </li>
                                    <li>
                                        <a href="product-sticky-info.html">WIDTH CUSTOM TAB</a>
                                    </li>
                                    <li>
                                        <a href="product-sidebar-left.html">WITH LEFT SIDEBAR</a>
                                    </li>
                                    <li>
                                        <a href="product-sidebar-right.html">WITH RIGHT SIDEBAR</a>
                                    </li>
                                    <li>
                                        <a href="product-addcart-sticky.html">ADD CART STICKY</a>
                                    </li>
                                </ul>
                            </li>
                            <li>
                                <a href="#" class="nolink">PRODUCT LAYOUTS</a>
                                <ul>
                                    <li>
                                        <a href="product-extended-layout.html">EXTENDED LAYOUT</a>
                                    </li>
                                    <li>
                                        <a href="product-grid-layout.html">GRID IMAGE</a>
                                    </li>
                                    <li>
                                        <a href="product-full-width.html">FULL WIDTH LAYOUT</a>
                                    </li>
                                    <li>
                                        <a href="product-sticky-info.html">STICKY INFO</a>
                                    </li>
                                    <li>
                                        <a href="product-sticky-both.html">LEFT & RIGHT STICKY</a>
                                    </li>
                                    <li>
                                        <a href="product-transparent-image.html">TRANSPARENT IMAGE</a>
                                    </li>
                                    <li>
                                        <a href="product-center-vertical.html">CENTER VERTICAL</a>
                                    </li>
                                    <li>
                                        <a href="#">BUILD YOUR OWN</a>
                                    </li>
                                </ul>
                            </li>
                        </ul>
                    </li>
                    <li>
                        <a href="#" class="sf-with-ul">
                            <i class="sicon-envelope"></i>
                            Pages
                        </a>
                        <ul>
                            <li>
                                <a href="wishlist.html">Wishlist</a>
                            </li>
                            <li>
                                <a href="cart.html">Shopping Cart</a>
                            </li>
                            <li>
                                <a href="checkout.html">Checkout</a>
                            </li>
                            <li>
                                <a href="dashboard.html">Dashboard</a>
                            </li>
                            <li>
                                <a href="login.html">Login</a>
                            </li>
                            <li>
                                <a href="forgot-password.html">Forgot Password</a>
                            </li>
                        </ul>
                    </li>
                    <li>
                        <a href="blog.html">
                            <i class="sicon-book-open"></i>
                            Blog
                        </a>
                    </li>
                    <li>
                        <a href="demo1-about.html">
                            <i class="sicon-users"></i>
                            About Us
                        </a>
                    </li>
                </ul>
                <ul class="mobile-menu menu-with-icon mt-2 mb-2">
                    <li class="border-0">
                        <a href="#" target="_blank">
                            <i class="sicon-star"></i>
                            Buy Porto!
                            <span class="tip tip-hot">Hot</span>
                        </a>
                    </li>
                </ul>
                <ul class="mobile-menu">
                    <li>
                        <a href="login.html">My Account</a>
                    </li>
                    <li>
                        <a href="demo1-contact.html">Contact Us</a>
                    </li>
                    <li>
                        <a href="wishlist.html">My Wishlist</a>
                    </li>
                    <li>
                        <a href="#">Site Map</a>
                    </li>
                    <li>
                        <a href="cart.html">Cart</a>
                    </li>
                    <li>
                        <a href="login.html" class="login-link">Log In</a>
                    </li>
                </ul>
            </nav>
            <!-- End .mobile-nav -->
            <form class="search-wrapper mb-2" action="#">
                <input type="text" class="form-control mb-0" placeholder="Search..." required>
                <button class="btn icon-search text-white bg-transparent p-0" type="submit"></button>
            </form>
            <div class="social-icons">
                <a href="#" class="social-icon social-facebook icon-facebook" target="_blank"></a>
                <a href="#" class="social-icon social-twitter icon-twitter" target="_blank"></a>
                <a href="#" class="social-icon social-instagram icon-instagram" target="_blank"></a>
            </div>
        </div>
        <!-- End .mobile-menu-wrapper -->
    </div>
    <!-- End .mobile-menu-container -->
    <div class="sticky-navbar">
        <div class="sticky-info">
            <a href="demo1.html">
                <i class="icon-home"></i>
                Home
            </a>
        </div>
        <div class="sticky-info">
            <a href="category.html" class="">
                <i class="icon-bars"></i>
                Categories
            </a>
        </div>
        <div class="sticky-info">
            <a href="wishlist.html" class="">
                <i class="icon-wishlist-2"></i>
                Wishlist
            </a>
        </div>
        <div class="sticky-info">
            <a href="cart.html" class="">
                <i class="icon-shopping-cart position-relative">
                    <span class="cart-count badge-circle">3</span>
                </i>
                Cart
            </a>
        </div>
    </div>
    <a id="scroll-top" href="#top" title="Top" role="button">
        <i class="icon-angle-up"></i>
    </a>
    <!-- Plugins JS File -->
    <script src="{{ asset('frontend/js/jquery.min.js') }}"></script>
    <script src="{{ asset('frontend/js/plugins.min.js') }}"></script>
    <script src="{{ asset('frontend/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('frontend/js/jquery.appear.min.js') }}"></script>
    <script src="{{ asset('frontend/js/jquery.plugin.min.js') }}"></script>
    <script src="{{ asset('frontend/js/jquery.countdown.min.js') }}"></script>
    <!-- Main JS File -->
    @include('sweetalert::alert')
    <script src="{{ asset('frontend/js/main.min.js') }}"></script>
    @yield('js')
</body>

</html>
