<header class="header">
    <div class="header-top text-uppercase">
        <div class="container">
            <div class="header-left"></div>
            <!-- End .header-left -->
            <div class="header-right header-dropdowns ml-0 ml-sm-auto">
                <p class="top-message mb-0 d-none d-sm-block">Welcome To Brittanto eCommerce!</p>
                <div class="header-dropdown dropdown-expanded mr-3">
                    <a href="#">Links</a>
                    <div class="header-menu">
                        <ul>
                            <li>
                                <a href="{{ route('login') }}">Login</a>
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
                            <li>
                                <a href="{{ route('order.track') }}">Track My Order</a>
                            </li>
                        </ul>
                    </div>
                    <!-- End .header-menu -->
                </div>
                <!-- End .header-dropown -->
            </div>
            <!-- End .header-right -->
        </div>
        <!-- End .container -->
    </div>
    <!-- End .header-top -->
    <div class="header-middle text-dark sticky-header" style="background-color: #ffffff;">
        <div class="container">
            <div class="header-left col-lg-2 pl-0 d-none d-lg-flex">
                <a href="{{ route('home') }}" class="logo">
                    <img src="{{ asset($company->logo) }}" width="150" height="50" alt="Logo">
                </a>
            </div>
            <!-- End .header-left -->
            <div class="header-right">
                <div class="header-search header-search-inline header-search-category w-lg-max">
                    <form action="{{ route('search') }}" method="get">
                        <div class="header-search-wrapper">
                            <input type="search" class="form-control" name="search" id="q"
                                placeholder="Search..." required>
                            <!-- End .select-custom -->
                            <button class="btn icon-magnifier" style="background-color: #ff0a0a;color: white;"
                                type="submit"></button>
                        </div>
                        <!-- End .header-search-wrapper -->
                    </form>
                </div>
                <!-- End .header-search -->
                <div class="dropdown cart-dropdown">
                    <a href="{{ route('cart') }}" title="Cart" class="d-none d-lg-flex ml-5">
                        <i class="minicart-icon"></i>
                        <span class="cart-count badge-circle total_cart_items">{{ Cart::count() }}</span>
                    </a>
                </div>
                <a href="{{ $company->wallet_link }}" class="logo ml-5 mr-10 d-none d-lg-flex">
                    <img src="{{ asset($company->wallet) }}" width="150" height="50" alt="Logo">
                </a>
            </div>
            <!-- End .header-right -->
        </div>
        <!-- End .container -->
    </div>
    <!-- End .header-middle -->
    <div class="header-bottom sticky-header d-none d-lg-block" style="background-color: #ffffff;"
        data-sticky-options="{'mobile': true}">
        <div class="container">
            <div class="header-left">
                <nav class="main-nav w-100">
                    <ul class="menu">
                        <li>
                            <a href="#">Categories</a>
                            <ul>
                                @foreach ($categories as $category)
                                    @php
                                        if ($category->id === 14 || $category->id === 15) {
                                            continue;
                                        }
                                    @endphp
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
                        </li>
                    </ul>
                </nav>
            </div>
            <div class="header-right">
                <div class="section-elements">
                    <div class="container">
                        <div class="row">
                            <div class="col-4 col-lg-2 mb-1">
                                <a href="{{ route('allMallProduct') }}" class="custom-tab" style="">
                                    <img src="{{ asset('frontend/mall.png') }}" alt="" class="tab-image">
                                    <h5 class="tab-title">BazarMall</h5>
                                </a>
                            </div>
                            <div class="col-4 col-lg-2 mb-1">
                                <a href="{{ route('allFlashDealProduct') }}" class="custom-tab">
                                    <img src="{{ asset('frontend/mall.png') }}" alt="" class="tab-image">
                                    <h5 class="tab-title">Flash Deal</h5>
                                </a>
                            </div>
                            <div class="col-4 col-lg-2 mb-1">
                                @php
                                    $fashion = DB::table('categories')->find(15);
                                @endphp
                                <a href="{{ route('categoryProduct', $fashion->slug) }}" class="custom-tab">
                                    <img src="{{ asset('frontend/mall.png') }}" alt="" class="tab-image">
                                    <h5 class="tab-title">{{ $fashion->name }}</h5>
                                </a>
                            </div>
                            <div class="col-4 col-lg-3 mb-1">
                                <a href="{{ route('allEverydayLowPriceProduct') }}" class="custom-tab">
                                    <img src="{{ asset('frontend/mall.png') }}" alt="" class="tab-image">
                                    <h5 class="tab-title">Everyday Low Price</h5>
                                </a>
                            </div>
                            <div class="col-4 col-lg-2 mb-1">
                                <a href="{{ route('categoryProduct', $grocery->slug) }}" class="custom-tab">
                                    <img src="{{ asset('frontend/mall.png') }}" alt="" class="tab-image">
                                    <h5 class="tab-title">Grocery</h5>
                                </a>
                            </div>
                            <div class="col-4 col-lg-1 mb-1">
                                <a href="{{ route('voucher') }}" class="custom-tab">
                                    <img src="{{ asset('frontend/mall.png') }}" alt="" class="tab-image">
                                    <h5 class="tab-title">Voucher</h5>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- End .container -->
    </div>
    <!-- End .header-bottom -->
</header>
