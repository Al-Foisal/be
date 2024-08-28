@extends('frontend.layouts.master')
@section('title', 'Product Mall')
@section('css')
@endsection

@section('content')
    <main class="main">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 mb-1 mt-5">

                    <div class="row products-group">
                        @foreach ($malls as $mall)
                            <div class="product-default mr-2">
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
                    </div>
                    <!-- End .row -->
                    <nav class="toolbox toolbox-pagination">
                        <div class="toolbox-item toolbox-show mb-0"></div>
                        <!-- End .toolbox-item -->
                        <ul class="pagination toolbox-item mb-0">
                            {{ $malls->links() }}
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
