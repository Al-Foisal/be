@extends('backend.layouts.master')
@section('title', 'Edit Product')
@section('cssLink')
@section('cssStyle')
    <style>
        /* Chrome, Safari, Edge, Opera */
        input::-webkit-outer-spin-button,
        input::-webkit-inner-spin-button {
            -webkit-appearance: none;
            margin: 0;
        }

        /* Firefox */
        input[type=number] {
            -moz-appearance: textfield;
        }

    </style>
@endsection

@section('backend')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Update Product</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
                        <li class="breadcrumb-item active">Product</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="container">
            <div class="row">
                <!-- left column -->
                <div class="col-md-12">
                    <!-- jquery validation -->
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Update product goes here</h3>
                            <br>
                            <br>
                            <a href="{{ route('admin.editProductImage', $product->id) }}" class="btn btn-info">Update Product Image</a>
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->
                        <form action="{{ route('admin.updateProduct', $product->id) }}" method="post"
                            enctype="multipart/form-data">
                            @csrf
                            @method('patch')
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label>Main Category:<span class="text-danger">*</span></label>
                                            <select class="form-control  select2bs4" style="width: 100%;" name="category_id"
                                                required>
                                                <option value="">--select category--</option>
                                                @foreach ($categories as $category)
                                                    <option value="{{ $category->id }}" @if($category->id === $product->category_id) {{ 'selected' }} @endif>{{ $category->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label>Subcategory:</label>
                                            <select class="form-control  select2bs4" data-placeholder="Select subcategory"
                                                style="width: 100%" name="subcategory_id">
                                                <option value="{{ $product->subcategory_id }}" selected>{{ $product->subcategory->name??'' }}</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label>Child Category:</label>
                                            <select class="form-control  select2bs4"
                                                data-placeholder="Select Child Category" style="width: 100%"
                                                name="childcategory_id">
                                                <option value="{{ $product->childcategory_id }}" selected>{{ $product->childcategory->name??'' }}</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label>Brand:</label>
                                            <select class="form-control  select2bs4" style="width: 100%;" name="brand_id"
                                                required>
                                                <option value="">--select brand--</option>
                                                @foreach ($brands as $brand)
                                                    <option value="{{ $brand->id }}" @if($brand->id === $product->brand_id) {{ 'selected' }} @endif>{{ $brand->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <div class="form-group">
                                    <label for="product_name">Product name:<span class="text-danger">*</span></label>
                                    <textarea rows="2" type="text" name="name"
                                        class="form-control"
                                        id="product_name">{{ $product->name }}</textarea>
                                </div>

                                <div class="row">
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label for="buying">Buying price:</label>
                                            <input type="number" name="buying" class="form-control" id="buying"
                                                value="{{ $product->buying }}" />
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="selling">Selling price:<span class="text-danger">*</span></label>
                                            <input type="number" name="selling"
                                                class="form-control" id="selling"
                                                value="{{ $product->selling }}" />
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label for="discount">Discount:</label>
                                            <input type="number" name="discount" class="form-control" id="discount"
                                                value="{{ $product->discount }}" />
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label for="discount">Discount price:</label>
                                            <input type="text" readonly name="discount_price" class="form-control"
                                                value="{{ $product->discount_price }}" id="discount_price" />
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="quantity">Quantity:<span class="text-danger">*</span></label>
                                            <input type="number" name="quantity"
                                                class="form-control" id="quantity"
                                                value="{{ $product->quantity }}" />
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="product_details">Product details:<span
                                            class="text-danger">*</span></label>
                                    <textarea type="text" name="details"
                                        class="form-control" id="summernote1"
                                        rows="5">{{ $product->details }}</textarea>
                                </div>

                                <div class="form-group">
                                    <label for="product_details">Product Specefication:</label>
                                    <textarea type="text" name="specification"
                                        class="form-control" id="summernote"
                                        rows="5">{{ $product->specification }}</textarea>
                                </div>
                                <hr>

                                <div class="form-group">
                                    <label for="product_video">Product video:</label>
                                    <textarea rows="2" type="text" name="video" class="form-control" id="product_video"
                                        placeholder="Enter product video">{{ $product->video }}</textarea>
                                </div>
                                <hr>
                                <div class="card card-success">
                                    <div class="card-header">
                                        <h3 class="card-title">Product Size</h3>
                                    </div>
                                    <div class="card-body">
                                        <div class="row">
                                            <!-- checkbox -->
                                            @foreach ($sizes as $size)
                                                <div class="col-sm-4">
                                                    <div class="form-group clearfix">
                                                        <div class="icheck-success d-inline">
                                                            <input type="checkbox" id="{{ $size->size }}" name="sizes[]"
                                                                value="{{ $size->id }}"
                                                                {{ in_array($size->id, old('sizes', $product->sizes->pluck('id')->toArray())) ? 'checked' : '' }}>
                                                            <label for="{{ $size->size }}"> {{ $size->size }}
                                                            </label>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>

                                <div class="card card-success">
                                    <div class="card-header">
                                        <h3 class="card-title">Product Color</h3>
                                    </div>
                                    <div class="card-body">
                                        <div class="row">
                                            <!-- checkbox -->
                                            @foreach ($colors as $color)
                                                <div class="col-sm-4">
                                                    <div class="form-group clearfix">
                                                        <div class="icheck-success d-inline">
                                                            <input type="checkbox" id="{{ $color->color }}"
                                                                name="colors[]" value="{{ $color->id }}"
                                                                {{ in_array($color->id, old('colors', $product->colors->pluck('id')->toArray())) ? 'checked' : '' }}>
                                                            <label for="{{ $color->color }}" style="color: {{ $color->color_code }}"> {{ $color->color }}
                                                            </label>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>

                                <div class="card card-success">
                                    <div class="card-header">
                                        <h3 class="card-title">Choice your action (product must have discount price)</h3>
                                    </div>
                                    <div class="card-body">
                                        <div class="row">
                                            <!-- checkbox -->
                                            <div class="col-sm-3">
                                                <div class="form-group clearfix">
                                                    <div class="icheck-primary d-inline">
                                                        <input type="checkbox"  id="flash_deal" name="flash_deal" value="1" @if($product->flash_deal === 1) {{ 'checked' }} @endif>
                                                        <label for="flash_deal"> Flash Deal
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-sm-3">
                                                <div class="form-group clearfix">
                                                    <div class="icheck-success d-inline">
                                                        <input type="checkbox"  id="low_price" name="low_price" value="1" @if($product->low_price === 1) {{ 'checked' }} @endif>
                                                        <label for="low_price"> Everyday Low Price
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-sm-3">
                                                <div class="form-group clearfix">
                                                    <div class="icheck-success d-inline">
                                                        <input type="checkbox"  id="flash_sale" name="flash_sale" value="1" @if($product->flash_sale === 1) {{ 'checked' }} @endif>
                                                        <label for="flash_sale"> Flash Sale
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-sm-3">
                                                <div class="form-group clearfix">
                                                    <div class="icheck-success d-inline">
                                                        <input type="checkbox"  id="fashion" name="fashion" value="1" @if($product->fashion === 1) {{ 'checked' }} @endif>
                                                        <label for="fashion"> Fashion
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- /.card-body -->
                                <div class="card-footer">
                                    <button type="submit" class="btn btn-primary">Submit</button>
                                </div>
                        </form>
                    </div>
                    <!-- /.card -->
                </div>
            </div>
            <!-- /.row -->
        </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
@endsection

@section('jsLink')
    <!-- Summernote -->
    <script src="{{ asset('backend/plugins/summernote/summernote-bs4.min.js') }}"></script>
@endsection
@section('jsScript')
    <script>
        $(function() {
            //Initialize Select2 Elements
            $('.select2bs4').select2({
                theme: 'bootstrap4',
                allowClear: true
            });
        });
    </script>


    <!-- summernote Page specific script -->
    <script>
        $(function() {
            // Summernote
            $('#summernote').summernote()
            $('#summernote1').summernote()
        })
    </script>

    {{-- submenu dependency --}}
    <script type="text/javascript">
        $(document).ready(function() {
            $('select[name="category_id"]').on('change', function() {
                var category_id = $(this).val();
                if (category_id) {
                    $.ajax({
                        url: "{{ url('/get-subcategory/') }}/" + category_id,
                        type: "GET",
                        dataType: "json",
                        success: function(data) {
                            var d = $('select[name="subcategory_id"]').empty();
                            var f = $('select[name="Childcategory_id"]').empty();
                            $.each(data, function(key, value) {
                                $('select[name="subcategory_id"]').append(
                                    '<option value="" selected>--select subcategory--</option>' +
                                    '<option value="' + value.id + '">' + value
                                    .name + '</option>');
                                $('select[name="childcategory_id"]').append(
                                    '<option value="" selected>--select childcategory--</option>');
                            });
                        },
                    });
                } else {
                    alert('danger');
                }
            });
        });
    </script>

    <script type="text/javascript">
        $(document).ready(function() {
            $('select[name="category_id"]').on('change', function() {
                var category_id = $(this).val();
                $('select[name="subcategory_id"]').on('change', function() {
                    var subcategory_id = $(this).val();
                    if (subcategory_id) {
                        $.ajax({
                            url: "{{ url('/get-childcategory/') }}/" + category_id +
                                "/" + subcategory_id,
                            type: "GET",
                            dataType: "json",
                            success: function(data) {
                                var d = $('select[name="childcategory_id"]').empty();
                                $.each(data, function(key, value) {
                                    $('select[name="childcategory_id"]').append(
                                        '<option value="" selected>--select child category--</option>' +
                                        '<option value="' + value.id +
                                        '">' + value
                                        .name + '</option>');
                                });
                            },
                        });
                    } else {
                        alert('danger');
                    }
                });
            });
        });
    </script>

    {{-- for discount price --}}
    <script type="text/javascript">
        $(function() {
            $("#selling, #discount").on("keydown keyup", sum);

            function sum() {
                var selling = Number($("#selling").val());
                var discount = Number($("#discount").val());
                var discount_price = (selling * discount) / 100;
                if (discount > 0) {
                    $("#discount_price").val(selling - discount_price);
                } else {
                    $("#discount_price").val(null);
                }
            }
        });
    </script>
@endsection
