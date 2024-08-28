@extends('frontend.layouts.master')
@section('title', 'Product Collection')
@section('css')
@endsection

@section('content')
    <main class="main">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 mb-1">
                    <nav class="toolbox sticky-header mt-2" data-sticky-options="{'mobile': true}"
                        style="border-bottom: 1px solid;">
                        <div class="toolbox-left">
                            <p>{{ $products->count() }} products found</p>
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
