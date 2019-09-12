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
                </ul>
            </div>
        </div>
        <div class="col-md-9">
            <div class="tab-content">
                <div class="tab-pane active" id="general">
                    <div class="tile">
                        <form action="{{ route('admin.attributes.store') }}" method="POST">
                            @csrf
                            <h3 class="page-title">Attribute Information</h3>
                            <hr>
                            <div class="tile-body">
                                <div class="form-group">
                                    <label for="code" class="control-label">Code</label>
                                    <input type="text" class="form-control  @error('code') is-invalid @enderror" name="code" id="code" value="{{ old('code') }}" placeholder="Enter attribute code">
                                    @error('code')
                                        <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="code" class="control-label">Name</label>
                                    <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" id="name" value="{{ old('name') }}" placeholder="Enter attribute name">
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
                                        <option value="" selected disabled>Select Frontend Type</option>
                                        @foreach($types as $key => $value)
                                            <option value="{{ $key }}">{{ $value }}</option>
                                        @endforeach
                                    </select>
                                    @error('frontend_type')
                                        <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <div class="form-check">
                                        <label class="form-check-label">
                                            <input type="checkbox" name="is_filterable" id="is_filterable" class="form-check-input"> Filterable
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <label class="form-check-label">
                                            <input type="checkbox" name="is_required" id="is_required" class="form-check-input"> Required
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <div class="tile-footer">
                                <div class="row d-print-none mt-2">
                                    <div class="col-12 text-right">
                                        <button class="btn btn-success" type="submit">
                                            <i class="fa fa-fw fa-lg fa-check-circle"></i>Save Attribute
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
            </div>
        </div>
    </div>
@endsection
