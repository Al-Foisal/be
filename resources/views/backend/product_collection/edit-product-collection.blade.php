@extends('backend.layouts.master')
@section('title', 'Edit Product Collection')

@section('backend')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Update Product Collection</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
                        <li class="breadcrumb-item active">Product Collection</li>
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
                            <h3 class="card-title">Update product collection goes here</h3>
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->
                        <form action="{{ route('admin.updateProductCollection', $product_collection->id) }}" method="post"
                            enctype="multipart/form-data">
                            @csrf
                            @method('put')
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="product_name">Product collection name:<span class="text-danger">*</span></label>
                                    <input type="text" name="name" class="form-control" id="product_name"
                                        value="{{ $product_collection->name }}"/>
                                </div>

                                <div class="card card-success">
                                    <div class="card-header">
                                        <h3 class="card-title">Choice your collection 3(THREE) from below</h3>
                                    </div>
                                    <div class="card-body">
                                        <div class="row">
                                            <!-- checkbox -->
                                            @foreach ($subcategories as $sub)
                                                <div class="col-sm-2">
                                                    <div class="form-group clearfix">
                                                        <div class="icheck-success d-inline">
                                                            <input type="checkbox" id="{{ $sub->name }}" name="product_collection[]"
                                                                value="{{ $sub->id }}" {{ in_array($sub->id, old('product_collection', explode(',',$product_collection->product_collection))) ? 'checked' : '' }}>
                                                            <label for="{{ $sub->name }}"> {{ $sub->name }}
                                                            </label>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endforeach
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
                $("#discount_price").val((selling * discount) / 100);
            }
        });
    </script>
@endsection
