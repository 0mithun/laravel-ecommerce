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
                action="{{ route('admin.categories.store') }}"
                method="POST"
                role="form"
                enctype="multipart/form-data"
            >
                @csrf
                <div class="tile-body">
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
                            value="{{ old('name') }}"
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
                            rows="5"
                            placeholder="Enter category description"
                        >{{ old('description') }}</textarea>
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
                            @foreach($categories as $category)
                            <option
                                value="{{ $category->id }}"
                                >{{ $category->name }}</option
                            >
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
                                />
                                Featured Category
                            </label>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="form-check">
                            <label for="name" class="form-check-label">
                                <input type="checkbox" name="menu" id="menu" />
                                Show in menu
                            </label>
                        </div>
                    </div>
                    <div class="form-group">
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
