@extends('frontend.layouts.master')
@section('title', $product->name)
@section('css')
    <style>
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
        .product-image {
            height: 205px;
            width: 205px;
        }

        .product-default .product-details {
            padding: 10px;
            background-color: #ffffff;
        }

        .visible991 {
            display: none;
        }

        @media (max-width:991px) {
            .visible991 {
                display: flex;
            }
        }

    </style>
@endsection
@section('content')
    <main class="main">
        <div class="container">
            <nav aria-label="breadcrumb" class="breadcrumb-nav">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('home') }}"><i class="icon-home"></i></a></li>
                    <li class="breadcrumb-item">Products</li>
                    <li class="breadcrumb-item">{{ $product->name }}</li>
                </ol>
            </nav>
            <div class="row bg-white">
                <div class="col-lg-9 main-content product-sidebar-right">
                    <div class="product-single-container product-single-default">

                        <div class="row">
                            <div class="col-xl-5 col-md-6 product-single-gallery mb-3">
                                <div class="product-slider-container">
                                    @if ($product->discount > 0)
                                        <div class="label-group">
                                            <div class="product-label label-sale">
                                                -{{ $product->discount }}%
                                            </div>
                                        </div>
                                    @endif

                                    <div class="product-single-carousel owl-carousel owl-theme show-nav-hover"
                                        data-owl-options="{
                                                    'nav': true,
                                                    'autoPlay': true
                                                }">
                                        @if ($product->video)
                                            <div class="product-item">
                                                <iframe width="353" height="353" src="{{ $product->video }}"
                                                    title="YouTube video player" disabled frameborder="1" allow=""></iframe>
                                            </div>
                                        @endif
                                        @foreach ($product->images as $image)
                                            <div class="product-item">
                                                <img class="product-single-image" src="{{ asset($image->image) }}"
                                                    data-zoom-image="{{ asset($image->image) }}" width="468" height="468"
                                                    alt="product" />
                                            </div>
                                        @endforeach
                                    </div>
                                    <!-- End .product-single-carousel -->
                                    <span class="prod-full-screen">
                                        <i class="icon-plus"></i>
                                    </span>
                                </div>

                                <div class="prod-thumbnail owl-dots">
                                    @if ($product->video)
                                        <div class="owl-dot">
                                            <img src="{{ asset('images/video.jpg') }}" width="110" height="110"
                                                alt="product-thumbnail" />
                                        </div>
                                    @endif
                                    @foreach ($product->images as $image)
                                        <div class="owl-dot">
                                            <img src="{{ asset($image->image) }}" width="110" height="110"
                                                alt="product-thumbnail" />
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                            <!-- End .product-single-gallery -->

                            <div class="col-xl-7 col-md-6 product-single-details">
                                <h1 class="product-title">{{ $product->name }}</h1>

                                <div class="ratings-container">
                                    <div class="product-ratings">
                                        <span class="ratings"
                                            style="width:{{ DB::table('rating_reviews')->where('product_id', $product->id)->select('rating')->where('status', 1)->avg('rating') *20 ??0 }}%"></span>
                                        <!-- End .ratings -->
                                        <span class="tooltiptext tooltip-top"></span>
                                    </div>
                                    <!-- End .product-ratings -->

                                    <a href="#" class="rating-link">(
                                        {{ $product->ratingReviews->where('status', 1)->count() }} Reviews )</a>
                                </div>
                                <hr class="divider mb-2 mt-0">
                                <!-- End .ratings-container -->
                                <ul class="single-info-list">
                                    <!---->
                                    <li>
                                        Brand:
                                        <strong>{{ $product->brand->brand ?? 'No Brand' }}</strong>
                                    </li>

                                    <li>
                                        Additional Charge:
                                        <strong>{{ $product->additional_charge ?? 0 }}</strong>
                                    </li>

                                    <li>
                                        Stock Status:
                                        <strong>{{ $product->quantity == 0 ? 'Out of stock' : 'In stock' }}</strong>
                                    </li>
                                </ul>
                                <hr class="divider mb-2 mt-0">

                                <div class="price-box">
                                    @if ($product->discount > 0)
                                        <span class="new-price"
                                            style="color: #ff0a0a;">৳{{ number_format($product->discount_price, 2) }}</span>
                                        <br>
                                        <br>
                                        <span class="old-price"
                                            style="font-weight: lighter;">৳{{ number_format($product->selling, 2) }}</span>
                                        <span
                                            style="vertical-align: middle;font-weight: lighter;">-{{ $product->discount }}%</span>
                                    @else
                                        <span class="new-price"
                                            style="color: #ff0a0a;">৳{{ number_format($product->selling, 2) }}</span>
                                    @endif
                                </div>
                                <!-- End .price-box -->

                                @if ($product->colors->count() > 0 || $product->sizes->count() > 0)
                                    <div class="product-filters-container">
                                        @if ($product->colors->count() > 0)
                                            <input type="hidden" class="selected_color">
                                            <div class="product-single-filter"><label class="font2">Color:</label>
                                                <ul class="config-size-list config-color-list config-filter-list">
                                                    @foreach ($product->colors as $color)
                                                        <li class="">
                                                            <a href="javascript:;" class="filter-color border-0"
                                                                style="background-color: {{ $color->color_code }}"
                                                                onclick="selected_color('{{ $color->color }}')"></a>
                                                        </li>
                                                    @endforeach
                                                </ul>
                                            </div>
                                        @endif

                                        @if ($product->sizes->count() > 0)
                                            <input type="hidden" class="selected_size">
                                            <div class="product-single-filter">
                                                <label class="font2">Size:</label>
                                                <ul class="config-size-list">
                                                    @foreach ($product->sizes as $size)
                                                        <li class=""><a href="javascript:;"
                                                                onclick="selected_size('{{ $size->size }}')"
                                                                class="d-flex align-items-center justify-content-center">{{ $size->size }}</a>
                                                        </li>
                                                    @endforeach
                                                </ul>
                                            </div>
                                        @endif

                                        <div class="product-single-filter">
                                            <label></label>
                                            <a class="font1 text-uppercase clear-btn" href="#">Clear</a>
                                        </div>
                                        <!---->
                                    </div>
                                @endif

                                <div class="product-action">

                                    <div class="product-single-qty">
                                        <input class="horizontal-quantity selected_quantity form-control" type="text">
                                    </div>
                                    <!-- End .product-single-qty -->

                                    <a href="javascript:;" onclick="add_to_cart({{ $product->id }})"
                                        class="btn btn-dark add-cart mr-2" title="Add to Cart">Add to
                                        Cart</a>

                                    <a href="{{ route('cart') }}" class="btn btn-gray view-cart d-none">View cart</a>
                                </div>
                                <!-- End .product-action -->

                                <hr class="divider mb-0 mt-0">

                                <div class="product-single-share mb-2">

                                    <a href="javascript:;" onclick="wishlist({{ $product->id }})"
                                        class="btn-icon-wish add-wishlist" title="Add to Wishlist"><i
                                            class="icon-wishlist-2"></i><span>Add to
                                            Wishlist</span></a>
                                </div>
                                <!-- End .product single-share -->
                            </div>
                            <!-- End .product-single-details -->
                        </div>
                        <!-- End .row -->
                    </div>
                    <hr class="divider mb-2 mt-0">
                    <!-- End .product-single-container -->
                    <div class="row justify-content-center m-b-5 visible991"
                        style="background-color: #f2f2f2;padding-top: 5rem;">
                        <div class="col-sm-6 col-xl-4">
                            <div class="feature-box feature-box-simple text-center">
                                <div class="feature-icon">
                                    <i class="fa fa-star"></i>
                                </div>

                                <div class="feature-box-content">
                                    <h3>Dedicated Service</h3>
                                    <p>Consult our specialists for help with an order, customization, or design advice</p>
                                </div>
                                <!-- End .feature-box-content -->
                            </div>
                            <!-- End .feature-box -->
                        </div>
                        <!-- End .col-md-4 -->

                        <div class="col-sm-6 col-xl-4">
                            <div class="feature-box feature-box-simple text-center">
                                <div class="feature-icon">
                                    <i class="fa fa-reply"></i>
                                </div>

                                <div class="feature-box-content">
                                    <h3>Free Returns</h3>
                                    <p>Consult our specialists for help with an order, customization, or design advice</p>
                                </div>
                                <!-- End .feature-box-content -->
                            </div>
                            <!-- End .feature-box -->
                        </div>
                        <!-- End .col-md-4 -->

                        <div class="col-sm-6 col-xl-4">
                            <div class="feature-box feature-box-simple text-center">
                                <div class="feature-icon">
                                    <i class="fa fa-paper-plane"></i>
                                </div>

                                <div class="feature-box-content">
                                    <h3>International Shipping</h3>
                                    <p>Consult our specialists for help with an order, customization, or design advice</p>
                                </div>
                                <!-- End .feature-box-content -->
                            </div>
                            <!-- End .feature-box -->
                        </div>
                        <!-- End .col-md-4 -->
                    </div>
                    <!-- End .row -->


                    <div class="product-single-tabs">

                        <div class="tab-content">
                            <div style="background-color: #f4f4f4;padding: 10px;">
                                <i>Product details of</i> <strong style="color:black;">{{ $product->name }}</strong>
                            </div>
                            <div class="tab-pane fade show active" id="product-desc-content" role="tabpanel"
                                aria-labelledby="product-tab-desc">

                                <div class="product-desc-content">
                                    {!! $product->details !!}
                                </div>
                                <!-- End .product-desc-content -->
                            </div>
                            <!-- End .tab-pane -->
                            @if ($product->sizes->count() > 0)
                                <div style="background-color: #f4f4f4;padding: 10px;">
                                    <i>Product size guide of</i> <strong
                                        style="color:black;">{{ $product->name }}</strong>
                                </div>
                                <div class="tab-pane fade show active" id="product-size-content" role="tabpanel"
                                    aria-labelledby="product-tab-size">
                                    <div class="product-size-content">
                                        <div class="row">
                                            <div class="col-md-4">
                                                <img src="{{ asset('images/body-shape.png') }}" alt="body shape">
                                            </div>
                                            <!-- End .col-md-4 -->

                                            <div class="col-md-8">
                                                <table class="table table-size">
                                                    <thead>
                                                        <tr>
                                                            <th>SIZE</th>
                                                            <th>CHEST (in.)</th>
                                                            <th>WAIST (in.)</th>
                                                            <th>HIPS (in.)</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <tr>
                                                            <td>XS</td>
                                                            <td>34-36</td>
                                                            <td>27-29</td>
                                                            <td>34.5-36.5</td>
                                                        </tr>
                                                        <tr>
                                                            <td>S</td>
                                                            <td>36-38</td>
                                                            <td>29-31</td>
                                                            <td>36.5-38.5</td>
                                                        </tr>
                                                        <tr>
                                                            <td>M</td>
                                                            <td>38-40</td>
                                                            <td>31-33</td>
                                                            <td>38.5-40.5</td>
                                                        </tr>
                                                        <tr>
                                                            <td>L</td>
                                                            <td>40-42</td>
                                                            <td>33-36</td>
                                                            <td>40.5-43.5</td>
                                                        </tr>
                                                        <tr>
                                                            <td>XL</td>
                                                            <td>42-45</td>
                                                            <td>36-40</td>
                                                            <td>43.5-47.5</td>
                                                        </tr>
                                                        <tr>
                                                            <td>XLL</td>
                                                            <td>45-48</td>
                                                            <td>40-44</td>
                                                            <td>47.5-51.5</td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                        <!-- End .row -->
                                    </div>
                                    <!-- End .product-size-content -->
                                </div>
                                <!-- End .tab-pane -->
                            @endif

                            @if ($product->specification != null)
                                <div style="background-color: #f4f4f4;padding: 10px;">
                                    <i>Product specification of</i> <strong
                                        style="color:black;">{{ $product->name }}</strong>
                                </div>
                                <div class="tab-pane fade show active" id="product-tags-content" role="tabpanel"
                                    aria-labelledby="product-tab-tags">
                                    {!! $product->specification !!}
                                </div>
                                <!-- End .tab-pane -->
                            @endif

                            <div style="background-color: #f4f4f4;padding: 10px;">
                                <i>Product ratings&reviews of</i> <strong
                                    style="color:black;">{{ $product->name }}</strong>
                            </div>
                            <div class="tab-pane fade show active" id="product-reviews-content" role="tabpanel"
                                aria-labelledby="product-tab-reviews">
                                <div class="product-reviews-content">
                                    <h3 class="reviews-title">{{ $product->ratingReviews->where('status', 1)->count() }}
                                        review for
                                        {{ $product->name }}</h3>

                                    <div class="comment-list">
                                        @foreach ($product->ratingReviews as $rating)
                                            @if ($rating->status === 1)
                                                <div class="comments">
                                                    <figure class="img-thumbnail">
                                                        <img src="{{ asset('images/download.png') }}" alt="author"
                                                            width="80" height="80">
                                                    </figure>

                                                    <div class="comment-block">
                                                        <div class="comment-header">
                                                            <div class="comment-arrow"></div>

                                                            <div class="ratings-container float-sm-right">
                                                                <div class="product-ratings">
                                                                    <span class="ratings"
                                                                        style="width:{{ $rating->rating * 20 }}%"></span>
                                                                    <!-- End .ratings -->
                                                                    <span class="tooltiptext tooltip-top"></span>
                                                                </div>
                                                                <!-- End .product-ratings -->
                                                            </div>

                                                            <span class="comment-by">
                                                                <strong>{{ $rating->user->name }}</strong>
                                                                – {{ $rating->created_at->format('F d, Y') }}
                                                            </span>
                                                        </div>

                                                        <div class="comment-content">
                                                            <p>{{ $rating->review }}</p>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endif
                                        @endforeach
                                    </div>

                                    @auth

                                        @if (DB::table('rating_reviews')->where('user_id', auth()->user()->id)->where('product_id', $product->id)->exists())
                                        @else
                                            <div class="divider"></div>
                                            <div class="add-product-review">
                                                <h3 class="review-title">Add a review</h3>
                                                <form action="{{ route('storeRatingReview') }}" method="post"
                                                    class="comment-form m-0">
                                                    @csrf
                                                    <div class="rating-form">
                                                        <label for="rating">
                                                            Your rating
                                                            <span class="required">*</span>
                                                        </label>
                                                        <span class="rating-stars">
                                                            <a class="star-1" href="#">1</a>
                                                            <a class="star-2" href="#">2</a>
                                                            <a class="star-3" href="#">3</a>
                                                            <a class="star-4" href="#">4</a>
                                                            <a class="star-5" href="#">5</a>
                                                        </span>
                                                        <select name="rating" id="rating" required="" style="display: none;">
                                                            <option value="">Rate…</option>
                                                            <option value="5">Perfect</option>
                                                            <option value="4">Good</option>
                                                            <option value="3">Average</option>
                                                            <option value="2">Not that bad</option>
                                                            <option value="1">Very poor</option>
                                                        </select>
                                                    </div>
                                                    <div class="form-group">
                                                        <label>
                                                            Your review
                                                            <span class="required">*</span>
                                                        </label>
                                                        <textarea cols="5" rows="6" class="form-control form-control-sm" name="review"></textarea>
                                                    </div>
                                                    <!-- End .form-group -->
                                                    <div class="row">
                                                        <div class="col-md-12 col-xl-12">
                                                            <div class="form-group">
                                                                <label>
                                                                    Name
                                                                    <span class="required">*</span>
                                                                </label>
                                                                <input type="text" class="form-control form-control-sm"
                                                                    readonly value="{{ auth()->user()->name }}">
                                                            </div>
                                                            <!-- End .form-group -->
                                                        </div>
                                                    </div>
                                                    <input type="hidden" name="product_id" value="{{ $product->id }}">
                                                    <input type="submit" class="btn btn-primary" value="Submit">
                                                </form>
                                            </div>
                                        @endif
                                    @else
                                        <a href="{{ route('login') }}">Login</a> to review.
                                    @endauth
                                </div>
                                <!-- End .product-reviews-content -->
                            </div>
                            <!-- End .tab-pane -->
                        </div>
                        <!-- End .tab-content -->
                    </div>
                    <!-- End .product-single-tabs -->
                    <!-- End .product-single-tabs -->
                </div>
                <!-- End .col-lg-9 -->

                <aside class="sidebar-product col-lg-3 mobile-sidebar" style="background-color: #fafafa;">
                    <div class="sidebar-wrapper">
                        <div class="widget widget-info">
                            <ul>
                                <li>
                                    <i class="icon-shipped"></i>
                                    <h4>FREE<br />SHIPPING</h4>
                                </li>
                                <li>
                                    <i class="icon-us-dollar"></i>
                                    <h4>100% MONEY<br />BACK GUARANTEE</h4>
                                </li>
                                <li>
                                    <i class="icon-online-support"></i>
                                    <h4>ONLINE<br />SUPPORT 24/7</h4>
                                </li>
                            </ul>
                        </div>

                        <!--<div class="widget">
                                                                                                                        <div class="maga-sale-container custom-maga-sale-container">
                                                                                                                            <figure class="mega-image">
                                                                                                                                <img src="assets/images/banners/banner-sidebar-bg.jpg" class="w-100"
                                                                                                                                    alt="Banner Desc">
                                                                                                                            </figure>

                                                                                                                            <div class="mega-content">
                                                                                                                                <div class="mega-price-box">
                                                                                                                                    <span class="price-big">50</span>
                                                                                                                                    <span class="price-desc"><em>%</em>OFF</span>
                                                                                                                                </div>

                                                                                                                                <div class="mega-desc">
                                                                                                                                    <h3 class="mega-title mb-0">MEGA SALE</h3>
                                                                                                                                    <span class="mega-subtitle">MANY ITEM</span>
                                                                                                                                </div>
                                                                                                                            </div>
                                                                                                                        </div>
                                                                                                                    </div>
                                                                                                                     End .widget -->

                        <div class="widget widget-featured">
                            <h3 class="widget-title">FEATURED PRODUCT</h3>

                            <div class="widget-body">
                                @foreach ($partial_product as $partial)
                                    <div class="product-default">
                                        <figure>
                                            <a href="{{ route('productDetails', $partial->slug) }}"
                                                style="height: 100%;width: 100%;">
                                                <img src="{{ asset($partial->images->first()->image) }}"
                                                    class="product-image" alt="product">
                                            </a>
                                            @if ($partial->discount > 0)
                                                <div class="label-group">
                                                    <div class="product-label label-sale">-{{ $partial->discount }}%
                                                    </div>
                                                </div>
                                            @endif
                                        </figure>
                                        <div class="product-details">
                                            <div class="category-wrap">
                                                <h3 class="product-title">
                                                    <a
                                                        href="{{ route('productDetails', $partial->slug) }}">{{ $partial->name }}</a>
                                                </h3>
                                                @if ($partial->discount > 0)
                                                    <h3 style="font-weight: 400;color: #ff0000;margin: 0;">
                                                        ৳{{ number_format($partial->discount_price, 2) }}</h3>
                                                    <h6
                                                        style="color: #a7a9a7;font-weight: inherit; margin: 0;height: 20px;">
                                                        <del>৳{{ number_format($partial->selling, 2) }}</del>
                                                        -{{ $partial->discount }}%
                                                    </h6>
                                                @else
                                                    <h3 style="font-weight: 400;color: #ff0000;margin: 0;">
                                                        ৳{{ number_format($partial->selling, 2) }}</h3>
                                                @endif
                                                <!-- End .price-box -->
                                                <div class="ratings-container">
                                                    <div class="product-ratings">
                                                        <span class="ratings"
                                                            style="width:{{ DB::table('rating_reviews')->where('product_id', $partial->id)->select('rating')->where('status', 1)->avg('rating') *20 ??0 }}%"></span>
                                                        <!-- End .ratings -->
                                                        <span class="tooltiptext tooltip-top"></span>
                                                        ({{ $partial->ratingReviews->where('status', 1)->count() }})
                                                    </div>
                                                    <!-- End .product-ratings -->
                                                </div>
                                                <!-- End .product-container -->
                                            </div>
                                        </div>
                                        <!-- End .product-details -->
                                    </div>
                                @endforeach
                            </div>
                            <!-- End .widget-body -->
                        </div>
                        <!-- End .widget -->
                    </div>
                </aside>
                <!-- End .col-md-3 -->
            </div>
            <!-- End .row -->

            <div class="products-section pt-0 mt-5">
                <h2 class="section-title">Related Products</h2>

                <div class="">
                    <div class="row products-group">
                        @foreach ($related_product as $related)
                            <div class="col-6 col-sm-4 col-md-3 col-lg-2">
                                <div class="product-default">
                                    <figure>
                                        <a href="{{ route('productDetails', $related->slug) }}"
                                            style="height: 100%;width: 100%;">
                                            <img src="{{ asset($related->images->first()->image) }}"
                                                class="product-image" alt="product">
                                        </a>
                                        @if ($related->discount > 0)
                                            <div class="label-group">
                                                <div class="product-label label-sale">-{{ $related->discount }}%</div>
                                            </div>
                                        @endif
                                    </figure>
                                    <div class="product-details">
                                        <div class="category-wrap">
                                            <h3 class="product-title">
                                                <a
                                                    href="{{ route('productDetails', $related->slug) }}">{{ $related->name }}</a>
                                            </h3>
                                            @if ($related->discount > 0)
                                                <h3 style="font-weight: 400;color: #ff0000;margin: 0;">
                                                    ৳{{ number_format($related->discount_price, 2) }}</h3>
                                                <h6 style="color: #a7a9a7;font-weight: inherit; margin: 0;height: 20px;">
                                                    <del>৳{{ number_format($related->selling, 2) }}</del>
                                                    -{{ $related->discount }}%
                                                </h6>
                                            @else
                                                <h3 style="font-weight: 400;color: #ff0000;margin: 0;">
                                                    ৳{{ number_format($related->selling, 2) }}</h3>
                                            @endif
                                            <!-- End .price-box -->
                                            <div class="product-ratings">
                                                <span class="ratings"
                                                    style="width:{{ DB::table('rating_reviews')->where('product_id', $related->id)->select('rating')->where('status', 1)->avg('rating') *20 ??0 }}%"></span>
                                                <!-- End .ratings -->
                                                <span class="tooltiptext tooltip-top"></span>
                                                ({{ $related->ratingReviews->where('status', 1)->count() }})
                                            </div>
                                            <!-- End .product-container -->
                                        </div>
                                    </div>
                                    <!-- End .product-details -->
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
                <!-- End .products-slider -->
            </div>
            <!-- End .products-section -->
        </div>
        <!-- End .container -->
    </main>
