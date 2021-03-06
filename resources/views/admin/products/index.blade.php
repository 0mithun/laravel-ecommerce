@extends('admin.app')

@section('title')
    {{ $pageTitle }}
@endsection

@section('content')
    <div class="app-title">
        <div>
            <h1><i class="fa fa-tags">{{ $pageTitle }}</i></h1>
            <p>{{ $subtitle }}</p>
        </div>
        <a href="{{ route('admin.products.create') }}" class="btn btn-primary pull-right">Add Product</a>
    </div>
    @include('admin.partials.flash')

    <div class="row">
        <div class="col-md-12">
            <div class="tile">
                <div class="tile-body">
                    <table class="table table-bordered table-hover" id="sampleTable">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>SKU</th>
                                <th>Name</th>
                                <th class="text-center">Brand</th>
                                <th class="text-center">Categories</th>
                                <th class="text-center">Price</th>
                                <th class="text-center">Status</th>
                                <th class="text-center text-danger" style="width:100px; min-width:100px;"><i class="fa fa-bolt"></i></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($products as $product)
                            <tr>
                                <td>{{ $product->id }}</td>
                                <td>{{ $product->sku }}</td>
                                <td>{{ $product->name }}</td>
                                <td>{{ $product->brand->name }}</td>
                                <td>
                                    @foreach($product->categories as $category)
                                        <span class="badge badge-info">{{ $category->name }}</span>
                                    @endforeach
                                </td>
                                <td>{{ config('settings.currency_symbol') }}{{ $product->price }}</td>
                                <td>
                                    @if($product->status == 1)
                                        <span class="badge badge-success">Active</span>
                                    @else
                                        <span class="badge badge-danger">Not Active</span>
                                    @endif
                                </td>
                                <td>
                                    <div class="btn-group">
                                        <a href="{{ route('admin.products.edit', $product->id) }}" class="btn btn-sm btn-primary"><i class="fa fa-edit"></i></a>
                                        <a href="{{ route('admin.products.edit', $product->id) }}" class="btn btn-sm btn-danger"><i class="fa fa-trash"></i></a>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection


@push('scripts')
    <script src="{{ asset('backend/js/plugins/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('backend/js/plugins/dataTables.bootstrap.min.js') }}"></script>
    <script>
        $('#sampleTable').DataTable();
    </script>
@endpush
