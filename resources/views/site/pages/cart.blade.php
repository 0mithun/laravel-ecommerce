@extends('site.app')

@section('title','Shopping Cart')

@section('content')
    <section class="section pagetop bg-dark">
        <div class="container clearfix">
            <h2 class="title-page">Cart</h2>
        </div>
    </section>
    <section class="section-content bg padding-y header-top">
        <div class="container">
            <div class="row">
                <div class="col-sm-12">
                    @if (session()->has('message'))
                        <p class="alert alert-success">{{  session()->get('message') }}</p>
                    @endif
                </div>
            </div>
            <div class="row">
                <main class="col-sm-9">
                    @if (\Cart::isEmpty())
                        <p class="alert alert-warning">Your shopping cart is empty</p>
                    @else 
                        <div class="card">
                            <table class="table table-hover shopping-cart-wrap">
                                <thead class="text-muted">
                                    <tr>
                                        <th>Product</th>
                                        <th scope="col" width="120">Quantity</th>    
                                        <th scope="col" width="120">Price</th>    
                                        <th scope="col" width="200" class="text-right">Action</th>    
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach (\Cart::getContent() as $item)
                                        <tr>
                                            <td>
                                                <figure class="media">
                                                    <figcaption class="media-body">
                                                        <h6 class="title text-truncate">
                                                            {{ Str::words($item->name, 20) }}
                                                            @foreach ($item->attributes as $key => $value)
                                                                <dl class="dlist-inline small">
                                                                    <dt>{{ ucwords($key) }}</dt>
                                                                    <dd>{{ ucwords($value) }}</dd>
                                                                </dl>
                                                            @endforeach
                                                        </h6>
                                                    </figcaption>
                                                </figure>
                                            </td>
                                            <td>
                                                <var class="price">{{ $item->quantity }}</var>
                                            </td>
                                            <td>
                                                <div class="price-wrap">
                                                    <var class="price">{{ config('settings.currency_symbol').$item->price }}</var>
                                                    <small class="text-muted">each</small>
                                                </div>
                                            </td>
                                            <td class="text-right">
                                                <a href="{{ route('checkout.cart.remove', $item->id) }}" class="btn btn-outline-danger"> <i class="fa fa-times"></i> </a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @endif
                </main>
                <aside class="col-sm-3">
                    <a href="{{ route('checkout.cart.clear') }}" class="btn btn-danger btn-block md-4">Clear Cart</a>
                    <p class="alert alert-success">Add USD 5.00 of eligible items to your order quality for FREE Shipping.</p>
                    <dl class="dlist-align h4">
                        <dt>Total: </dt>
                        <dd class="text-right">
                        <strong>{{ config('settings.currency_symbol') }}{{\Cart::getSubTotal()}} </strong>
                        </dd>
                    </dl>
                    <hr>
                    <figure class="itemside mb-3">
                        <aside class="aside">
                            <img src="{{ asset('frontend/images/icons/pay-visa.png') }}" alt="">
                            <div class="text-wrap small text-muted">
                                Pay 84.78 AED (Save 14.97 AED ) By using ABCD Cards
                            </div>
                        </aside>
                    </figure>
                    <figure class="itemside mb-3">
                        <aside class="aside">
                            <img src="{{ asset('frontend/images/icons/pay-mastercard.png') }}" alt="">
                            <div class="text-wrap small text-muted">
                                Pay by Mastercard and Save 40%.
                                <br>Lorem ipsum dolor sit amet.
                            </div>
                        </aside>
                    </figure>
                <a href="{{ route('checkout.index') }}" class="btn btn-success btn-lg btn-block">Proceed to Checkout</a>
                </aside>
            </div>
        </div>
    </section>
@stop