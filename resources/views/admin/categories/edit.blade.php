@extends('admin.app') @section('title') {{ $pageTitle }} @endsection
@section('content')
<div class="app-title">
    <div>
        <h1>
            <i class="fa fa-tags"> {{ $pageTitle }}</i>
        </h1>
    </div>
</div>
@include('admin.partials.flash')
<div class="row">
    <div class="col-md-8 mx-auto">
        <div class="tile">
            <h3 class="tile-title">{{ $pageTitle }}</h3>

            <form
                action="{{ route('admin.categories.update', $targetCategory->id) }}"
                method="POST"
                role="form"
                enctype="multipart/form-data"
            >
                @csrf
                @method('PUT')
                <div class="tile-body">
                    <input type="hidden" name="id" value="{{ $targetCategory->id }}">
                    <div class="form-group">
                        <label for="name" class="control-label"
                            >Name <span class="m-l-5 text-danger">*</span>
                        </label>
                        <input
                            type="text"
                            class="form-control @error('name') is-invalid @enderror"
                            name="name"
                            id="name"
                            placeholder="Enter category name"
                            value="{{ old('name', $targetCategory->name) }}"
                        />
                        @error('name')
                        <span class="invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="description" class="control-label"
                            >Description
                            <span class="m-l-5 text-danger">*</span>
                        </label>
                        <textarea
                            class="form-control @error('description') is-invalid @enderror"
                            name="description"
                            id="description"
                            cols="30"
                            r
                            ows="5"
                            placeholder="Enter category description"
                        >{{ old('description', $targetCategory->description) }}</textarea>
                        @error('description')
                        <span class="invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="parent_id" class="control-label"
                            >Parent Category
                            <span class="m-l-5 text-danger">*</span>
                        </label>
                        <select
                            class="form-control @error('parent_id') is-invalid @enderror"
                            name="parent_id"
                            id="parent_id"
                        >
                            <option value="0">Select a parent category</option>
                            @foreach($categories as $key => $category)
                            @if($targetCategory->parent_id == $key)
                                <option
                                    value="{{ $key }}"
                                    selected
                                    >{{ $category }}</option
                                >
                            @else
                                <option
                                    value="{{ $key }}"
                                    >{{ $category }}</option
                                >
                            @endif

                            @endforeach
                        </select>
                        @error('parent_id')
                        <span class="invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <div class="form-check">
                            <label for="name" class="form-check-label">
                                <input
                                    type="checkbox"
                                    name="featured"
                                    id="featured"
                                    {{ $targetCategory->featured == 1 ? 'checked' :'' }}
                                />
                                Featured Category
                            </label>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="form-check">
                            <label for="name" class="form-check-label">
                                <input
                                    type="checkbox"
                                    name="menu"
                                    id="menu"
                                    {{ $targetCategory->menu == 1 ? 'checked' : '' }}
                                />
                                Show in menu
                            </label>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-2">
                                @if( $targetCategory->image !=null)
                                    <figure class="mt-2" style="width: 80px; height: auto">
                                        <img
                                            src="{{ asset('storage/'.$targetCategory->image) }}"
                                            id="categoryImage"
                                            class="img-fluid"
                                        >
                                    </figure>
                                @endif
                            </div>
                            <div class="col-md-10">
                                <label class="control-label">Category Image</label>
                                <input
                                    type="file"
                                    name="image"
                                    id="image"
                                    class="form-control @error('image') is-invalid @enderror"
                                />
                                @error('image')
                                <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>
                <div class="tile-footer">
                    <button class="btn btn-primary" type="submit">
                        <i class="fa fa-fw fa-lg fa-check-circle"></i>
                        Save Category
                    </button>

                    &nbsp; &nbsp; &nbsp;
                    <a
                        href="{{ route('admin.categories.index') }}"
                        class="btn btn-secondary"
                    >
                        <i class="fa fa-fw fa-lg fa-times-circle"></i>
                        Cancel</a
                    >
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
