@extends('backend.layouts.master')
@section('title', 'Product Collection List')

@section('backend')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Product Collection List</h1>
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
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <!-- /.card-header -->
                        <div class="card-body">
                            <a href="{{ route('admin.createProductCollection') }}" class="btn btn-outline-primary">Create
                                New
                                Product Collection</a>
                            <br>
                            <br>
                            <table id="example1" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>Action</th>
                                        <th>Name</th>
                                        <th>Product Collection</th>
                                        <th>Product Count</th>
                                        <th>Created_at</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($product_collection as $collection)
                                        <tr>
                                            <td class="d-flex justify-content-between">
                                                <a href="{{ route('admin.editProductCollection', $collection->id) }}"
                                                    class="btn btn-info btn-xs mr-2"> <i class="fas fa-edit"></i> </a>
                                                <form
                                                    action="{{ route('admin.deleteProductCollection', $collection->id) }}"
                                                    method="post">
                                                    @csrf
                                                    @method('delete')
                                                    <button type="submit"
                                                        onclick="return(confirm('Are you sure want to delete this item?'))"
                                                        class="btn btn-danger btn-xs"> <i class="fas fa-trash-alt"></i>
                                                    </button>
                                                </form>
                                            </td>
                                            <td>{{ $collection->name }}</td>
                                            <td>
                                                @php
                                                    $count = 0;
                                                    foreach (explode(',', $collection->product_collection) as $coll) {
                                                        $sub = \App\Models\Subcategory::where('id', $coll)
                                                            ->with('products')
                                                            ->first();
                                                        $count += $sub->products->count();
                                                        echo $sub->name . ' | ';
                                                    }
                                                @endphp
                                            </td>
                                            <td>{{ $count }}
                                            </td>
                                            <td>{{ $collection->created_at }}</td>

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
