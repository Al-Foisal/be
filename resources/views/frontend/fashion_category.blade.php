@extends('frontend.layouts.master')
@section('title', 'All Fashion Categories')
@section('css')

@endsection
@section('content')
    <style>
        .product-default figure>a:first-child {
            width: 100%;
        }
        
        body{
            background-color:whitesmoke;
        }

    </style>
    <link rel="stylesheet" href="{{ asset('frontend/css/style.min.css') }}">

    
    @foreach($fashion->subcategories as $fs)
        <main class="main mb-5">
            <div class="container">
                <div class="d-flex justify-content-between" style="padding: 15px 0;">
                    <h4 style="margin-bottom: 0;border-bottom: 5px solid red;">{{ $fs->name }}</h4>
                </div>
            </div>
            <div class="container pt-2" style="">
                <div class="row ">
                    <!-- product 1 -->
                    
                    @foreach($fs->childcategories as $child)
                        <div class="col-lg-2 col-4 vv">
                        <div class="product-default inner-icon" style="padding-top: 20px;">
                            <figure style="margin: 0;text-align:center;">
                                <a href="{{ route('categoryProduct', [$fs->category->slug, $fs->slug, $child->slug]) }}">
                                    <img src="{{ asset($child->image) }}" alt="Category" style="height: 80px;width: 80px;margin:auto;">
                                    {{ $child->name }}
                                </a>
                            </figure>
                        </div>
                        <!-- End .product-default -->
                    </div>
                    @endforeach
                </div>
            </div>
        </main>
    @endforeach
@endsection

@section('js')

    <script src="{{ asset('frontend/js/nouislider.min.js') }}"></script>
@endsection
