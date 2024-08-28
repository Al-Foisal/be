@extends('frontend.layouts.master')
@section('title', $page->title)
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
    <main class="main about">

        <nav aria-label="breadcrumb" class="breadcrumb-nav">
            <div class="container">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('home') }}"><i class="icon-home"></i></a></li>
                    <li class="breadcrumb-item active" aria-current="page">{{ $page->title }}</li>
                </ol>
            </div><!-- End .container -->
        </nav>

        <div class="about-section">
            <div class="container">
                <h2 class="subtitle">{{ $page->title }}</h2>
                {!! $page->details !!}
            </div><!-- End .container -->
        </div><!-- End .about-section -->
    </main>
@endsection
