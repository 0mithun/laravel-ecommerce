@extends('site.app')
@section('title','Register')

@section('content')
    <section class="section-pagetop bg-dark">
        <div class="container clearfix">
            <h2 class="title-page">Register</h2>
        </div>
    </section>
    <section class="section-content bg padding-y">
        <div class="container">
            <div class="col-md-6 mx-auto">
                <div class="card">
                    <header class="card-header">
                        <h4 class="card-title mt-2">Sign Up</h4>
                    </header>
                    <article class="card-body">
                        <form action="{{ route('register') }}" method="POST">
                            @csrf
                            <div class="form-row">
                                <div class="col form-group">
                                    <label for="first_name">First Name</label>
                                    <input type="text" name="first_name" id="first_name" placeholder="Enter your first name" value="{{ old('first_name') }}" class="form-control @error('first_name') is-invalid @enderror">

                                    @error('first_name')
                                        <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="col form-group">
                                    <label for="last_name">First Name</label>
                                    <input type="text" name="last_name" id="last_name" placeholder="Enter your last name" value="{{ old('last_name') }}" class="form-control @error('last_name') is-invalid @enderror">

                                    @error('last_name')
                                        <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="email">E-Mail Address</label>
                                <input type="text" name="email" id="email" placeholder="Enter your email addrss" value="{{ old('email') }}" class="form-control @error('email') is-invalid @enderror">

                                @error('email')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="password">Password</label>
                                <input type="password" name="password" id="password" placeholder="Enter your password addrss" class="form-control @error('password') is-invalid @enderror">

                                @error('password')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="password_confirmation">Confirm Password</label>
                                <input type="password" name="password_confirmation" id="password_confirmation" placeholder="Enter password again" class="form-control @error('password_confirmation') is-invalid @enderror">

                                @error('password_confirmation')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="address">Address</label>
                                <input type="text" name="address" id="address" placeholder="Enter your address" class="form-control @error('address') is-invalid @enderror">

                                @error('address')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="city">City</label>
                                    <input type="text" name="city" id="text" placeholder="Enter your city" value="{{ old('city') }}" class="form-control
                                    @error('city') is-invalid @enderror">

                                    @error('city')
                                        <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="country">Country</label>
                                    <select name="country" id="country" class="form-control">
                                        <option>Choose...</option>
                                        <option value="bandladesh" selected>Bangladesh</option>
                                        <option value="india">India</option>
                                        <option value="pakistan">Pakistan</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <button class="btn btn-success btn-block">Sign Up</button>
                            </div>
                            <small class="text-muted">By clicking the sign 'Sign Up' button, you confirm that you accept you accept our <br> Terms of use and Privacy Policy.</small>
                        </form>
                    </article>
                    <div class="border-top card-body text-center">Have an account ? <a href="{{ route('login') }}">Log In</a></div>
                </div>
            </div>
        </div>
    </section>

@stop
