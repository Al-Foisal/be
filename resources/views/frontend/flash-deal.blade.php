@extends('frontend.layouts.master')
@section('title', 'Flash Deal Product')
@section('css')
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
            height: 23px;
            width: 23px;
        }

        .tab-title {
            margin: 2px 0 0 0;
            font-weight: lighter;
            font-size: 13px;
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
@endsection

@section('content')
    <main class="main">
        
        @if ($flash_deal->count() > 0)
            <div class="container-fluide">
                <div class="row">
                    <div class="col-12 mb-1">
                        <div class="home-slider category-home-slider owl-carousel owl-theme owl-carousel-lazy"
                            data-owl-options="{
                                                    'nav': false,
                                                    'autoPlay': true,
                                                    'dots':true
                                                }">
                            @foreach ($flash_deal as $fdb)
                                <a href="{{ $fdb->link }}">
                                    <div
                                        class="home-slide home-slide1 banner banner-md-vw banner-sm-vw d-flex align-items-center">
                                        <img src="{{ asset($fdb->image) }}" width="880" height="280"
                                            alt="category-banenr">
                                    </div>
                                </a>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        @endif
        <div class="container">
            <div class="row p-2 bg-white">
                <div class="products-slider 5col owl-carousel owl-theme" data-owl-options="{
                                                                                'loop': false,
                                                                                'dots': false,
                                                                                'nav': false,
                                                                                'autoplay': false
                                                                                }">
                    @foreach ($categories as $category)
                        <div class="product-default p-3" style="margin: 0;">
                            <a
                                href="{{ route('allFlashDealProduct', ['category'=>$category->slug]) }}">
                                <figure class="flex-column">
                                    <img src="{{ asset($category->image) }}" alt="Category" style="height: 80px;width: 80px;opacity: 1;    border-start-start-radius: 0px;
                                                        border-start-end-radius: 0px;">
                                    <p>{{ \Illuminate\Support\Str::limit($category->name, 10, $end = '...') }}</p>
                                </figure>
                            </a>
                        </div>
                    @endforeach
                </div>
                <!-- End .products-slider -->
            </div>
        </div>
        <div class="container">
            
            <div class="row">
                <div class="col-lg-12 mb-1">
                    <nav class="toolbox sticky-header mt-2" data-sticky-options="{'mobile': true}"
                        style="border-bottom: 1px solid;">
                        <div class="toolbox-left">
                            <p>{{ $products->count() }} products</p>
                        </div>
                        <!-- End .toolbox-left -->
                    </nav>
                    <div class="row products-group">
                        @foreach ($products as $product)
                            <div class="col-6 col-sm-4 col-md-3 col-lg-2">
                                <div class="product-default">
                                    <figure style="min-height:180px;">
                                        <a href="{{ route('productDetails', $product->slug) }}" style="height: 100%;width: 100%;">
                                            <img src="{{ asset($product->images->first()->image) }}" class="product-image"
                                                alt="product">
                                        </a>
                                        @if ($product->discount > 0)
                                            <div class="label-group">
                                                <span class="product-label label-sale">-{{ $product->discount }}%</span>
                                            </div>
                                        @endif
                                    </figure>
                                    <div class="product-details">
                                        <div class="category-wrap">
                                            <h3 class="product-title">
                                                <a href="{{ route('productDetails', $product->slug) }}">{{ $product->name }}</a>
                                            </h3>
                                            @if ($product->discount > 0)
                                                <h3 style="font-weight: 400;color: #ff0000;margin: 0;">
                                                    ৳{{ number_format($product->discount_price, 2) }}</h3>
                                                <h6 style="color: #a7a9a7;font-weight: inherit; margin: 0;height: 20px;">
                                                    <del>৳{{ number_format($product->selling, 2) }}</del>
                                                    -{{ $product->discount }}%
                                                </h6>
                                            @else
                                                <h3 style="font-weight: 400;color: #ff0000;margin: 0;">
                                                    ৳{{ number_format($product->selling, 2) }}</h3>
                                            @endif
                                            <!-- End .price-box -->
                                            <div class="ratings-container">
                                                <div class="product-ratings">
                                                    <span class="ratings"
                                                        style="width:{{ (DB::table('rating_reviews')->where('product_id', $product->id)->select('rating')->where('status', 1)->avg('rating')) *20 ??0 }}%"></span>
                                                    <!-- End .ratings -->
                                                    <span class="tooltiptext tooltip-top"></span>
                                                    ({{ $product->ratingReviews->where('status',1)->count() }})
                                                </div>
                                                <!-- End .product-ratings -->
                                            </div>
                                            <!-- End .product-container -->
                                        </div>
                                    </div>
                                    <!-- End .product-details -->
                                </div>
                            </div>
                        @endforeach
                    </div>
                    <!-- End .row -->
                    <nav class="toolbox toolbox-pagination">
                        <div class="toolbox-item toolbox-show mb-0"></div>
                        <!-- End .toolbox-item -->
                        <ul class="pagination toolbox-item mb-0">
                            {{ $products->links() }}
                        </ul>
                    </nav>
                </div>
                <!-- End .col-lg-9 -->
            </div>
            <!-- End .row -->
        </div>
        <!-- End .container -->
        <div class="mb-4"></div>
        <!-- margin -->
    </main>
@endsection
