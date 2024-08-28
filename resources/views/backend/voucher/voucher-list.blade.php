@extends('backend.layouts.master')
@section('title', 'Voucher List')

@section('backend')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Voucher List</h1>
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
                <div class="col-12">
                    <div class="card">
                        <!-- /.card-header -->
                        <div class="card-body">
                            <a href="{{ route('admin.createVoucher') }}" class="btn btn-outline-primary">Add Voucher</a>
                            <br>
                            <br>
                            <table id="example1" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>Action</th>
                                        <th>Offer Price</th>
                                        <th>Min. Spend</th>
                                        <th>Validity From</th>
                                        <th>Validity To</th>
                                        <th>Image</th>
                                        <th>Created_at</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($voucher_list as $voucher)
                                        <tr>
                                            <td class="d-flex justify-content-between">
                                                <a href="{{ route('admin.editVoucher', $voucher) }}"
                                                    class="btn btn-info btn-xs"> <i class="fas fa-edit"></i> </a>
                                                <form action="{{ route('admin.deleteVoucher', $voucher) }}"
                                                    method="post">
                                                    @csrf
                                                    @method('delete')
                                                    <button type="submit"
                                                        onclick="return(confirm('Are you sure want to delete this item?'))"
                                                        class="btn btn-danger btn-xs"> <i class="fa fa-trash"></i>
                                                    </button>
                                                </form>
                                            </td>
                                            <td>{{ $voucher->offer_amount }}</td>
                                            <td>{{ $voucher->min_amount }}</td>
                                            <td>{{ $voucher->validity_from }}</td>
                                            <td>{{ $voucher->validity_to }}</td>
                                            <td><img src="{{ asset($voucher->image) }}" height="50" width="50"></td>
                                            <td>{{ $voucher->created_at }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
        </div>
        <!-- /.container-fluid -->
    </section>
    <!-- /.content -->
@endsection
