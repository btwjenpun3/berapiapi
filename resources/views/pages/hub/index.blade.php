@extends('layout.app')

@section('main_title')
    <title>Berapiapi 🔥 | Hub</title>
@endsection

@section('page_title')
    <h4 class="f-w-700">Hub</h4>
@endsection

@section('breadcrumb')
    <nav>
        <ol class="breadcrumb justify-content-sm-start align-items-center mb-0">
            <li class="breadcrumb-item"><a href="{{ route('dashboard.index') }}"> <i data-feather="home"> </i></a></li>
            <li class="breadcrumb-item f-w-400">Hub</li>
        </ol>
    </nav>
@endsection

@section('content')
    <div class="card">
        <div class="card-body">
            <div class="tab-content" id="top-tabContent">
                <div class="tab-pane fade show active" id="top-home" role="tabpanel" aria-labelledby="top-home-tab">
                    <div class="row">
                        @foreach ($hubs as $hub)
                            <div class="col-xxl-4 col-lg-4 col-md-6">
                                <div class="project-box b-light1-{{ $hub->category->color }}"><span
                                        class="badge badge-{{ $hub->category->color }}">{{ $hub->category->name }}</span>
                                    <h5 class="f-w-500">{{ $hub->title }}</h5>
                                    <div class="d-flex">
                                        <img class="img-20 me-1 rounded-circle" src="/assets/images/user/3.jpg"
                                            alt="" data-original-title="" title="">
                                        <div class="flex-grow-1">
                                            <p>by : Berapiapi</p>
                                        </div>
                                    </div>
                                    <p>{{ $hub->description }}</p>
                                    <div class="row details">
                                        <div class="col-6"><span>Price </span></div>
                                        <div class="col-6 font-primary">
                                            <i>Free</i>
                                        </div>
                                        <div class="col-6"> <span>Result Logging</span></div>
                                        <div class="col-6 font-primary">
                                            @switch($hub->result_logging)
                                                @case(0)
                                                    No
                                                @break

                                                @case(1)
                                                    Yes
                                                @break

                                                @default
                                            @endswitch
                                        </div>
                                        <div class="col-6"> <span>Rating</span></div>
                                        <div class="col-6 font-primary">
                                            <div class="stars" style="color:orange">
                                                <label class="star-1 fa fa-star" for="star-1"></label>
                                                <label class="star-2 fa fa-star" for="star-2"></label>
                                                <label class="star-3 fa fa-star" for="star-3"></label>
                                                <label class="star-4 fa fa-star-o" for="star-4"></label>
                                                <label class="star-5 fa fa-star-o" for="star-5"></label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="d-flex justify-content-end mb-0">
                                        <button class="btn btn-success">
                                            Subscribe
                                        </button>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
