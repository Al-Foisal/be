@extends('backend.layouts.master')
@section('title', 'Slider Edit')
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
                        <form action="{{ route('admin.updateSlider', $slider) }}" method="POST"
                            enctype="multipart/form-data">
                            @csrf
                            @method('put')
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Banner position:</label>
                                            <select class="form-control  select2bs4" style="width: 100%;" name="type">
                                                <option value="">--select--</option>
                                                <option value="1" @if ($slider->type == 1) selected @endif>Main
                                                    Slider Banner</option>
                                                <option value="2" @if ($slider->type == 2) selected @endif>Left
                                                    Mobile Banner</option>
                                                <option value="3" @if ($slider->type == 3) selected @endif>Right
                                                    Mobile Banner</option>
                                                <option value="4" @if ($slider->type == 4) selected @endif>Category Banner</option>
                                                <option value="5" @if ($slider->type == 5) selected @endif>BazarMall Banner</option>
                                                <option value="6" @if ($slider->type == 6) selected @endif>Flash Deal Banner</option>
                                                <option value="7" @if ($slider->type == 7) selected @endif>Fashion Banner</option>
                                                <option value="8" @if ($slider->type == 8) selected @endif>Every Day Low Price Banner</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="exampleInputFile">Image</label>
                                            <div class="input-group">
                                                <div class="custom-file">
                                                    <input type="file" class="form-control" name="image"
                                                        id="exampleInputFile">
                                                </div>
                                            </div>
                                            <img src="{{ asset($slider->image) }}" height="100" width="100" alt="">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Main Category:<span class="text-danger">*</span></label>
                                            <select class="form-control  select2bs4" style="width: 100%;" name="category_id"
                                                >
                                                <option value="">--select category--</option>
                                                @foreach ($categories as $category)
                                                    <option value="{{ $category->id }}"
                                                        @if ($category->id === $slider->category_id) {{ 'selected' }} @endif>
                                                        {{ $category->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="exampleInputFile">Link</label>
                                            <div class="input-group">
                                                <div class="custom-file">
                                                    <input type="text" class="form-control" name="link"
                                                        value="{{ $slider->link }}">
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
                </div>
                <!-- /.card -->
            </div>
        </div>
        </div>
        <!-- /.container-fluid -->
    </section>
    <!-- /.content -->
@endsection

@section('jsLink')
@endsection
@section('jsScript')
@endsection
