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
            <li class="breadcrumb-item f-w-400">Categories</li>
            <li class="breadcrumb-item f-w-400">Create Category</li>
        </ol>
    </nav>
@endsection

@section('content')
    <div class="card">
        <div class="card-header">
            <h4>Create Category</h4>
            <p class="f-m-light mt-1">
                This form is for input new Category on Api Hub
            </p>
        </div>
        <div class="card-body">
            @if (session()->has('error'))
                <div class="alert alert-danger">
                    {{ session('error') }}
                </div>
            @endif
            <form class="row g-3 needs-validation custom-input" action="{{ route('category.store') }}" method="POST">
                @csrf
                <div class="col-md-12 position-relative">
                    <label class="form-label" for="category">Category Name</label>
                    <input class="form-control @error('category') is-invalid @enderror" id="category" type="text"
                        name="category" placeholder="Ex. Entertainment">
                    @error('category')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <div class="col-md-12 position-relative">
                    <label class="form-label" for="category">Category Color</label>
                    <select class="form-control @error('color') is-invalid @enderror" id="color" name="color">
                        <option value="">-- Select --</option>
                        <option value="primary">Primary</option>
                        <option value="success">Success</option>
                        <option value="warning">Warning</option>
                        <option value="danger">Danger</option>
                    </select>
                    @error('color')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <div class="col-12">
                    <button class="btn btn-primary" type="submit">Create</button>
                </div>
            </form>
        </div>
    </div>
@endsection
