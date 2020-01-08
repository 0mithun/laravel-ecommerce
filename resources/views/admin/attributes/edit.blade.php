@extends('admin.app')
@section('title')
{{ $pageTitle }}
@endsection

@section('content')
    <div class="app-title">
        <div>
            <h1><i class="fa fa-cogs"></i>{{ $pageTitle }}</h1>
        </div>
    </div>
    @include('admin.partials.flash')
    <div class="row user">
        <div class="col-md-3">
            <div class="tile p-0">
                <ul class="nav flex-column nav-tabs user-tabs">
                    <li class="nav-item">
                        <a href="#general" class="nav-link active" data-toggle="tab">
                            General
                        </a>
                    </li>

                    <li class="nav-item">
                        <a href="#values" class="nav-link" data-toggle="tab">
                            Attribute Values
                        </a>
                    </li>
                </ul>
            </div>
        </div>
        <div class="col-md-9">
            <div class="tab-content">
                <div class="tab-pane active" id="general">
                    <div class="tile">
                        <form action="{{ route('admin.attributes.update', $attribute->id) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <input type="hidden" name="id" value="{{ $attribute->id }}">
                            <h3 class="page-title">Attribute Information</h3>
                            <hr>
                            <div class="tile-body">
                                <div class="form-group">
                                    <label for="code" class="control-label">Code</label>
                                    <input
                                        type="text"
                                        class="form-control  @error('code') is-invalid @enderror"
                                        name="code"
                                        id="code"
                                        value="{{ old('code',$attribute->code) }}"
                                        placeholder="Enter attribute code">
                                    @error('code')
                                        <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="code" class="control-label">Name</label>
                                    <input
                                        type="text"
                                        class="form-control @error('name') is-invalid @enderror"
                                        name="name"
                                        id="name"
                                        value="{{ old('name', $attribute->name) }}"
                                        placeholder="Enter attribute name">
                                    @error('name')
                                        <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="frontend_type" class="control-label">Frontend Type</label>
                                    @php
                                        $types = ['select'=>'Select Box', 'radio' => 'Radio Button', 'text' => 'Text Field', 'textarea' => 'Text Area'];
                                    @endphp
                                    <select name="frontend_type" id="frontend_type" class="form-control @error('frontend_type') is-invalid @enderror">
                                        @foreach($types as $key => $value)
                                            @if($attribute->frontend_type == $key)
                                                <option value="{{ $key }}" selected>{{ $value }}</option>
                                            @else
                                                <option value="{{ $key }}">{{ $value }}</option>
                                            @endif
                                        @endforeach
                                    </select>
                                    @error('frontend_type')
                                        <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <div class="form-check">
                                        <label class="form-check-label">
                                            <input
                                                type="checkbox"
                                                name="is_filterable"
                                                id="is_filterable"
                                                class="form-check-input"
                                                {{ $attribute->is_filterable == 1 ? 'checked' :'' }}
                                                > Filterable
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <label class="form-check-label">
                                            <input
                                                type="checkbox"
                                                name="is_required"
                                                id="is_required"
                                                class="form-check-input"
                                                {{ $attribute->is_required == 1 ? 'checked' :'' }}
                                                > Required
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <div class="tile-footer">
                                <div class="row d-print-none mt-2">
                                    <div class="col-12 text-right">
                                        <button class="btn btn-success" type="submit">
                                            <i class="fa fa-fw fa-lg fa-check-circle"></i>Update Attribute
                                        </button>
                                        <a href="{{ route('admin.attributes.index') }}" class="btn btn-danger">
                                            <i class="fa fa-fw fa-lg fa-arrow-left"></i>Go Back
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="tab-pane" id="values">
                    <attribute-values :attributeid="{{ $attribute->id }}"></attribute-values>
                </div>
            </div>
        </div>
    </div>
@endsection


@push('scripts')

<script src="{{ asset('backend/js/app.js') }}"></script>

@endpush