@endsection

@section('js')
    <script>
        var color;
        var size;

        function selected_color(color) {
            $('.selected_color').val(color);
        }

        function selected_size(size) {
            $('.selected_size').val(size);
        }

        function add_to_cart(product_id) {

            var color = $('.selected_color').val();
            var size = $('.selected_size').val();


            $(document).ready(function(e) {
                const Toast = Swal.mixin({
                    toast: true,
                    position: 'top-end',
                    showConfirmButton: false,
                    timer: 3000,
                    timerProgressBar: true,
                    didOpen: (toast) => {
                        toast.addEventListener('mouseenter', Swal.stopTimer)
                        toast.addEventListener('mouseleave', Swal.resumeTimer)
                    }
                })


                if (color == '') {
                    Toast.fire({
                        icon: 'error',
                        title: 'Select a color'
                    })
                    return;
                }
                if (size == '') {
                    Toast.fire({
                        icon: 'error',
                        title: 'Select a size'
                    })
                    return;
                }

                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });

                var quantity = $('.selected_quantity').val();

                $.ajax({
                    method: 'POST',

                    url: "{{ asset('/') }}add-to-cart",
                    data: {
                        id: product_id,
                        quantity: quantity,
                        color: color,
                        size: size
                    },
                    cache: false,
                    success: function(response) {
                        //  window.location.reload();
                        if (response.status === 'success') {




                            Toast.fire({
                                icon: 'success',
                                title: 'Product added to cart successfully'
                            })


                            $('.total_cart_items').html(response.cart_count);

                            // // $('.test').html('This is for test');
                            // $('.productImage_ajax').attr("src", response.productImage);
                            // $('.productTotalPrice_ajax').html(response.productTotalPrice);
                            // $('.total_price_ajax').html(response.total);

                        }

                    },
                    async: false,
                    error: function(error) {

                    }
                })
            })

        }

        function wishlist(product_id) {


            $(document).ready(function(e) {


                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });

                $.ajax({
                    method: 'POST',

                    url: "{{ asset('/') }}add-to-wishlist",
                    data: {
                        id: product_id,
                    },
                    cache: false,
                    success: function(response) {
                        //  window.location.reload();
                        if (response.status == 1) {


                            const Toast = Swal.mixin({
                                toast: true,
                                position: 'top-end',
                                showConfirmButton: false,
                                timer: 3000,
                                timerProgressBar: true,
                                didOpen: (toast) => {
                                    toast.addEventListener('mouseenter', Swal.stopTimer)
                                    toast.addEventListener('mouseleave', Swal.resumeTimer)
                                }
                            })

                            Toast.fire({
                                icon: 'error',
                                title: 'Product already added to wishlist!!'
                            })


                        } else if (response.status == 2) {
                            const Toast = Swal.mixin({
                                toast: true,
                                position: 'top-end',
                                showConfirmButton: false,
                                timer: 3000,
                                timerProgressBar: true,
                                didOpen: (toast) => {
                                    toast.addEventListener('mouseenter', Swal.stopTimer)
                                    toast.addEventListener('mouseleave', Swal.resumeTimer)
                                }
                            })

                            Toast.fire({
                                icon: 'success',
                                title: 'Product added to wishlist!!'
                            })
                            $('.total_wishlist_items').html(response.wishlist_count);
                        } else if (response.status == 3) {
                            const Toast = Swal.mixin({
                                toast: true,
                                position: 'top-end',
                                showConfirmButton: false,
                                timer: 3000,
                                timerProgressBar: true,
                                didOpen: (toast) => {
                                    toast.addEventListener('mouseenter', Swal.stopTimer)
                                    toast.addEventListener('mouseleave', Swal.resumeTimer)
                                }
                            })

                            Toast.fire({
                                icon: 'error',
                                title: 'Please login first!!'
                            })
                        }

                    },
                    async: false,
                    error: function(error) {

                    }
                })
            })

        }
    </script>
@endsection
