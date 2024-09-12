@extends('layout.app')

@section('main_title')
    <title>Berapiapi 🔥 | Dashboard</title>
@endsection

@section('page_title')
    <h4 class="f-w-700">Dashboard</h4>
@endsection

@section('breadcrumb')
    <nav>
        <ol class="breadcrumb justify-content-sm-start align-items-center mb-0">
            <li class="breadcrumb-item"><a href="{{ route('dashboard.index') }}"> <i data-feather="home"> </i></a></li>
            <li class="breadcrumb-item f-w-400">Dashboard</li>
        </ol>
    </nav>
@endsection

@section('content')
    @if (!auth()->user()->key_generated)
        <div class="alert alert-light-warning alert-dismissible fade show mb-3" role="alert"><svg
                xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                class="feather feather-bell">
                <path d="M18 8A6 6 0 0 0 6 8c0 7-3 9-3 9h18s-3-2-3-9"></path>
                <path d="M13.73 21a2 2 0 0 1-3.46 0"></path>
            </svg>
            <p>It seems like you haven't created an API key for your account yet.
                <a href="{{ route('key.index') }}">Click here to generate your API key.</a>
            </p>
            <button class="btn-close" type="button" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
    <div class="row widget-grid">
        <div class="col-xl-5 col-md-6 proorder-xl-1 proorder-md-1">
            <div class="card profile-greeting p-0">
                <div class="card-body">
                    <div class="img-overlay">
                        <h1>Good day, {{ auth()->user()->first_name }} {{ auth()->user()->last_name }}</h1>
                        <p>Welcome to the Berapiapi 🔥! We are delighted that you have visited our site and enjoy out APIs.
                        </p>
                        <a class="btn" href="{{ route('hub.index') }}">Go to Hub</a>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xxl-12 col-xl-12 box-col-12 proorder-xl-8 proorder-md-9">
            <div class="card">
                <div class="card-header card-no-border pb-0">
                    <div class="header-top">
                        <h4>API Statistic</h4>
                    </div>
                </div>
                <div class="card-body sale-statistic">
                    <div class="row">
                        <div class="col-4 statistic-icon">
                            <div class="light-card balance-card widget-hover">
                                <div class="icon-box"><img src="/assets/images/dashboard/icon/customers.png" alt="">
                                </div>
                                <div>
                                    <span class="f-w-500 f-light">Hits Left</span>
                                    <h5 class="mt-1 mb-0">498/500</h5>
                                </div>
                            </div>
                        </div>
                        <div class="col-4 statistic-icon">
                            <div class="light-card balance-card widget-hover">
                                <div class="icon-box"><img src="/assets/images/dashboard/icon/revenue.png" alt="">
                                </div>
                                <div>
                                    <span class="f-w-500 f-light">Success</span>
                                    <h5 class="mt-1 mb-0 text-success">95%</h5>
                                </div>
                            </div>
                        </div>
                        <div class="col-4 statistic-icon">
                            <div class="light-card balance-card widget-hover">
                                <div class="icon-box">
                                    <img src="/assets/images/dashboard/icon/profit.png" alt="">
                                </div>
                                <div>
                                    <span class="f-w-500 f-light">Failed</span>
                                    <h5 class="mt-1 mb-0 text-danger">5%</h5>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div id="chart-dash-2-line"></div>
                </div>
            </div>
        </div>
    </div>
@endsection
