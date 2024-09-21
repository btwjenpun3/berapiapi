@extends('layout.app')

@section('css')
    <style>
        pre {
            overflow: auto;
            padding: 5px;
            max-height: 60vh;
        }
    </style>
@endsection

@section('main_title')
    <title>Berapiapi 🔥 | Playground</title>
@endsection

@section('page_title')
    <h4 class="f-w-700">Playground</h4>
@endsection

@section('breadcrumb')
    <nav>
        <ol class="breadcrumb justify-content-sm-start align-items-center mb-0">
            <li class="breadcrumb-item"><a href="{{ route('dashboard.index') }}"> <i data-feather="home"> </i></a></li>
            <li class="breadcrumb-item f-w-400"><a href="{{ route('hub.index') }}">Hub</a></li>
            <li class="breadcrumb-item f-w-400">Playground</li>
            <li class="breadcrumb-item f-w-400">{{ $hub->title }}</li>
        </ol>
    </nav>
@endsection

@section('content')
    <div class="row">
        @livewire('content.hub.playground.side-menu', ['hub' => $hub])
        @livewire('content.hub.playground.endpoint')
    </div>
@endsection
