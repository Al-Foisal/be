@extends('frontend.layouts.master')
@section('title', 'Login area')
@section('css')
    <style>
        .page {
            width: 40%;
            margin: auto;
            padding: 5%;
        }

        .form-control {
            background: #f7f7f7;
        }

        @media (max-width: 676px) {
            .page {
                width: 90%;
                margin: auto;
                padding: 5%;
            }
        }

    </style>
@endsection
@section('content')
    <div class="tab-pane fade show active bg-white" id="product-reviews-content" role="tabpanel"
        aria-labelledby="product-tab-reviews">
        <div class="product-reviews-content">
            <div class="page">
                <div style="text-align:center;">
                    <img src="{{ asset($company->logo) }}" alt="">
                </div>
                <form method="POST" action="{{ route('order.track.store') }}">
                    @csrf

                    <div class="form-group">
                        <label>Order ID <span class="required">*</span></label>
                        <input type="text" name="track" class="form-control form-control-sm" required>
                    </div>
                    <!-- End .form-group -->

                    <div class="mt-4">
                        <button type="submit" class="btn btn-primary">Login</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
