<footer class="footer position-relative">
    <div class="footer-middle" style="background-color: #f4f4f6;color: black;">
        <div class="container position-static">
            <div class="row">
                <div class="col-lg-3 col-sm-6 pb-2 pb-sm-0">
                    <div class="widget">
                        <h4 class="widget-title pb-1" style="color: black;">Our Criteria</h4>
                        <ul class="links">
                            @foreach ($pages as $page)
                                <li>
                                    <a href="{{ route('page', $page->slug) }}">{{ $page->title }}</a>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                    <!-- End .widget -->
                </div>
                <!-- End .col-lg-3 -->
                <div class="col-lg-3 col-sm-6 pb-2 pb-sm-0">
                    <div class="widget">
                        <h4 class="widget-title pb-1" style="color: black;">Useful Links</h4>
                        <ul class="links">
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
                    </div>
                    <!-- End .widget -->
                </div>
                <!-- End .col-lg-3 -->
                <div class="col-lg-3 col-sm-6 pb-0">
                    <div class="widget d-flex justify-content-start">
                        <img src="{{ asset($company->logo) }}" style="width: 142px;height: 42px;" alt="">
                        <br>

                        <ul class="links pl-3">
                            <li style="color: #ff0a0a;font-size: medium;">Go where your heart beats</li>
                            <li>Download the App</li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-3 col-sm-6 pb-0">
                    <div class="widget d-flex justify-content-start">
                        <img src="{{ asset('images/apps.png') }}" style="width: 150px;height: 40px;padding-left: 2rem;"
                            alt="">
                        <img src="{{ asset('images/apps.png') }}" style="width: 150px;height: 40px;padding-left: 2rem;"
                            alt="">
                    </div>
                    <!-- End .widget -->
                </div>
                <!-- End .col-lg-3 -->
            </div>
            <!-- End .row -->
        </div>
        <!-- End .container -->
    </div>
    <!-- End .footer-middle -->
    <div class="container-fluide bg-white">
        <div class="container">
            <div class="footer-bottom d-sm-flex align-items-center" style="border: none;">
                <div class="footer-left">
                    <span class="footer-copyright">Copyright © 2022 Brittanto eCommerce, All Right Reserved | Design &
                        Developed
                        By <a href="https://brittanto.com">Brittanto</a></span>
                </div>
                <div class="footer-right ml-auto mt-1 mt-sm-0">
                    <div class="payment-icons">
                        <img src="{{ asset('images/payment.png') }}" style="width:150px;height:40px;">
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End .footer-bottom -->
</footer>
