@extends('frontend.layouts.master')
@section('title', 'All Collection')

@section('content')
    <main class="main mb-5">
        <div class="container mt-5">
            <div class="container">
                <div class="row">
                    <!-- product 1 -->
                    @foreach ($collections as $col)
                        <div class="col-lg-4 col-12 bg-white" style="border: 5px solid #f2f2f2;padding: 30px;">
                            <a href="{{ route('allProductCollection',$col) }}">
                                <div class="product-default inner-icon" style="padding-top: 20px;">
                                    <div style="text-align: center;color: black;">
                                        {{ $col->name }} >
                                    </div>
                                    <div style="text-align: center;">
                                        @php
                                            $count = 0;
                                            foreach (explode(',', $col->product_collection) as $coll) {
                                                $sub = \App\Models\Subcategory::where('id', $coll)
                                                    ->with('products')
                                                    ->first();
                                                $count += $sub->products->count();
                                            }
                                        @endphp
                                        {{ $count }} products
                                    </div>
                                    <div class="d-flex justify-content-between">
                                        @php
                                        foreach (explode(',', $col->product_collection) as $coll) {
                                            $sub = \App\Models\Subcategory::where('id', $coll)
                                                ->with('products')
                                                ->first();
                                            echo '<img src="'.asset($sub->image).'" alt="Category" style="height: 80px;width: 80px;">';
                                        }
                                    @endphp
                                    </div>
                                </div>
                            </a>
                            <!-- End .product-default -->
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </main>
@endsection
