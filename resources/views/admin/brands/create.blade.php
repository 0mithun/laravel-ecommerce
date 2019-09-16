@extends('admin.app')

@section('title')
{{ $pageTitle }}
@endsection

@section('content')
    <div class="app-title">
        <div>
            <h1><i class="fa fa-briefcase"></i></h1>
        </div>
    </div>
    @include('admin.partials.flash')

    <div class="row">
        <div class="col-md-8 mx-auto">
            <div class="tile">
                <h3 class="tile-title">{{ $subtitle }}</h3>
                <form action="{{ route('admin.brands.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <div class="tile-body">
                        <div class="form-group">
                            <label for="name" class="control-label">Name <span class="m-l-5 text-danger">*</span></label>
                            <input type="text" value="{{ old('name') }}" name="name" id="name" class="form-control @error('name') is-invalid @enderror">
                            @error('name')
                            <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">

                            <label for="logo" class="control-label">Brand Logo</label>
                            <input class="form-control @error('logo') is-invalid @enderror" type="file" name="logo" id="logo" >
                            @error('logo')
                            <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="tile-footer">
                        <button class="btn btn-primary" type="submit"> <i class="fa fa-fw fa-lg fa-check-circle"></i> Save Brand</button>
                        <a href="{{ route('admin.brands.index') }}" class="btn btn-secondary"> <i class="fa fa-fw lg fa-times-circle"></i> Cancel</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
