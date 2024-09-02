<header class="header home">
    <div class="header-top text-uppercase">
        <div class="container">
            <div class="header-left"></div>
            <!-- End .header-left -->
            <div class="header-right header-dropdowns ml-0 ml-sm-auto">
                <p class="top-message mb-0 d-none d-sm-block">Welcome To {{ config('app.name') }}!</p>
                <div class="header-dropdown dropdown-expanded mr-3">
                    <a href="#">Links</a>
                    <div class="header-menu">
                        <ul>
                            @if (!auth()->check())
                                <li>
                                    <a href="{{ route('login') }}">Login</a>
                                </li>
                            @endif
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
                @if (!auth()->check())
                    <a href="{{ route('login') }}" class="logo ml-5 mr-10 d-none d-lg-flex">
                        <b class="text-primary">Login</b>
                    </a>
                @else
                    <a href="{{ route('user.dashboard') }}" class="logo ml-5 mr-10 d-none d-lg-flex">
                        <b class="text-primary">{{ auth()->user()->name }}</b> 
                    </a>
                @endif
            </div>
            <!-- End .header-right -->
        </div>
        <!-- End .container -->
    </div>
    <!-- End .header-middle -->
</header>
