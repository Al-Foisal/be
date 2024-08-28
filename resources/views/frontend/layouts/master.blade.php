<!--
Website: Bazar kart 
Author: QuickTech IT  
Author URI: http://quicktech-ltd.com;
Description: QuickTech IT maintain standard quality for e-commerce website.
Version: 201.0.0
-->


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
    <link rel="stylesheet" href="{{ asset('frontend/css/demo1.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('frontend/vendor/fontawesome-free/css/all.min.css') }}">
    <link rel="stylesheet" type="text/css"
        href="{{ asset('frontend/vendor/simple-line-icons/css/simple-line-icons.min.css') }}">
    <style>
        .mobile {
            display: none;
        }

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
            height: 418px;
            object-position: center center;
        }

        @media(max-width: 991px) {
            .mobile {
                display: block;
            }

            .mm {
                margin: auto;
                width: 90%;
            }

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

        body {
            background-color: #f2f2f2;
        }

        .home-slider .owl-dots {
            bottom: 15px;
        }

        .product-details {
            border-bottom-left-radius: 6px;
            border-bottom-right-radius: 6px;
        }

    </style>
    {{--  --}}
    @yield('css')
</head>

<body>
    <div class="page-wrapper">
        @if ($banner_collection && Route::is('home'))
            <div class="top-notice text-white bg-dark d-none d-lg-block">
                <a href="{{ route('bannerCollectionProduct', $banner_collection->banner_collection) }}">
                    <img src="{{ asset($banner_collection->image) }}" style="    height: 100px;
                    width: 100%;">
                </a>
                <!-- End .container -->
            </div>
        @endif
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
                        <a href="{{ route('home') }}">
                            <i class="icon-home"></i>
                            Home
                        </a>
                    </li>
                    @foreach ($categories as $category)
                        <li>
                            <a href="{{ route('categoryProduct', $category->slug) }}" class="sf-with-ul">
                                {{ $category->name }}
                            </a>
                            @if ($category->subcategories->count() > 0)
                                <ul>
                                    @foreach ($category->subcategories->where('status', 1) as $sub)
                                        <li>
                                            <a
                                                href="{{ route('categoryProduct', [$category->slug, $sub->slug]) }}">{{ $sub->name }}</a>
                                            @if ($sub->childcategories->count() > 0)
                                                <ul>
                                                    @foreach ($sub->childcategories->where('status', 1) as $child)
                                                        <li>
                                                            <a
                                                                href="{{ route('categoryProduct', [$category->slug, $sub->slug, $child->slug]) }}">{{ $child->name }}</a>
                                                        </li>
                                                    @endforeach
                                                </ul>
                                            @endif
                                        </li>
                                    @endforeach
                                </ul>
                            @endif
                        </li>
                    @endforeach
                </ul>
                <ul class="mobile-menu">
                    <li>
                        <a href="{{ route('user.dashboard') }}">My Account</a>
                    </li>
                    <li>
                        <a href="{{ route('cart') }}">Cart</a>
                    </li>
                    <li>
                        <a href="{{ route('wishlist') }}">Wishlist</a>
                    </li>
                    <li>
                        <a href="{{ route('orderHistory') }}">Order History</a>
                    </li>
                    <li>
                        <a href="{{ route('checkout') }}">Checkout</a>
                    </li>
                </ul>
            </nav>
            <!-- End .mobile-nav -->
            <form class="search-wrapper mb-2" action="{{ route('search') }}">
                <input type="text" class="form-control mb-0" name="search" placeholder="Search..." required>
                <button class="btn icon-search text-white bg-transparent p-0" type="submit"></button>
            </form>
            <div class="social-icons">
                @if (!empty($company->facebook))
                    <a href="{{ $company->facebook }}" class="social-icon social-facebook icon-facebook"
                        target="_blank"></a>
                @endif
                @if (!empty($company->twitter))
                    <a href="{{ $company->twitter }}" class="social-icon social-twitter icon-twitter"
                        target="_blank"></a>
                @endif
                @if (!empty($company->instagram))
                    <a href="{{ $company->instagram }}" class="social-icon social-instagram icon-instagram"
                        target="_blank"></a>
                @endif
                @if (!empty($company->pinterest))
                    <a href="{{ $company->pinterest }}" class="social-icon social-pinterest icon-pinterest"
                        target="_blank"></a>
                @endif
                @if (!empty($company->linkedin))
                    <a href="{{ $company->linkedin }}" class="social-icon social-linkedin icon-linkedin"
                        target="_blank"></a>
                @endif
                @if (!empty($company->youtube))
                    <a href="{{ $company->youtube }}" class="social-icon social-youtube icon-youtube"
                        target="_blank"></a>
                @endif
            </div>
        </div>
        <!-- End .mobile-menu-wrapper -->
    </div>
    <!-- End .mobile-menu-container -->
    <div class="sticky-navbar">
        <div class="sticky-info">
            <a href="{{ route('home') }}">
                <i class="icon-home"></i>
                Home
            </a>
        </div>
        <div class="sticky-info">
            <a href="{{ route('category') }}" class="">
                <i class="icon-bars"></i>
                Categories
            </a>
        </div>
        <div class="sticky-info">
            <a href="{{ route('wishlist') }}" class="">
                <i class="icon-wishlist-2"></i>
                Wishlist
            </a>
        </div>
        <div class="sticky-info">
            <a href="{{ route('cart') }}" class="">
                <i class="icon-shopping-cart position-relative">
                    <span class="cart-count badge-circle total_cart_items">{{ Cart::count() }}</span>
                </i>
                Cart
            </a>
        </div>
        <div class="sticky-info">
            <a href="{{ route('user.dashboard') }}" class="">
                <i class="icon-user-2"></i>
                Account
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
