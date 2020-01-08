@extends('site.app')

@section('title','Checkout')

@section('content')
    <section class="section-pagetop bg-dark">
        <div class="container clearfix">
            <h2 class="title-page">Checkout</h2>
        </div>
    </section>
    <section class="sectoin-content bg padding-y">
        <div class="container">
            <div class="row">
                <div class="col-sm-12">
                    @if(Session::has('error'))
                        <p class="alert alert-danger">{{ Session::get('error') }}</p>
                    @endif
                </div>
            </div>
            <form action="{{ route('checkout.place.order') }}" method="POST">
                @csrf
                <div class="row">
                    <div class="col-md-8">
                        <div class="card">
                            <header class="card-header">
                                <h4 class="card-title mt-2">Billing Details</h4>
                            </header>
                            <article class="card-body">
                                <div class="form-row">
                                    <div class="col form-group">
                                        <label for="first_name" class="control-label">First Name</label>
                                        <input type="text" name="first_name" id="first_name" class="form-control @error('first_name') is-invalid @enderror" value="{{ old('first_name') }}">

                                        @error('first_name')
                                            <span class="invalid-feedback">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="col form-group">
                                        <label for="last_name" class="control-label">Last Name</label>
                                        <input type="text" name="last_name" id="last_name" class="form-control @error('last_name') @enderror" value="{{ old('last_name') }}">

                                        @error('last_name')
                                            <span class="invalid-feedback">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="address" class="control-label">Address</label>
                                    <textarea name="address" id="address" cols="30" rows="4" class="form-control @error('address') is-invalid @enderror">{{ old('address') }}</textarea>
                                    @error('address')
                                        <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="form-row">
                                    <div class="form-group col-md-6">
                                        <label for="city" class="control-label">City</label>
                                        <input type="text" class="form-control @error('city') is-invalid @enderror" name="city" id="city" value="{{ old('city') }}">
                                        @error('city')
                                            <span class="invalid-feedback">{{ $error }}</span>
                                        @enderror
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="country" class="control-label">Country</label>
                                        <input type="text" class="form-control @error('country') is-invalid @enderror" name="country" id="country" value="{{ old('country') }}">
                                        @error('country')
                                            <span class="invalid-feedback">{{ $error }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="form-group col-md-6">
                                        <label for="post_code" class="control-label">Post Code</label>
                                        <input type="text" name="post_code" id="post_code" class="form-control @error('post_code') is-invalid @enderror" value="{{ old('post_code') }}">

                                        @error('post_code')
                                            <span class="invalid-feedback">{{ $error }}</span>
                                        @enderror
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="phone_number" class="control-label">Post Code</label>
                                        <input type="text" name="phone_number" id="phone_number" class="form-control @error('phone_number') is-invalid @enderror" value="{{ old('phone_number') }}">

                                        @error('phone_number')
                                            <span class="invalid-feedback">{{ $error }}</span>
                                        @enderror
                                    </div>

                                </div>
                                <div class="form-group">
                                    <label for="email_address" class="control-label">Email Address</label>
                                    <input type="text" name="email_address" id="email_address" value="{{ old('email_address') }}" class="form-control @error('email_address') is-invalid @enderror">
                                    @error('email_address')
                                        <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="order_notes" class="control-label">Order Notes</label>
                                    <textarea name="order_notes" id="order_notes" cols="30" rows="4" class="form-control @error('order_notes') is-invalid @enderror">{{ old('order_notes') }}</textarea>
                                    @error('order_notes')
                                        <span class="order_notes">{{ $message }}</span>
                                    @enderror
                                </div>
                            </article>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="card">
                                    <header class="card-header">
                                        <h4 class="card-title mt-2">Your Order</h4>
                                    </header>
                                    <article class="card-body">
                                        <dl class="dlist-align">
                                            <dt>Total Cost:</dt>
                                            <dd class="text-right h5 b">
                                                {{ config('settings.currency_symbol') }}{{ Cart::getSubTotal() }}
                                            </dd>
                                        </dl>
                                    </article>
                                </div>
                            </div>
                            <div class="col-md-12 mt-4">
                                <button class="subscribe btn btn-lg btn-success btn-block">Place Order</button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </section>
@stop
