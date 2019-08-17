@extends('admin.app')

@section('title')
    {{ $pageTitle }}
@endsection

@section('content')
    <div class="app-title">
        <div>
            <h1><i class="fa fa-cogs"> {{ $pageTitle }}</i></h1>
        </div>
    </div>
    @include('admin.partials.flash')
    <div class="row user">
        <div class="col-md-3">
            <div class="tile p-0">
                <ul class="nav flex-column nav-tabs user-tabs">
                    <li class="nav-item"><a href="#general" class="nav-link active" data-toggle="tab">General</a></li>
                    <li class="nav-item"><a href="#site-logo" class="nav-link" data-toggle="tab">Site Logo</a></li>
                    <li class="nav-item"><a href="#footer-seo" class="nav-link" data-toggle="tab">Footer &amp; SEO</a></li>
                    <li class="nav-item"><a href="#social-links" class="nav-link" data-toggle="tab">Social Links</a></li>
                    <li class="nav-item"><a href="#analytics" class="nav-link" data-toggle="tab">Analytics</a></li>
                    <li class="nav-item"><a href="#payments" class="nav-link" data-toggle="tab">Payments</a></li>
                </ul>
            </div>
        </div>
        <div class="col-md-9">
            <div class="tab-content">
                <div class="tab-pane active" id="general">
                   @include('admin.settings.includes.general')
                </div>
                <div class="tab-pane fade" id="site-logo">
                   @include('admin.settings.includes.logo')
                </div>
                <div class="tab-pane fade" id="footer-seo">
                   @include('admin.settings.includes.footer_seo')
                </div>
                <div class="tab-pane fade" id="social-links">
                   @include('admin.settings.includes.social_links')
                </div>
                <div class="tab-pane fade" id="analytics">
                   @include('admin.settings.includes.analytics')
                </div>
                <div class="tab-pane fade" id="payments">
                   @include('admin.settings.includes.payments')
                </div>
            </div>
        </div>
    </div>
@endsection
