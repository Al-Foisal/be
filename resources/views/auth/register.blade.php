@extends('frontend.layouts.master')
@section('title', 'Customer registration area')
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
                <form method="POST" action="{{ route('register') }}">
                    @csrf

                    <div class="form-group">
                        <label>Name <span class="required">*</span></label>
                        <input type="text" name="name" class="form-control form-control-sm" required>
                    </div>

                    <div class="form-group">
                        <label>Email or Phone <span class="required">*</span></label>
                        <input type="text" name="email" class="form-control form-control-sm" required>
                    </div>
                    <!-- End .form-group -->

                    <div class="form-group">
                        <label>Password <span class="required">*</span></label>
                        <input type="password" name="password" class="form-control form-control-sm" required>
                    </div>
                    <!-- End .form-group -->

                    <div class="form-group">
                        <label>Confirm Password <span class="required">*</span></label>
                        <input type="password" name="password_confirmation" class="form-control form-control-sm" required>
                    </div>

                    <!-- Remember Me -->
                    <div class="d-flex justify-content-between">
                        
                        @if (Route::has('login'))
                            <a class="underline text-sm text-gray-600 hover:text-gray-900"
                                href="{{ route('login') }}">
                                {{ __('Already have an account?') }}
                            </a>
                        @endif
                    </div>

                    <div class="mt-4">
                        <button type="submit" class="btn btn-primary">Register</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
