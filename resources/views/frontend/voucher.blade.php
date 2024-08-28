@extends('frontend.layouts.master')
@section('title', 'Voucher')
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
        .product-row img {
            max-width: 100%;
        }

        @import url('https://fonts.googleapis.com/css?family=Oswald');

        * {
            margin: 0;
            padding: 0;
            border: 0;
            box-sizing: border-box
        }


        .fl-left {
            float: left
        }

        .fl-right {
            float: right
        }

        h1 {
            text-transform: uppercase;
            font-weight: 900;
            border-left: 10px solid black;
            padding-left: 10px;
            margin-bottom: 30px;
            color: #ffffff;
        }

        .row {
            overflow: hidden
        }

        .card {
            display: table-row;
            width: 47%;
            background-color: #fff;
            color: red;
            margin-bottom: 10px;
            font-family: 'Oswald', sans-serif;
            text-transform: uppercase;
            border-radius: 4px;
            position: relative
        }

        .card+.card {
            /* margin-right: 2% */
        }

        .date {
            display: table-cell;
            width: 30%;
            position: relative;
            text-align: center;
            border-right: 2px dashed #dadde6
        }

        .date:before,
        .date:after {
            content: "";
            display: block;
            width: 30px;
            height: 30px;
            background-color: #ff3399;
            position: absolute;
            top: -15px;
            right: -15px;
            z-index: 1;
            border-radius: 50%
        }

        .date:after {
            top: auto;
            bottom: -15px
        }

        .date time {
            display: block;
            position: absolute;
            top: 50%;
            left: 50%;
            -webkit-transform: translate(-50%, -50%);
            -ms-transform: translate(-50%, -50%);
            transform: translate(-50%, -50%)
        }

        .date time span {
            display: block
        }

        .date time span:first-child {
            color: #2b2b2b;
            font-weight: 600;
            font-size: 250%
        }

        .date time span:last-child {
            text-transform: uppercase;
            font-weight: 600;
            margin-top: -10px
        }

        .card-cont {
            display: table-cell;
            width: 70%;
            font-size: 85%;
            padding: 10px 10px 30px 50px
        }

        .card-cont h3 {
            color: red;
            font-size: 130%
        }


        .card-cont>div {
            display: table-row
        }

        .card-cont .even-date i,
        .card-cont .even-info i,
        .card-cont .even-date time,
        .card-cont .even-info p {
            display: table-cell
        }

        .card-cont .even-date i,
        .card-cont .even-info i {
            padding: 5% 5% 0 0
        }

        .card-cont .even-info p {
            padding: 30px 50px 0 0
        }

        .card-cont .even-date time span {
            display: block
        }

        .collect-button {
            box-sizing: border-box;
            display: flex;
            flex-direction: column;
            flex-shrink: 0;
            place-content: flex-start center;
            border-width: 0vw;
            border-style: solid;
            border-color: black;
            margin: 0vw;
            padding: 0vw 10px;
            min-width: 102px;
            height: 60px;
            align-items: center;
            background-image: linear-gradient(130deg, rgb(255, 147, 63), rgb(249, 55, 130));
            width: 164px;
            right: 23px;
            top: 71px;
            border-radius: 30px;
            font-family: NotoSans-SemiBold;
            color: white;
            font-size: x-large;
        }


        @media screen and (max-width: 860px) {
            .card {
                display: block;
                float: none;
                width: 100%;
                margin-bottom: 10px
            }

            .card+.card {
                margin-left: 0
            }

            .card-cont .even-date,
            .card-cont .even-info {
                font-size: 75%
            }
        }

        body {
            background-color: #ff3399;
            color: #ffffff;
        }

    </style>
@endsection
@section('content')
    <main class="main mb-5">
        <section class="container mt-5">
            <h1>Voutcher</h1>
            <div class="row">
                @foreach ($vouchers as $voucher)
                    <article class="card fl-left mt-2 mb-2 mr-5">
                        <section class="date">
                            <time datetime="23th feb">
                                <img src="{{ asset($voucher->image) }}" alt="" srcset="">
                            </time>
                        </section>
                        <section class="card-cont">
                            <h2 class="">
                                <span style="font-weight: lighter;color: red;">BDT</span>
                                <strong style="color: red;">
                                    {{ $voucher->offer_amount }}
                                </strong>
                            </h2>
                            <h3 class="">
                                <span style="font-weight: lighter;">Min. Spend BDT</span>
                                <strong>
                                    {{ $voucher->min_amount }}
                                </strong>
                            </h3>
                            <div class="even-date">
                                <time>
                                    <h5 style="font-weight: lighter;letter-spacing: 1.2px;">Store wide Validity:
                                        {{ $voucher->validity_from }}-{{ $voucher->validity_to }}</span>
                                    </h5>
                            </div>
                            <a href="javascript:;" class="collect-button mt-2"
                                onclick="voucher('{{ $voucher->id }}')">Collect</a>
                        </section>
                    </article>
                @endforeach
            </div>
        </section>
    </main>
@endsection
@section('js')
    <script>
        function voucher(value) {

            // var ship = $('.shipping').val();
            // var ship =  $('input[name="shipping"]:checked').val();
            // alert(value)
            $(document).ready(function(e) {


                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });

                $.ajax({
                    method: 'POST',

                    url: "{{ asset('/') }}add-voucher",
                    data: {
                        id: value,
                    },
                    cache: false,
                    success: function(response) {
                        //  window.location.reload();
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
                        });

                        if (response.status == 2) {

                            Toast.fire({
                                icon: 'success',
                                title: 'The Voucher Applied!'
                            })
                        }


                        // $('.total_with_shipping_charge').html(response.total);
                        // $('.total_with_shipping_charge').val(response.total);

                        // // $('.test').html('This is for test');
                        // $('.productImage_ajax').attr("src", response.productImage);
                        // $('.productTotalPrice_ajax').html(response.productTotalPrice);
                        // $('.total_price_ajax').html(response.total);


                    },
                    async: false,
                    error: function(error) {

                    }
                })
            })

        }
    </script>
@endsection
