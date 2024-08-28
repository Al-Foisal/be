@extends('frontend.layouts.master')
@section('title', 'Checkout')
@section('css')
    
@endsection
@section('content')
<link rel="stylesheet" href="{{ asset('frontend/css/style.min.css') }}">

    <main class="main main-test">
        <div class="container checkout-container">
            <ul class="checkout-progress-bar d-flex justify-content-center flex-wrap">
                <li class="disabled">
                    <a href="#">Checkout</a>
                </li>
            </ul>
            <form action="{{ route('placeOrder') }}" method="post" id="checkout-form">
                @csrf
                <div class="row">
                    <div class="col-lg-7">
                        <ul class="checkout-steps">
                            <li>
                                <h2 class="step-title">Billing details</h2>

                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>
                                                Full name
                                                <abbr class="required" title="required">*</abbr>
                                            </label>
                                            <input type="text" class="form-control" name="name"
                                                value="{{ auth()->user()->name }}" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label>Phone<abbr class="required" title="required">*</abbr></label>
                                    <input type="text" name="phone" value="{{ $user_address->phone ?? '' }}"
                                        class="form-control" required>
                                </div>
                                <div class="form-group mb-1 pb-2">
                                    <label>
                                        Email</abbr>
                                    </label>
                                    <input type="text" class="form-control" name="email"
                                        value="{{ auth()->user()->email }}" readonly>
                                </div>
                                <div class="form-group">
                                    <label>City
                                        <abbr class="required" title="required">*</abbr>
                                    </label>
                                    <input type="text" name="city" value="{{ $user_address->city ?? '' }}"
                                        class="form-control" required>
                                </div>
                                <div class="form-group">
                                    <label>Area
                                        <abbr class="required" title="required">*</abbr>
                                    </label>
                                    <input type="text" name="area" value="{{ $user_address->area ?? '' }}"
                                        class="form-control" required>
                                </div>
                                <div class="form-group">
                                    <label>Zip Code
                                    </label>
                                    <input type="text" name="zip_code" value="{{ $user_address->zip_code ?? '' }}"
                                        class="form-control">
                                </div>
                                <div class="form-group">
                                    <label class="order-comments">Address<abbr class="required"
                                            title="required">*</abbr></label>
                                    <textarea class="form-control" name="address" required>{{ $user_address->address ?? '' }}</textarea>
                                </div>

                            </li>
                        </ul>
                    </div>
                    <!-- End .col-lg-8 -->
                    <div class="col-lg-5">
                        <div class="order-summary">
                            <h3>YOUR ORDER</h3>
                            <table class="table table-mini-cart">
                                <thead>
                                    <tr>
                                        <th colspan="2">Product</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($carts as $cart)
                                        <tr>
                                            <td class="product-col">
                                                <h3 class="product-title">
                                                    {{ $cart->name }} ×
                                                    <span class="product-qty">{{ $cart->qty }}</span>
                                                </h3>
                                            </td>
                                            <td class="price-col">
                                                <span>৳{{ number_format($cart->qty * $cart->price, 2) }}</span>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                                <tfoot>
                                    <input type="hidden" name="coupon_discount"
                                        value="{{ Session::get('coupon')['discount'] ?? 0 }}">
                                    <input type="hidden" name="coupon_code"
                                        value="{{ Session::get('coupon')['code'] ?? 'none' }}">
                                    <input type="hidden" name="additional_charge" value="{{ $additional_charge }}">
                                    <input type="hidden" name="total_price" value="{{ $total }}">
                                    <input type="hidden" name="subtotal_price" value="{{ $subtotal }}">
                                    <input type="hidden" name="discount_price" value="{{ $discount ?? 0 }}">


                                    <tr class="cart-subtotal">
                                        <td>Total</td>
                                        <td class="price-col">৳{{ number_format($total, 2) }}</td>
                                    </tr>
                                    <tr class="cart-subtotal">
                                        <td>Subtotal</td>
                                        <td class="price-col">৳{{ number_format($subtotal, 2) }}</td>
                                    </tr>
                                    <tr class="cart-subtotal">
                                        <td>Discount</td>
                                        <td class="price-col">৳{{ number_format($discount, 2) }}</td>
                                    </tr>
                                    <tr class="cart-subtotal">
                                        <td>Additional Charge</td>
                                        <td class="price-col">৳{{ number_format($additional_charge, 2) }}</td>
                                    </tr>
                                    @if (session()->has('coupon'))
                                        <tr class="cart-subtotal">
                                            <td>Coupon<a title="remove this coupon" href="{{ route('removeCoupon') }}"
                                                    class="text-danger">X</a></td>
                                            <td class="price-col">
                                                ৳{{ number_format(Session::get('coupon')['discount'], 2) }}</td>
                                        </tr>
                                    @endif
                                    <tr class="order-shipping">
                                        <td class="text-left" colspan="2">
                                            <h4 class="m-b-sm">Shipping Charge</h4>
                                            <div class="form-group form-group-custom-control">
                                                <div class="custom-control custom-radio d-flex">
                                                    <input type="radio" name="shipping"
                                                        class="custom-control-input shipping"
                                                        onclick="shipping_charge({{ $ship->inside }})"
                                                        value="{{ $ship->inside }}" >
                                                    <label class="custom-control-label">Inside Dhaka - {{ $ship->inside }}</label>
                                                </div>
                                                <!-- End .custom-checkbox -->
                                            </div>
                                            <!-- End .form-group -->
                                            <div class="form-group form-group-custom-control mb-0">
                                                <div class="custom-control custom-radio d-flex mb-0">
                                                    <input type="radio" name="shipping"
                                                        class="custom-control-input shipping"
                                                        onclick="shipping_charge({{ $ship->outside }})"
                                                        value="{{ $ship->outside }}" >
                                                    <label class="custom-control-label">Outside Dhaka - {{ $ship->outside }}</label>
                                                </div>
                                                <!-- End .custom-checkbox -->
                                            </div>
                                            <!-- End .form-group -->
                                        </td>
                                    </tr>
                                    <tr class="order-total">
                                        <td>
                                            <h4>Total</h4>
                                        </td>
                                        <td>
                                            <b class="total-price">
                                                ৳<span
                                                    class="total_with_shipping_charge">{{ $paid_amount }}</span>
                                                <input type="hidden" name="paid_amount" class="total_with_shipping_charge"
                                                    value="{{ $paid_amount }}">
                                            </b>
                                        </td>
                                    </tr>
                                </tfoot>
                            </table>
                            <div class="payment-methods">
                                <h4 class="">Payment methods</h4>
                                <div class="btn-group btn-group-toggle" data-toggle="buttons">
                                    <label class="btn btn-secondary" onclick="cash()">
                                        <input type="radio" name="payment_type" id="option1" value="COD">
                                        <div>
                                            <img src="{{ asset('images/pay_icon/cashondelivery.png') }}">
                                        </div>
                                        COD
                                    </label>
                                    <label class="btn btn-secondary mx-2" onclick="bkash()">
                                        <input type="radio" name="payment_type" id="option2" value="Bkash">
                                        <div>
                                            <img src="{{ asset('images/pay_icon/bkash.png') }}">
                                        </div>
                                        Bkash
                                    </label>
                                    <label class="btn btn-secondary mx-2" onclick="rocket()">
                                        <input type="radio" name="payment_type" id="option2" value="Rocket">
                                        <div>
                                            <img src="{{ asset('images/pay_icon/rocket.png') }}">
                                        </div>
                                        Rocket
                                    </label>
                                    <label class="btn btn-secondary" onclick="nagad()">
                                        <input type="radio" name="payment_type" id="option3" value="Nagad">
                                        <div>
                                            <img src="{{ asset('images/pay_icon/nagad.png') }}">
                                        </div>
                                        Nagad
                                    </label>
                                </div>
                                <!-- {{-- Bkash Payment --}} -->
                                <div class="card mt-3 bkash_payment_body ">
                                    <div class="card-body">
                                        <div class="bkash_details ">
                                            <p class="text-center">Follow these steps for bKash payment</p>
                                            <div class="card mb-3">
                                                <ul class="list-group list-group-flush">
                                                    <li class="list-group-item">
                                                        01. Go to your bKash Mobile Menu by dialing *247#
                                                    </li>
                                                    <li class="list-group-item">02. Choose “Send Money”</li>
                                                    <li class="list-group-item">03. Enter The bKash Account Number
                                                        01309313258
                                                    </li>
                                                    <li class="list-group-item">04. Enter Your amount Tk</li>
                                                    <li class="list-group-item">05. Enter a reference 1234</li>
                                                    <li class="list-group-item">
                                                        06. Now enter your bKash Mobile Menu PIN to confirm
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleFormControlInput1">Enter Mobile Number</label>
                                            <input type="text" name="payment_number_bkash" class="form-control"
                                                id="exampleFormControlInput1" placeholder="Mobile Number">
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleFormControlInput1">Transection Id</label>
                                            <input type="text" name="trx_id_bkash" class="form-control"
                                                id="exampleFormControlInput2" placeholder="Transection Id">
                                        </div>
                                    </div>
                                </div>
                                <!-- {{-- Nagad mayment --}} -->
                                <div class="card mt-3 nagad_payment_body">
                                    <div class="card-body">
                                        <div class="nagad_details ">
                                            <p class="text-center">Follow these steps for Nagad payment</p>
                                            <div class="card mb-3">
                                                <ul class="list-group list-group-flush">
                                                    <li class="list-group-item">
                                                        01. Go to your Nagad Mobile Menu by dialing *167#
                                                    </li>
                                                    <li class="list-group-item">02. Choose “Send Money”</li>
                                                    <li class="list-group-item">03. Enter The Nagad Account Number
                                                        0172402994
                                                    </li>
                                                    <li class="list-group-item">04. Enter your amount</li>
                                                    <li class="list-group-item">05. Enter a reference 1234</li>
                                                    <li class="list-group-item">
                                                        06. Now enter your Nagad Mobile Menu PIN to confirm
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleFormControlInput1">Enter Mobile Number</label>
                                            <input type="text" name="payment_number_nagad" class="form-control"
                                                id="exampleFormControlInput1" placeholder="Mobile Number">
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleFormControlInput1">Transection Id</label>
                                            <input type="text" name="trx_id_nagad" class="form-control"
                                                id="exampleFormControlInput2" placeholder="Transection Id">
                                        </div>
                                    </div>
                                </div>
                                <!-- {{-- Rocket mayment --}} -->
                                <div class="card mt-3 rocket_payment_body">
                                    <div class="card-body">
                                        <div class="nagad_details ">
                                            <p class="text-center">Follow these steps for Rocket payment</p>
                                            <div class="card mb-3">
                                                <ul class="list-group list-group-flush">
                                                    <li class="list-group-item">
                                                        01. Go to your Rocket Mobile Menu by dialing *322#
                                                    </li>
                                                    <li class="list-group-item">02. Choose “Send Money”</li>
                                                    <li class="list-group-item">
                                                        03. Enter The Rocket Account Number 019199712196
                                                    </li>
                                                    <li class="list-group-item">04. Enter your amount</li>
                                                    <li class="list-group-item">05. Enter a reference 1234</li>
                                                    <li class="list-group-item">
                                                        06. Now enter your Rocket Mobile Menu PIN to
                                                        confirm
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleFormControlInput1">Enter Mobile Number</label>
                                            <input type="text" name="payment_number_rocket" class="form-control"
                                                id="exampleFormControlInput1" placeholder="Mobile Number">
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleFormControlInput1">Transection Id</label>
                                            <input type="text" name="trx_id_rocket" class="form-control"
                                                id="exampleFormControlInput2" placeholder="Transection Id">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-dark btn-place-order" form="checkout-form">
                                Place order
                            </button>
                        </div>
                        <!-- End .cart-summary -->
                    </div>
                    <!-- End .col-lg-4 -->
                </div>
            </form>
            <!-- End .row -->
        </div>
        <!-- End .container -->
    </main>
@endsection
@section('js')
    <script>
        function shipping_charge(value) {

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

                    url: "{{ asset('/') }}add-shipping-charge",
                    data: {
                        ship: value,
                    },
                    cache: false,
                    success: function(response) {
                        //  window.location.reload();
                        if (response.status === 'success') {


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
                                title: 'Shipping Charge added successfully'
                            })


                            $('.total_with_shipping_charge').html(response.total);
                            $('.total_with_shipping_charge').val(response.total);

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
    </script>
    <script>
        $('.bkash_payment_body').hide();
        $('.nagad_payment_body').hide();
        $('.rocket_payment_body').hide();

        function bkash() {
            $('.bkash_payment_body').show();

            $('.nagad_payment_body').hide();
            $('.rocket_payment_body').hide();
        }

        function nagad() {
            $('.nagad_payment_body').show();


            $('.bkash_payment_body').hide();
            $('.rocket_payment_body').hide();
        }

        function cash() {
            $('.nagad_payment_body').hide();
            $('.bkash_payment_body').hide();
            $('.rocket_payment_body').hide();
        }

        function rocket() {

            $('.rocket_payment_body').show();

            $('.nagad_payment_body').hide();
            $('.bkash_payment_body').hide();
        }
    </script>
@endsection