<header class="section-header">
    <section class="header-main">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-3">
                    <div class="brand-wrap">
                        <a href="{{ url('/') }}">
                            <img class="logo" src="{{ asset('frontend/images/logo-dark.png') }}" alt="">
                        </a>
                    </div>
                </div>
                <div class="col-lg-6 col-sm-6">
                    <form action="#" class="search-wrap">
                        <div class="input-group">
                            <input type="text" class="form-control" placeholder="Search">
                            <div class="input-group-append">
                                <button class="btn btn-primary" type="submit">
                                    <i class="fa fa-search"></i>
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="col-lg-3 col-sm-6">
                    <div class="widgets-wrap d-flex justify-content-end ">
                        <div class="widget-header mr-0">

                        <a href="{{ route('checkout.cart') }}" class="icontext">
                                <div class="icon-wrap  round text-secondary ">
                                    <i class="fa fa-shopping-cart"></i>
                                </div>
                                <div class="text-wrap">
                                    <small>{{ $cartCount }} Items</small>
                                </div>
                            </a>
                        </div>

                        @guest
                            <div class="widget-header">
                                <a href="{{ route('login') }}" class="ml-3 icontext">
                                    <div class="icon-wrap icon-xs bg-primary round text-white">
                                        <i class="fa fa-user"></i>
                                    </div>
                                    <div class="text-wrap"><span>login</span></div>
                                </a>
                            </div>
                            <div class="widget-header">
                                <a href="{{ route('register') }}" class="ml-3 icontext">
                                    <div class="icon-wrap icon-xs bg-primary round text-white">
                                        <i class="fa fa-user"></i>
                                    </div>
                                    <div class="text-wrap"><span>Register</span></div>
                                </a>
                            </div>
                        @else

                            <ul class="navbar-nav ml-auto">
                                <li class="nav-item dropdown">
                                    <a href="#" class="nav-link dropdown-toggle" id="navbarDropdown" data-toggle="dropdown" v-pre>
                                        {{ Auth::user()->full_name }} <span class="caret"></span>
                                    </a>
                                    <div class="dropdown-menu dropdown-menu-right">
                                        <a href="{{ route('account.orders') }}" class="dropdown-item">Orders</a>
                                        <a href="{{ route('logout') }}" class="dropdown-item" onclick="event.preventDefault();document.getElementById('logout-form').submit();">
                                            {{ __('Logout') }}
                                        </a>
                                        <form action="{{ route('logout') }}" id="logout-form" method="POST" style="display: none">
                                            @csrf
                                        </form>
                                    </div>
                                </li>
                            </ul>
                        @endguest
                    </div>
                </div>
            </div>
        </div>
    </section>
    @include('site.partials.nav')
</header>
