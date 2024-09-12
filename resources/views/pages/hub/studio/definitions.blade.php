@extends('layout.app')

@section('main_title')
    <title>Berapiapi 🔥 | Hub Studio</title>
@endsection

@section('page_title')
    <h4 class="f-w-700">Hub Studio</h4>
@endsection

@section('breadcrumb')
    <nav>
        <ol class="breadcrumb justify-content-sm-start align-items-center mb-0">
            <li class="breadcrumb-item"><a href="{{ route('dashboard.index') }}"> <i data-feather="home"> </i></a></li>
            <li class="breadcrumb-item f-w-400">Headquarter</li>
            <li class="breadcrumb-item f-w-400">Hub Studio</li>
        </ol>
    </nav>
@endsection

@section('content')
    @include('pages.hub.studio._menu')

    @livewire('table.hub.definition.lists', ['id' => $hub->id])
    @livewire('modal.hub.definition.create')
    @livewire('modal.hub.definition.edit')
@endsection
