@extends('frontend.layouts.master')
@section('title', 'All Categories')
@section('css')

@endsection
@section('content')
    <style>
        .product-default figure>a:first-child {
            width: 100%;
        }

    </style>
    <link rel="stylesheet" href="{{ asset('frontend/css/style.min.css') }}">
    <main class="main mb-5 bg-white">
        <div class="container">
            <section class="vertical-section">
                <h3>Categories</h3>
                <div class="row">
                    <div class="col-md-12">
                        <section class="vertical-section">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="tabs tabs-vertical tabs-secondary tabs-left mb-5">
                                        <ul class="nav nav-tabs" role="tablist">
                                            @foreach ($categories as $key => $cat)
                                                <li class="nav-item">
                                                    <a class="nav-link @if ($key === 0) {{ 'active' }}" @endif id="
                                                        tab-popular{{ $key }}" data-toggle="tab"
                                                        href="#popular-content{{ $key }}" role="tab"
                                                        aria-controls="popular-content{{ $key }}"
                                                        aria-selected="true">
                                                        <img src="{{ asset($cat->image) }}" alt="{{ $cat->name }}">
                                                        {{ $cat->name }}
                                                    </a>
                                                </li>
                                            @endforeach
                                        </ul>
                                        <div class="tab-content">
                                            @foreach ($categories as $c_key => $category)
                                                <div class="tab-pane fade @if ($c_key === 0) {{ 'show active' }} @endif"
                                                    id="popular-content{{ $c_key }}" role="tabpanel"
                                                    aria-labelledby="tab-popular{{ $c_key }}">

                                                    <div class="" id="accordion{{ $c_key }}">
                                                        @foreach ($category->subcategories as $s_key => $sub)
                                                            {{-- <h3>Default</h3> --}}
                                                            <div class="card card-accordion p-3" style="box-shadow: rgba(149, 157, 165, 0.2) 0px 8px 24px;border-radius:5px;">
                                                                <div class="d-flex justify-content-between" >
                                                                    <a href="{{ route('categoryProduct', [$category->slug, $sub->slug]) }}"
                                                                        style="text-decoration: none;color:black;font-weight:bold;">
                                                                    {{ $sub->name }}
                                                                    
                                                                    </a>
                                                                    <a class="card-header @if ($s_key !== 0) {{ 'collapsed' }} @endif"
                                                                        href="#" data-toggle="collapse"
                                                                        data-target="#collapse{{ $s_key }}"
                                                                        aria-expanded="true"
                                                                        aria-controls="collapse{{ $s_key }}">

                                                                    </a>
                                                                </div>

                                                                <div id="collapse{{ $s_key }}"
                                                                    class="collapse @if ($s_key === 0) {{ 'show' }} @endif"
                                                                    data-parent="#accordion{{ $c_key }}">
                                                                    <div class="d-flex justify-content-start">
                                                                        @foreach ($sub->childcategories as $child)
                                                                            <a href="{{ route('categoryProduct', [$category->slug, $sub->slug, $child->slug]) }}"
                                                                                class="mr-3">
                                                                                <img src="{{ asset($child->image) }}"
                                                                                    alt="">
                                                                                {{ $child->name }}
                                                                            </a>
                                                                        @endforeach
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        @endforeach
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </section>
                    </div>
                </div>
            </section>
        </div>
        {{-- <div class="container pt-2" style="background-color: #ffffff;">
            <div class="row divide-line">
                <!-- product 1 -->
                @foreach ($categories as $category)
                    <div class="col-lg-2 col-4 vv">
                        <div class="product-default inner-icon" style="padding-top: 20px;">
                            <figure style="margin: 0;">
                                <a href="{{ route('categoryProduct', $category->slug) }}">
                                    <img src="{{ asset($category->image) }}" alt="Category"
                                        style="height: 80px;width: 80px;;">
                                    {{ $category->name }}
                                </a>
                            </figure>
                        </div>
                        <!-- End .product-default -->
                    </div>
                    @if ($category->subcategories->count() > 0)
                        @foreach ($category->subcategories->where('status', 1) as $sub)
                            <div class="col-lg-2 col-4 vv">
                                <div class="product-default inner-icon" style="padding-top: 20px;">
                                    <figure style="margin: 0;">
                                        <a href="{{ route('categoryProduct', [$category->slug, $sub->slug]) }}">
                                            <img src="{{ asset($sub->image) }}" alt="sub"
                                                style="height: 80px;width: 80px;;">
                                            {{ \Illuminate\Support\Str::limit($sub->name, 10, $end = '...') }}
                                        </a>
                                    </figure>
                                </div>
                                <!-- End .product-default -->
                            </div>
                            @if ($sub->childcategories->count() > 0)
                                <br>
                                @foreach ($sub->childcategories->where('status', 1) as $child)
                                    <div class="col-lg-2 col-4 vv">
                                        <div class="product-default inner-icon" style="padding-top: 20px;">
                                            <figure style="margin: 0;">
                                                <a
                                                    href="{{ route('categoryProduct', [$category->slug, $sub->slug, $child->slug]) }}">
                                                    <img src="{{ asset($child->image) }}" alt="child"
                                                        style="height: 80px;width: 80px;;">
                                                    {{ $child->name }}
                                                </a>
                                            </figure>
                                        </div>
                                        <!-- End .product-default -->
                                    </div>
                                @endforeach
                            @endif
                        @endforeach
                    @endif
                @endforeach
            </div>
        </div> --}}
    </main>
@endsection

@section('js')

    <script src="{{ asset('frontend/js/nouislider.min.js') }}"></script>
@endsection
