@extends('backend.layouts.master')
@section('title', 'Upate Voucher')

@section('backend')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Upate Voucher</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
                        <li class="breadcrumb-item active">Voucher</li>
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
                        <form action="{{ route('admin.updateVoucher', $voucher) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('patch')
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Offer Price</label>
                                            <input type="number" class="form-control" id="exampleInputEmail1"
                                                value="{{ $voucher->offer_amount }}" placeholder="Enter offer price" name="offer_amount">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Min. Spend</label>
                                            <input type="number" class="form-control" id="exampleInputEmail1"
                                                value="{{ $voucher->min_amount }}" name="min_amount">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Validity From</label>
                                            <input type="date" class="form-control" id="exampleInputEmail1"
                                                value="{{ $voucher->validity_from }}" name="validity_from">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Validity To</label>
                                            <input type="date" class="form-control" id="exampleInputEmail1"
                                                value="{{ $voucher->validity_to }}" name="validity_to">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Image (120x120)</label>
                                            <input type="file" class="form-control" id="exampleInputEmail1" name="image">
                                        </div>
                                        <img src="{{ asset($voucher->image) }}" width="50" height="50">
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
