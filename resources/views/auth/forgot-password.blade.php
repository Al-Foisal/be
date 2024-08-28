@extends('frontend.layouts.master')
@section('title', 'Customer forgot password area')
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
                    <a href="{{ route('home') }}">
                        <img src="{{ asset($company->logo) }}" style="width: 100%;">
                    </a>
                </div>
                <div class="mb-4 text-sm text-gray-600">
                    Forgot your password? No problem. Just let us know your email address and we will email you a password reset link that will allow you to choose a new one.
                </div>
                <form method="POST" action="{{ route('password.email') }}">
                    @csrf

                    <div class="form-group">
                        <label>Email <span class="required">*</span></label>
                        <input type="email" name="email" class="form-control form-control-sm" required>
                    </div>
                    <!-- End .form-group -->

                    <div class="mt-4">
                        <button type="submit" class="btn btn-primary">Email Password Reset Link</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

