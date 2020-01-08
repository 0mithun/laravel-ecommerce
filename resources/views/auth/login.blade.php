@extends('site.app')

@section('title','Login')

@section('content')
    <section class="section-pagetop bg-dark">
        <div class="container clearfix">
            <h2 class="title-page">Login</h2>
        </div>
    </section>
    <section class="section-content bg padding-y">
        <div class="container">
            <div class="col-md-6 mx-auto">
                <div class="card">
                    <header class="card-header">
                        <h4 class="card-title mt-2">Sign In</h4>
                    </header>
                    <article class="card-body">
                        <form action="{{ route('login') }}" method="POST">
                            @csrf

                            <div class="form-group">
                                <label for="email">E-Mail Address</label>
                                <input type="text" class="form-control @error('email') is-invalid @enderror" name="email" id="email" placeholder="Enter your email" value="{{ old('email') }}">
                                @error('email')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="email">Password</label>
                                <input type="password" class="form-control @error('password') is-invalid @enderror" name="password" id="password" placeholder="Enter your password" value="{{ old('password') }}">
                                @error('password')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group row mr-auto">
                                <div class="col-md-6">
                                    <div class="form-check">
                                        <input type="checkbox" name="remember" id="remember" class="form-check-input" {{ old('remember') ? 'checked': '' }}>
                                        <label for="remember" class="form-check-label">{{ __('Remember Me') }}</label>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <button class="btn btn-success btn-block">Login</button>
                            </div>
                        </form>
                    </article>
                    <div class="border-top card-body text-center">Don't have an account? <a href="{{ route('register') }}">Sign Up</a></div>
                </div>
            </div>
        </div>
    </section>
@stop
