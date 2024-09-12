@extends('layout.app')

@section('main_title')
    <title>Berapiapi 🔥 | Hub List</title>
@endsection

@section('page_title')
    <h4 class="f-w-700">Hub List</h4>
@endsection

@section('breadcrumb')
    <nav>
        <ol class="breadcrumb justify-content-sm-start align-items-center mb-0">
            <li class="breadcrumb-item"><a href="{{ route('dashboard.index') }}"> <i data-feather="home"> </i></a></li>
            <li class="breadcrumb-item f-w-400">Headquarter</li>
            <li class="breadcrumb-item f-w-400">Hub List</li>
        </ol>
    </nav>
@endsection

@section('content')
    <div class="card">
        <div class="card-header">
            <h4>Hub List</h4>
            <span>This is List Table for <code>Hub</code> already created</span>
        </div>
        @if (session()->has('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif
        <div class="table-responsive theme-scrollbar signal-table">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Title</th>
                        <th scope="col">Slug</th>
                        <th scope="col">Category</th>
                        <th scope="col"></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($hubs as $hub)
                        <tr>
                            <th scope="row">{{ $loop->iteration }}</th>
                            <td>{{ $hub->title }}</td>
                            <td>{{ $hub->slug }}</td>
                            <td>
                                <span class="badge rounded-pill badge-{{ $hub->category->color }}">
                                    {{ $hub->category->name }}
                                </span>
                            </td>
                            <td>
                                <a href="{{ route('hub.definitions', ['slug' => $hub->slug]) }}">
                                    <button class="btn btn-pill btn-success">
                                        Go to Studio
                                    </button>
                                </a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
