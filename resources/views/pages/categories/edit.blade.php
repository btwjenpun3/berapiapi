@extends('layout.app')

@section('main_title')
    <title>Berapiapi 🔥 | Edit Category</title>
@endsection

@section('page_title')
    <h4 class="f-w-700">Edit Category</h4>
@endsection

@section('breadcrumb')
    <nav>
        <ol class="breadcrumb justify-content-sm-start align-items-center mb-0">
            <li class="breadcrumb-item"><a href="{{ route('dashboard.index') }}"> <i data-feather="home"> </i></a></li>
            <li class="breadcrumb-item f-w-400">Categories</li>
            <li class="breadcrumb-item f-w-400">Edit Category</li>
        </ol>
    </nav>
@endsection

@section('content')
    <div class="card">
        <div class="card-header">
            <h4>Edit Category</h4>
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
            <form class="row g-3 needs-validation custom-input"
                action="{{ route('category.update', ['slug' => $category->slug]) }}" method="POST">
                @csrf
                <div class="col-md-12 position-relative">
                    <label class="form-label" for="category">Category Name</label>
                    <input class="form-control @error('category') is-invalid @enderror" id="category" type="text"
                        name="category" placeholder="Ex. Entertainment" value={{ $category->name }}>
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
                        <option value="primary" @if ($category->color === 'primary') selected @endif>Primary</option>
                        <option value="success" @if ($category->color === 'success') selected @endif>Success</option>
                        <option value="warning" @if ($category->color === 'warning') selected @endif>Warning</option>
                        <option value="danger" @if ($category->color === 'danger') selected @endif>Danger</option>
                    </select>
                    @error('color')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <div class="col-12">
                    <div class="d-flex justify-content-between">
                        <button class="btn btn-primary" type="submit">Update</button>
                        <button class="btn btn-danger" type="button" data-bs-toggle="modal" data-bs-target="#delete-modal">
                            Delete
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="delete-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenter1"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-body">
                    <div class="modal-toggle-wrapper">
                        <ul class="modal-img">
                            <li> <img src="/assets/images/gif/danger.gif" alt="error"></li>
                        </ul>
                        <h4 class="text-center pb-2">Are you sure ?</h4>
                        <p class="text-center">
                            Once you delete this category, maybe you will lose all of Hub for this category!
                        </p>
                        <div class="d-flex justify-content-between">
                            <form action="{{ route('category.delete', ['slug' => $category->slug]) }}" method="POST">
                                @csrf
                                @method('delete')
                                <button class="btn btn-danger" type="submit">
                                    Delete
                                </button>
                            </form>
                            <button class="btn btn-secondary" type="button" data-bs-dismiss="modal">
                                Close
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
