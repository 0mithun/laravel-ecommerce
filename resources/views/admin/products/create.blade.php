@extends('admin.app')

@section('title')
    {{ $pageTitle }}
@endsection

@section('content')
    <div class="app-title">
        <div>
            <h1><i class="fa fa-shopping-bag"></i> {{ $pageTitle }} - {{ $subtitle }}</h1>
        </div>
    </div>
    @include('admin.partials.flash')
    <div class="row user">
        <div class="col-md-3">
            <div class="tile p-0">
                <ul class="nav flex-column nav-tabs user-tabs">
                    <li class="nav-item">
                        <a href="#general" class="nav-link active" data-toggle="tab">General</a>
                    </li>
                </ul>
            </div>
        </div>
        <div class="col-md-9">
            <div class="tab-content">
                <div class="tab-pane active" id="general">
                    <div class="tile">
                        <form action="{{ route('admin.products.store') }}" method="POST">
                            @csrf
                            <h3 class="tile-title">Product Information</h3>
                            <hr>
                            <div class="tile-body">
                                <div class="form-group">
                                    <label for="name" class="control-label">Name</label>
                                    <input
                                        type="text"
                                        class="form-control @error('name') is-invalid @enderror"
                                        id="name"
                                        name="name"
                                        placeholder="Enter product name"
                                        value="{{ old('name') }}"
                                        >
                                        @error('name')
                                         <span class="invalid-feedback">{{ $message }}</span>
                                        @enderror
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="sku" class="control-label">SKU</label>
                                            <input
                                                type="text"
                                                class="form-control @error('sku') is-invalid @enderror"
                                                placeholder="Enter product sku"
                                                name="sku"
                                                id="sku"
                                                value="{{ old('sku') }}"
                                                >
                                            @error('sku')
                                                <span class="invalid-feedback">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="brand_id" class="control-label">Brand</label>
                                            <select
                                                name="brand_id"
                                                id="brand_id"
                                                class="form-control @error('brand_id') is-invalid @enderror"

                                                >
                                                <option value="0" selected disabled>Select a brand</option>

                                                @foreach($brands as $brand)
                                                    <option value="{{ $brand->id }}">{{ $brand->name }}</option>
                                                @endforeach

                                            </select>
                                            @error('brand')
                                                <span class="invalid-feedback">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="categories" class="control-label">Categories</label>
                                            <select
                                                name="categories[]"
                                                id="categories"
                                                class="form-control @error('categories') is-invalid @enderror"
                                                multiple
                                            >
                                                <!-- <option value="0" selected disabled>Select Categories</option> -->

                                                @foreach($categories as $category)
                                                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                                                @endforeach
                                            </select>

                                            @error('categories')
                                                <span class="invalid-beedback">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="price" class="control-label">Price</label>
                                            <input
                                                type="text"
                                                class="form-control @error('price') is-invalid @enderror"
                                                id="price"
                                                name="price"
                                                value="{{ old('price') }}"
                                                placeholder="Enter product price"
                                                >

                                            @error('price')
                                                <span class="invalid-feedback">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="sale_price" class="control-label">Sale Price</label>
                                            <input
                                                type="text"
                                                class="form-control @error('sale_price') is-invalid @enderror"
                                                id="sale_price"
                                                name="sale_price"
                                                value="{{ old('sale_price') }}"
                                                placeholder="Enter product sale price"
                                                >

                                                @error('sale_price')
                                                    <span class="invalid-feedback">{{ $message }}</span>
                                                @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="quantity" class="control-label">Quantity</label>
                                            <input
                                                type="number"
                                                class="form-control @error('quantity') is-invalid  @enderror"
                                                id="quantity"
                                                name="quantity"
                                                value="{{ old('quantity') }}"
                                                placeholder="Ener product quantity"
                                                >

                                                @error('quantity')
                                                    <span class="invalid-feedback">{{ $message }}</span>
                                                @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="weight" class="control-label">Weight</label>
                                            <input
                                                type="text"
                                                class="form-control @error('weight') @enderror"
                                                id="weight"
                                                name="weight"
                                                value="{{ old('weight') }}"
                                                placeholder="Ener product weight"
                                                >

                                                @error('weight')
                                                    <span class="invalid-feedback">{{ $message }}</span>
                                                @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="description" class="control-label">Description</label>
                                    <textarea name="description" id="description" cols="30" rows="2" class="form-control">{{ old('description') }}</textarea>

                                </div>
                                <div class="form-group">
                                    <div class="form-check">
                                        <label class="form-check-label">
                                            <input type="checkbox" name="status" id="status" class="form-check-input">
                                            Status
                                        </label>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="form-check">
                                        <label class="form-check-label">
                                            <input type="checkbox" name="featured" id="featured" class="form-check-input">
                                            Featured
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <div class="tile-footer">
                                <div class="row d-print-none mt-2">
                                    <div class="col-12 text-right">
                                        <button class="btn btn-success" type="submit"> <i class="fa fa-fw fa-lg fa-check-circle"></i> Save Product</button>
                                        <a href="{{ route('admin.products.index') }}" class="btn btn-danger">
                                            <i class="fa fa-fw fa-lg fa-arrow-left"></i> Bo Back
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

@push('scripts')
    <script src="{{ asset('backend/js/plugins/select2.min.js') }}"></script>
    <script>
        $(document).ready(function(){
            $('#categories').select2();
        });
    </script>
@endpush
