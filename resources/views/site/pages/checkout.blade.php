@extends('site.app')

@section('title','Checkout')

@section('content')
    <section class="section-pagetop bg-dark">
        <div class="container clearfix">
            <h2 class="title-page">Checkout</h2>
        </div>
    </section>
    <section class="section-content bg padding-y">
        <div class="container">
            <div class="row">
                <div class="col-sm-12">
                    @if (session()->has('error'))
                        <p class="alert alert-danger">{{ session()->get('error') }}</p>
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
                                        <label>First Name</label>
                                        <input type="text" name="first_name" class="form-control">
                                    </div>
        
                                    <div class="col form-group">
                                        <label>Last Name</label>
                                        <input type="text" name="last_name" class="form-control">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label >Address</label>
                                    <input type="text" class="form-control" name="address">
                                </div>
                                <div class="form-row">
                                    <div class="col-md-6 form-group">
                                        <label>City</label>
                                        <input type="text" name="city" class="form-control">
                                    </div>
                                    <div class="col-md-6 form-group">
                                        <label>Country</label>
                                        <input type="text" name="country" class="form-control">
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="col-md-6 form-group">
                                        <label>Post Code</label>
                                        <input type="text" name="post_code" class="form-control">
                                    </div>
                                    <div class="col-md-6 form-group">
                                        <label>Phone Number</label>
                                        <input type="text" name="phone_number" class="form-control">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label>Email Address</label>
                                    <input type="email" name="email" id="email" class="form-control" value="{{ auth()->user()->email  }}" disabled>
                                    <span class="form-text text-muted">We'll never share your email </span>
                                </div>
                                
                                <div class="form-group">
                                    <label>Order Notes</label>
                                    <textarea name="notes" id="order_notes" cols="30" rows="3" class="form-control"></textarea>
                                </div>
                                
                            </article>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="card">
                                    <div class="card-header">
                                        <h4 class="title card-title mt-2">Your Order</h4>
                                    </div>
                                    <div class="card-body">
                                        <dl class="dlist-align">
                                            <dt>Total Cost: </dt>
                                            <dd class="text-right h5 b">{{ config('settings.currency_symbol') }}{{ \Cart::getSubTotal() }}</dd>
                                        </dl>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12 mt-4">
                                <button class="btn btn-lg btn-block btn-success subscribe" type="submit">Place Order</button>
                            </div>
                        </div>
                    </div>
                </div>
                
            </form>
        </div>
    </section>
@stop