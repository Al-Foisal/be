@extends('backend.layouts.master')
@section('title', 'Slider Create')

@section('backend')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Slider</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
                        <li class="breadcrumb-item active">Slider</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card card-primary">
                        <!-- /.card-header -->
                        <!-- form start -->
                        <form action="{{ route('admin.storeSlider') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="card-body">
                                <div class="bg-primary p-2">
                                    <p>Main slider banner: 1200x418</p>
                                    <p>Left and Right mobile banner: 460x720</p>
                                    <p>Category slider banner: 1190x300</p>
                                    <p>BazarMall banner: 1190x300</p>
                                    <p>Flash Deal banner: 1190x300</p>
                                    <p>Fashion banner: 1190x300</p>
                                    <p>Every Day Low Price banner: 1190x300</p>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Banner position<span class="text-danger">*</span></label>
                                            <select class="form-control  select2bs4" style="width: 100%;" name="type"
                                                >
                                                <option value="">--select--</option>
                                                <option value="1">Main Slider Banner</option>
                                                <option value="2">Left Mobile Banner</option>
                                                <option value="3">Right Mobile Banner</option>
                                                <option value="4">Category Banner</option>
                                                <option value="5">BazarMall Banner</option>
                                                <option value="6">Flash Deal Banner</option>
                                                <option value="7">Fashion Banner</option>
                                                <option value="8">Every Day Low Price Banner</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="exampleInputFile">Image<span class="text-danger">*</span></label>
                                            <div class="input-group">
                                                <div class="custom-file">
                                                    <input type="file" class="form-control" name="image"
                                                        id="exampleInputFile">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Main Category:(<span class="text-danger">select only for menu banner</span> | optional)</label>
                                            <select class="form-control  select2bs4" style="width: 100%;" name="category_id"
                                                >
                                                <option value="">--select category--</option>
                                                @foreach ($categories as $category)
                                                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="exampleInputFile">Link(optional)</label>
                                            <div class="input-group">
                                                <div class="custom-file">
                                                    <input type="text" class="form-control" name="link"
                                                        placeholder="Enter banner link">
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
        </div>
        <!-- /.container-fluid -->
    </section>
    <!-- /.content -->
@endsection
