@extends('frontend.layouts.master')
@section('title', 'Category Product')
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
        <div class="container">
            <nav aria-label="breadcrumb" class="breadcrumb-nav" style="border-bottom: 1px solid #EFF0F5;">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">
                        <a href="{{ route('home') }}">
                            <i class="icon-home"></i>
                        </a>
                    </li>
                    <li class="breadcrumb-item">
                        <a href="{{ route('categoryProduct', $category->slug) }}">{{ $category->name }}</a>
                    </li>
                    @if ($sub !== null)
                        <li class="breadcrumb-item @if ($child == null) {{ ' active' }} @endif">
                            <a
                                @if ($child == null) {{ '' }} @else href="{{ route('categoryProduct', [$category->slug, $subcategory->slug]) }}" @endif>{{ $subcategory->name }}</a>
                        </li>
                    @endif
                    @if ($child)
                        <li class="breadcrumb-item active" aria-current="page">{{ $childcategory->name }}</li>
                    @endif
                </ol>
            </nav>
            <main class="main">
                @if ($category_banner->count() > 0)
                    <div class="container">
                        <div class="row">
                            <div class="col-12 mb-1">
                                <div class="home-slider category-home-slider owl-carousel owl-theme owl-carousel-lazy"
                                    data-owl-options="{
                                                            'nav': false,
                                                            'autoPlay': true,
                                                            'dots':true
                                                        }">
                                    @foreach ($category_banner as $cb)
                                        <a href="{{ $cb->link }}">
                                            <div
                                                class="home-slide home-slide1 banner banner-md-vw banner-sm-vw d-flex align-items-center">
                                                <img src="{{ asset($cb->image) }}" width="880" height="280"
                                                    alt="category-banenr">
                                            </div>
                                        </a>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                @endif

                @if($related_menus->count()>0 && $category->id === 15)
                    <div class="container" style="width:98%;margin:auto;">
                        <div class="row bg-white">
                            <div class="products-slider 5col owl-carousel owl-theme" data-owl-options="{
                                                                                'loop': false,
                                                                                'dots': false,
                                                                                'nav': false,
                                                                                'autoplay': false
                                                                                }">
                                @foreach ($related_menus as $rsub)
                                    <div class="product-default p-5" style="margin: 0;">
                                        <a
                                            href="{{ route('fashionCategory') }}">
                                            <figure class="flex-column">
                                                <img src="{{ asset($rsub->image) }}" alt="Category" style="height: 80px;width: 80px;opacity: 1;    border-start-start-radius: 0px;
                                                                    border-start-end-radius: 0px;">
                                                <p>{{ \Illuminate\Support\Str::limit($rsub->name, 10, $end = '...') }}</p>
                                            </figure>
                                        </a>
                                    </div>
                                @endforeach
                                <div class="product-default p-5" style="margin: 0;">
                                    <a
                                        href="{{ route('fashionCategory') }}">
                                        <figure class="flex-column">
                                            <img src="{{ asset('images/explore.webp') }}" alt="Category" style="height: 80px;width: 80px;opacity: 1;    border-start-start-radius: 0px;
                                                                border-start-end-radius: 0px;">
                                            <p>{{ 'Explore All' }}</p>
                                        </figure>
                                    </a>
                                </div>
                            </div>
                            <!-- End .products-slider -->
                        </div>
                    </div>
                @elseif($related_menus->count()>0)
                    <div class="container" style="width:98%;margin:auto;">
                        <div class="row bg-white">
                            <div class="products-slider 5col owl-carousel owl-theme" data-owl-options="{
                                                                                'loop': false,
                                                                                'dots': false,
                                                                                'nav': false,
                                                                                'autoplay': false
                                                                                }">
                                @foreach ($related_menus as $rsub)
                                    <div class="product-default p-3" style="margin: 0;">
                                        <a
                                            href="{{ route('categoryProduct', [$category->slug, $rsub->slug, $child->slug ?? null]) }}">
                                            <figure class="flex-column">
                                                <img src="{{ asset($rsub->image) }}" alt="Category" style="height: 80px;width: 80px;opacity: 1;    border-start-start-radius: 0px;
                                                                    border-start-end-radius: 0px;">
                                                <p>{{ \Illuminate\Support\Str::limit($rsub->name, 10, $end = '...') }}</p>
                                            </figure>
                                        </a>
                                    </div>
                                @endforeach
                            </div>
                            <!-- End .products-slider -->
                        </div>
                    </div>
                @endif
            </main>
            <div class="row">
                <div class="col-lg-9 mb-1">
                    <nav class="toolbox sticky-header mt-2" data-sticky-options="{'mobile': true}"
                        style="border-bottom: 1px solid;">
                        <div class="toolbox-left">
                            <p>{{ $products->count() }} products</p>
                        </div>
                        <!-- End .toolbox-left -->
                        <div class="toolbox-right">
                            <a href="#" class="sidebar-toggle">
                                <svg data-name="Layer 3" id="Layer_3" viewBox="0 0 32 32"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <line x1="15" x2="26" y1="9" y2="9" class="cls-1"></line>
                                    <line x1="6" x2="9" y1="9" y2="9" class="cls-1"></line>
                                    <line x1="23" x2="26" y1="16" y2="16" class="cls-1"></line>
                                    <line x1="6" x2="17" y1="16" y2="16" class="cls-1"></line>
                                    <line x1="17" x2="26" y1="23" y2="23" class="cls-1"></line>
                                    <line x1="6" x2="11" y1="23" y2="23" class="cls-1"></line>
                                    <path d="M14.5,8.92A2.6,2.6,0,0,1,12,11.5,2.6,2.6,0,0,1,9.5,8.92a2.5,2.5,0,0,1,5,0Z"
                                        class="cls-2"></path>
                                    <path d="M22.5,15.92a2.5,2.5,0,1,1-5,0,2.5,2.5,0,0,1,5,0Z" class="cls-2">
                                    </path>
                                    <path d="M21,16a1,1,0,1,1-2,0,1,1,0,0,1,2,0Z" class="cls-3"></path>
                                    <path d="M16.5,22.92A2.6,2.6,0,0,1,14,25.5a2.6,2.6,0,0,1-2.5-2.58,2.5,2.5,0,0,1,5,0Z"
                                        class="cls-2"></path>
                                </svg>
                                <span>Filter</span>
                            </a>
                        </div>
                        <!-- End .toolbox-right -->
                    </nav>
                    <div class="row products-group">
                        @foreach ($products as $product)
                            <div class="col-6 col-md-4 col-lg-3">
                                <div class="product-default">
                                    <figure style="min-height:180px;">
                                        <a href="{{ route('productDetails', $product->slug) }}"
                                            style="height: 100%;width: 100%;">
                                            <img src="{{ asset($product->images->first()->image) }}"
                                                class="product-image" alt="product">
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
                                                <a
                                                    href="{{ route('productDetails', $product->slug) }}">{{ Illuminate\Support\Str::words($product->name, 5, ' ...') }}</a>
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
                                                        style="width:{{ DB::table('rating_reviews')->where('product_id', $product->id)->select('rating')->where('status', 1)->avg('rating') *20 ??0 }}%"></span>
                                                    <!-- End .ratings -->
                                                    <span class="tooltiptext tooltip-top"></span>
                                                    ({{ $product->ratingReviews->where('status', 1)->count() }})
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
                <div class="sidebar-overlay"></div>
                <aside class="sidebar-shop col-lg-3 order-lg-first mobile-sidebar">
                    <div class="sidebar-wrapper">
                        <div class="widget">
                            <h3 class="widget-title">
                                Price
                            </h3>
                            <div class="collapse show">
                                <div class="widget-body pb-0">
                                    <form
                                        action="{{ route('categoryProduct', [$category->slug, $sub->slug ?? null, $child->slug ?? null]) }}"
                                        method="get" class="config-swatch-list">
                                        <div style="width: 30%;float: left;margin-right: 4%">
                                            <input type="number" class="form-control"
                                                style="height: auto;border-radius: 3px;" name="min" min="0"
                                                placeholder="Min">
                                        </div>
                                        <div style="width: 30%;float: left;margin-right: 4%;">
                                            <input type="number" name="max" class="form-control"
                                                style="height: auto;border-radius: 3px;" max="9999999" placeholder="Max">
                                        </div>
                                        <div style="width: 30%;float: left;">
                                            <button type="submit" class="btn btn-sm"
                                                style="background-color: #da5555;border-radius: 3px;color:#fff">></button>
                                        </div>
                                    </form>
                                </div>
                                <!-- End .widget-body -->
                            </div>
                            <!-- End .collapse -->
                        </div>
                        {{-- <div class="widget">
                            <h3 class="widget-title">
                                Sizes
                            </h3>
                            <div class="collapse show">
                                <div class="widget-body pb-0">
                                    <ul class="config-swatch-list">
                                        @foreach ($sizes as $size)
                                            <li class="active">
                                                <a
                                                    href="{{ route('categoryProduct', [$category->slug, $sub->slug ?? null, $child->slug ?? null,'size'=> $size->id ]) }}">{{ $size->size }}</a>
                                            </li>
                                        @endforeach
                                    </ul>
                                </div>
                                <!-- End .widget-body -->
                            </div>
                            <!-- End .collapse -->
                        </div> --}}
                        <!-- End .widget -->
                        {{-- <div class="widget widget-color">
                            <h3 class="widget-title">
                                Colors
                            </h3>
                            <div class="collapse show">
                                <div class="widget-body pb-0">
                                    <ul class="config-swatch-list">
                                        @foreach ($colors as $color)
                                        <li>
                                            <a href="{{ route('categoryProduct', [$category->slug, $sub->slug ?? null, $child->slug ?? null,'color'=> $color->id ]) }}" style="background-color: {{ $color->color_code }};">{{ $color->color }}</a>
                                        </li>
                                        @endforeach
                                    </ul>
                                </div>
                                <!-- End .widget-body -->
                            </div>
                            <!-- End .collapse -->
                        </div> --}}
                        <!-- End .widget -->
                        <!-- End .widget -->
                        <div class="widget" style="padding: 2rem;">
                            <h3 class="widget-title">
                                Brand
                            </h3>
                            <div class="collapse show">
                                <div class="widget-body pb-0">
                                    <ul class="config-swatch-list">
                                        @foreach ($brands as $brand)
                                            <li>
                                                <a
                                                    href="{{ route('categoryProduct', [$category->slug, $sub->slug ?? null, $child->slug ?? null, 'brand' => $brand->id]) }}">{{ $brand->brand }}</a>
                                            </li>
                                        @endforeach
                                    </ul>
                                </div>
                                <!-- End .widget-body -->
                            </div>
                            <!-- End .collapse -->
                        </div>
                        <!-- End .widget -->
                        <div class="widget" style="padding: 2rem;">
                            <h3 class="widget-title">
                                Sort by Price
                            </h3>
                            <div class="collapse show">
                                <div class="widget-body pb-0">
                                    <ul class="config-swatch-list">
                                        <li>
                                            <a
                                                href="{{ route('categoryProduct', [$category->slug, $sub->slug ?? null, $child->slug ?? null, 'order' => 'ASC']) }}">Price
                                                Low to High</a>
                                        </li>
                                        <li>
                                            <a
                                                href="{{ route('categoryProduct', [$category->slug, $sub->slug ?? null, $child->slug ?? null, 'order' => 'DESC']) }}">Price
                                                High to Low</a>
                                        </li>
                                    </ul>
                                </div>
                                <!-- End .widget-body -->
                            </div>
                            <!-- End .collapse -->
                        </div>
                        <!-- End .widget -->
                    </div>
                    <!-- End .sidebar-wrapper -->
                </aside>
                <!-- End .col-lg-3 -->
            </div>
            <!-- End .row -->
        </div>
        <!-- End .container -->
        <div class="mb-4"></div>
        <!-- margin -->
    </main>
@endsection
