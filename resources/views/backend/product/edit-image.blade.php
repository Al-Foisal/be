@extends('backend.layouts.master')
@section('title', 'Edit Product Single Image')
@section('cssLink')
@endsection
@section('cssStyle')
@endsection

@section('backend')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Update Product Single Image</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
                        <li class="breadcrumb-item active">Product Image</li>
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
                            <h3 class="card-title">Update product single image goes here</h3>
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->
                        <form action="{{ route('admin.updateProductImage') }}" method="post"
                            enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <input type="hidden" name="count" value="{{ count($images) }}">
                            @foreach ($images as $key => $image)
                                <div class="col-md-12">
                                    <div class="card-body">
                                        <input type="hidden" name="id[]" value="{{ $image->id }}">
                                        <div class="mb-3">
                                            <label for="image" class="form-label text-black h6">Upload Product Image -
                                                {{ ++$key }}</label>
                                            <input type="file" name="image[]" class="form-control"
                                                aria-describedby="PriceHelp">
                                            <img src="{{ asset($image->image) }}" style="height: 100px;width:100px;"
                                                alt="">
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                            <button type="submit" class="btn btn-primary mt-3 w-100">Update Images</button>
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
