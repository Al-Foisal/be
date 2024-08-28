@extends('frontend.layouts.master')
@section('title', 'Best online shopping in Bangladesh')
@section('content')
    <main class="main" id="bg">
        <div class="container-fluide" style="position: relative;">
            <div class="row">
                <div class="home-slider slide-animate owl-carousel owl-theme"
                    data-owl-options="{
                                                                                                                                        'loop': true,
                                                                                                                                        'dots': true,
                                                                                                                                        'nav': false,
                                                                                                                                        'autoplay': true
                                                                                                                                        }">
                    @foreach ($slider as $slid)
                        <div class="home-slide">
                            <a href="{{ $slid->link }}">
                                <img class="slide-bg" src="{{ asset($slid->image) }}" alt="home-slider">
                            </a>
                        </div>
                    @endforeach
                    <!-- End .home-slide -->
                </div>
                <!-- End .home-slider -->
                <!-- End .col-lg-9 -->
                <aside class="sidebar-home order-lg-first mobile-sidebar"
                    style="padding: 0;position: absolute; z-index: 111;width: 17%;margin-left: 5rem;">
                    <div class="side-menu-wrapper text-uppercase d-none d-lg-block">
                        <nav class="side-nav" style="height: 41.7rem; background-color: #ffffff;">
                            <ul class="menu menu-vertical sf-arrows">
                                @foreach ($categories as $category)
                                @php
                                    if($category->id === 14 || $category->id === 15){
                                        continue;
                                        }
                                @endphp
                                    <li>
                                        <a href="{{ route('categoryProduct', $category->slug) }}" class="sf-with-ul">
                                            <i class="fa {{ $category->icon }}"></i><b style="color: black">{{ $category->name }}</b>
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
                        </nav>
                    </div>
                </aside>
                <!-- End .col-lg-3 -->
            </div>
            <!-- End .row -->
        </div>
        <!-- End .container -->
    </main>
    <main class="main home" style="">
        <div class="section-elements" style="background: #f4f4f4;padding: 2rem 0;">
            <div class="container">
                <div class="row">
                    <div class="col-4 col-lg-2 mb-1">
                        <a href="{{ route('allMallProduct') }}" class="custom-tab" style="">
                            <img src="{{ asset('frontend/mall.png') }}" alt="" class="tab-image">
                            <h5 class="tab-title">BazartMall</h5>
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
                        <a href="{{ route('categoryProduct',$fashion->slug) }}" class="custom-tab">
                            <img src="{{ asset('frontend/mall.png') }}" alt="" class="tab-image">
                            <h5 class="tab-title">{{ $fashion->name }}</h5>
                        </a>
                    </div>
                    <div class="col-4 col-lg-2 mb-1">
                        <a href="{{ route('categoryProduct', $grocery->slug) }}" class="custom-tab">
                            <img src="{{ asset('frontend/mall.png') }}" alt="" class="tab-image">
                            <h5 class="tab-title">Grocery</h5>
                        </a>
                    </div>
                    <div class="col-4 col-lg-2 mb-1">
                        <a href="{{ route('allEverydayLowPriceProduct') }}" class="custom-tab">
                            <img src="{{ asset('frontend/mall.png') }}" alt="" class="tab-image">
                            <h5 class="tab-title">Everyday Low Price</h5>
                        </a>
                    </div>
                    <div class="col-4 col-lg-2 mb-1">
                        <a href="{{ route('voucher') }}" class="custom-tab">
                            <img src="{{ asset('frontend/mall.png') }}" alt="" class="tab-image">
                            <h5 class="tab-title">Voucher</h5>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <main class="main mb-5 mm">
        <div class="container d-flex justify-content-between">
            <div>
                <h4 style="margin-bottom: 0;">Flash Sale</h4>
            </div>
            <div @if ($sale < today()) style="display: none" @endif>
                <a style="margin-bottom: 0;color: #ff0a0a;" href="{{ route('allFlashSaleProduct') }}"
                    class="flash">View All Product</a>
            </div>
        </div>
        <div class="container" style="background-color: #ffffff;">
            <div class="countdown-container d-flex" style="border-bottom: 1px solid #dddddd;">
                <h4 class="text-uppercase" style="font-weight: lighter;margin: 14px 5px 0 0;">Ends in:</h4>
                <div class="countdown countdown-type1" data-labels-short="true"
                    data-until="{{ $y }}, {{ $m }}, {{ $d }}" style="padding:10px;">
                </div>
            </div>

            <div class="row mt-2" @if ($sale < today()) style="display: none" @endif>
                <div class="products-slider 5col owl-carousel owl-theme" data-owl-options="{
                                                            'loop': false,
                                                            'dots': false,
                                                            'nav': false,
                                                            'autoplay': true
                                                            }">
                    @foreach ($flash_sale as $sale)
                        <div class="product-default">
                            <figure>
                                <a href="{{ route('productDetails', $sale->slug) }}" style="height: 100%;width: 100%;">
                                    <img src="{{ asset($sale->images->first()->image) }}" class="product-image"
                                        alt="product">
                                </a>
                            </figure>
                            <div class="product-details">
                                <div class="category-wrap">
                                    <h3 class="product-title">
                                        <a href="{{ route('productDetails', $sale->slug) }}">{{ $sale->name }}</a>
                                    </h3>
                                    @if ($sale->discount > 0)
                                        <h3 style="font-weight: 400;color: #ff0000;margin: 0;">
                                            ৳{{ number_format($sale->discount_price, 2) }}</h3>
                                        <h6 style="color: #a7a9a7;font-weight: inherit; margin: 0;height: 20px;">
                                            <del>৳{{ number_format($sale->selling, 2) }}</del>
                                            -{{ $sale->discount }}%
                                        </h6>
                                    @else
                                        <h3 style="font-weight: 400;color: #ff0000;margin: 0;">
                                            ৳{{ number_format($sale->selling, 2) }}</h3>
                                    @endif
                                    <!-- End .price-box -->
                                </div>
                            </div>
                            <!-- End .product-details -->
                        </div>
                        <!-- End .col-sm-4 -->
                    @endforeach
                </div>
            </div>
        </div>
    </main>

    <main class="main mb-5 mm">
        <div class="container">
            <div class="d-flex justify-content-between" style="padding: 15px 0;">
                <h4 style="margin-bottom: 0;">Everyday Low Price</h4>
                <a style="margin-bottom: 0;color: #ff0a0a;" href="{{ route('allEverydayLowPriceProduct') }}"
                    class="flash">View All Product</a>
            </div>
            <div class="row p-2 bg-white">
                <div class="products-slider 5col owl-carousel owl-theme" data-owl-options="{
                                                                                'loop': false,
                                                                                'dots': false,
                                                                                'nav': false,
                                                                                'autoplay': true
                                                                                }">
                    @foreach ($low_price as $price)
                        <div class="product-default">
                            <figure style="align-items: center;
                                                                                    position: relative;display:block;
                                                                                    margin-bottom: 0;"
                                class="img-effect">
                                <a href="{{ route('productDetails', $price->slug) }}">
                                    <img src="{{ asset($price->images->first()->image) }}" width="205" height="205"
                                        alt="product">
                                </a>
                            </figure>
                            <div class="product-details">
                                <h3 class="product-title">
                                    <a href="{{ route('productDetails', $price->slug) }}">{{ $price->name }}</a>
                                </h3>
                                <div class="price-box">
                                    @if ($price->discount > 0)
                                        <span
                                            class="product-price">৳{{ number_format($price->discount_price, 2) }}</span>
                                        <span class="old-price">৳{{ number_format($price->selling, 2) }}</span>
                                    @else
                                        <span class="product-price">৳{{ number_format($price->selling, 2) }}</span>
                                    @endif
                                </div>
                                <!-- End .price-box -->
                            </div>
                            <!-- End .product-details -->
                        </div>
                    @endforeach
                </div>
                <!-- End .products-slider -->
            </div>
        </div>
    </main>

    <main class="main mb-5 mm">
        <div class="container">
            <div class="d-flex justify-content-between" style="padding: 15px 0;">
                <h4 style="margin-bottom: 0;">Collections</h4>
                <a style="margin-bottom: 0;color: #ff0a0a;" href="{{ route('allCollection') }}"
                    class="flash">View All
                    Collections</a>
            </div>
        </div>
        <div class="container pt-2" style="background-color: #ffffff;">
            <div class="row divide-line">
                <!-- product 1 -->
                @foreach ($collections as $col)
                    <div class="col-lg-3 col-12  vv">
                        <a href="{{ route('allProductCollection', $col) }}">
                            <div class="product-default inner-icon" style="padding-top: 20px;">
                                <div style="text-align: center;color: black;">
                                    {{ $col->name }} >
                                </div>
                                <div style="text-align: center;">
                                    @php
                                        $count = 0;
                                        foreach (explode(',', $col->product_collection) as $coll) {
                                            $sub = \App\Models\Subcategory::where('id', $coll)
                                                ->with('products')
                                                ->first();
                                            $count += $sub->products->count();
                                        }
                                    @endphp
                                    {{ $count }} products
                                </div>
                                <div class="d-flex justify-content-between">
                                    @php
                                        foreach (explode(',', $col->product_collection) as $coll) {
                                            $sub = \App\Models\Subcategory::where('id', $coll)
                                                ->with('products')
                                                ->first();
                                            echo '<img src="' . asset($sub->image) . '" alt="Category" style="height: 80px;width: 80px;">';
                                        }
                                    @endphp
                                </div>
                            </div>
                        </a>
                        <!-- End .product-default -->
                    </div>
                @endforeach
            </div>
        </div>
    </main>

    {{-- mobile banner --}}
    <main class="main mobile mm">
        <div class="container" style="position: relative;">
            <div class="row">
                <div class="col-6">
                    <div class="home-slider slide-animate owl-carousel owl-theme"
                        data-owl-options="{
                                                                                                                                        'loop': true,
                                                                                                                                        'dots': true,
                                                                                                                                        'nav': false,
                                                                                                                                        'autoplay': false
                                                                                                                                        }">
                        @foreach ($left_slider as $left)
                            <div class="home-slide">
                                <a href="{{ $left->link }}">
                                    <img class="slide-bg" src="{{ asset($left->image) }}" alt="home-slider"
                                        style="border-radius: 10px;">
                                </a>
                            </div>
                        @endforeach
                        <!-- End .home-slide -->
                    </div>
                    <!-- End .home-slider -->
                </div>
                <div class="col-6">
                    <div class="home-slider slide-animate owl-carousel owl-theme"
                        data-owl-options="{
                                                                                                                                        'loop': true,
                                                                                                                                        'dots': true,
                                                                                                                                        'nav': false,
                                                                                                                                        'autoplay': false
                                                                                                                                        }">
                        @foreach ($right_slider as $right)
                            <div class="home-slide">
                                <a href="{{ $right->link }}">
                                    <img class="slide-bg" src="{{ asset($right->image) }}" alt="home-slider"
                                        style="border-radius: 10px;">
                                </a>
                            </div>
                        @endforeach
                        <!-- End .home-slide -->
                    </div>
                    <!-- End .home-slider -->
                </div>
            </div>
            <!-- End .row -->
        </div>
        <!-- End .container -->
    </main>

    <main class="main mb-5 mm">
        <div class="container">
            <div class="d-flex justify-content-between" style="padding: 15px 0;">
                <h4 style="margin-bottom: 0;">Categories</h4>
            </div>
        </div>
        <div class="container pt-2" style="background-color: #ffffff;">
            <div class="row divide-line">
                <!-- product 1 -->
                @foreach ($subcategory as $sub)
                    <div class="col-lg-2 col-4 vv">
                        <div class="product-default inner-icon" style="padding-top: 20px;">
                            <figure style="margin: 0;">
                                <a href="{{ route('categoryProduct', [$sub->category->slug, $sub->slug]) }}">
                                    <img src="{{ asset($sub->image) }}" alt="Category"
                                        style="height: 80px;width: 80px;    border-start-start-radius: 0px;
                                        border-start-end-radius: 0px;">
                                    {{ $sub->name }}
                                </a>
                            </figure>
                        </div>
                        <!-- End .product-default -->
                    </div>
                @endforeach
            </div>
        </div>
    </main>

    <main class="main mb-5 mm">
        <div class="container" style="">
            <div class="d-flex justify-content-between" style="padding: 15px 0;">
                <h4 style="margin-bottom: 0;">BazarMall</h4>
                <a style="margin-bottom: 0;color: #ff0a0a;" href="{{ route('allMallProduct') }}"
                    class="flash">View All</a>
            </div>
        </div>
        <div class="container bg-white pt-2">
            <div class="row">
                <div class="products-slider 5col owl-carousel owl-theme" data-owl-options="{
                                                                                            'loop': false,
                                                                                            'dots': false,
                                                                                            'nav': false,
                                                                                            'autoplay': true
                                                                                            }">
                    @foreach ($malls as $mall)
                        <div class="product-default">
                            <figure>
                                <a href="{{ route('mallProduct', $mall->id) }}" style="height: 100%;width: 100%;">
                                    <img src="{{ asset($mall->image) }}" class="product-image" alt="product">
                                </a>
                            </figure>
                            <div class="product-details vv" style="padding-top: 10%;padding-bottom: 10%;">
                                <div class="category-wrap">
                                    <h3 class="product-title text-center">
                                        <a href="{{ route('mallProduct', $mall->id) }}">{{ $mall->brand }}</a>
                                        <p style="color: #848684;font-size: 12px;">{{ $mall->brand_title }}</p>
                                    </h3>
                                </div>
                            </div>
                            <!-- End .product-details -->
                        </div>
                    @endforeach
                    <!-- End .col-sm-4 -->
                </div>
                <!-- End .col-sm-4 -->
            </div>
        </div>
    </main>

    <main class="main mb-5 mm">
        <div class="container">
            <h4 class="text-uppercase heading-bottom-border mt-8">Just For You</h4>
            <div class="row mt-2" id="product">
                {{-- @foreach ($products as $product)
                    <div class="col-6 col-sm-4 col-md-3 col-lg-2">
                        <div class="product-default">
                            <figure>
                                <a href="product.html" style="height: 100%;width: 100%;">
                                    <img src="{{ asset($product->images->first()->image) }}" class="product-image"
                                        alt="product">
                                </a>
                                @if ($product->discount > 0)
                                    <div class="label-group">
                                        <div class="product-label label-sale">-{{ $product->discount }}%</div>
                                    </div>
                                @endif
                            </figure>
                            <div class="product-details">
                                <div class="category-wrap">
                                    <h3 class="product-title">
                                        <a href="product.html">{{ $product->name }}</a>
                                    </h3>
                                    @if ($product->discount > 0)
                                        <h3 style="font-weight: 400;color: #ff0000;margin: 0;">${{ number_format($product->discount_price, 2) }}</h3>
                                        <h6 style="color: #a7a9a7;font-weight: inherit; margin: 0;height: 20px;">
                                            <del>${{ number_format($product->selling, 2) }}</del>
                                            -{{ $product->discount }}%
                                        </h6>
                                    @else
                                        <h3 style="font-weight: 400;color: #ff0000;margin: 0;">${{ number_format($product->selling, 2) }}</h3>
                                    @endif
                                    <!-- End .price-box -->
                                    <div class="ratings-container">
                                        <div class="product-ratings">
                                            <span class="ratings" style="width:100%;"></span>
                                            <!-- End .ratings -->
                                            <span class="tooltiptext tooltip-top"></span>
                                            (0)
                                        </div>
                                        <!-- End .product-ratings -->
                                    </div>
                                    <!-- End .product-container -->
                                </div>
                            </div>
                            <!-- End .product-details -->
                        </div>
                    </div>
                @endforeach --}}
            </div>
        </div>
        <div class="size-various">
            <ul class="btn-list" style="margin: 0;padding: 0;text-align: center">
                <li>
                    <button class="btn btn-outline-primary btn-lg" style="padding: .5% 8%;" id="load-more"
                        data-paginate="2">Load more product</button>
                    <p class="invisible">No more posts...</p>
                </li>
            </ul>
        </div>
    </main>
@endsection

@section('js')
    <script type="text/javascript">
        var paginate = 1;
        loadMoreData(paginate);

        $('#load-more').click(function() {
            var page = $(this).data('paginate');
            loadMoreData(page);
            $(this).data('paginate', page + 1);
        });
        // run function when user click load more button
        function loadMoreData(paginate) {
            $.ajax({
                    url: '?page=' + paginate,
                    type: 'get',
                    datatype: 'html',
                    beforeSend: function() {
                        $('#load-more').text('Loading...');
                    }
                })
                .done(function(data) {
                    if (data.length == 0) {
                        $('.invisible').removeClass('invisible');
                        $('#load-more').hide();
                        return;
                    } else {
                        $('#load-more').text('Load more...');
                        $('#product').append(data);
                    }
                })
                .fail(function(jqXHR, ajaxOptions, thrownError) {
                    alert('Something went wrong.');
                });
        }
    </script>
@endsection
