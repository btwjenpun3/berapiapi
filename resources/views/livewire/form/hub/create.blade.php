<div>
    <div class="card">
        <div class="card-header">
            <h4>Create Hub</h4>
            <p class="f-m-light mt-1">
                You may create a new Api Hub using this form
            </p>
        </div>
        <div class="card-body">
            <div id="error" wire:ignore></div>
            <div class="card-wrapper border rounded-3">
                <form class="row g-3" wire:submit='submit'>
                    <div class="col-md-12">
                        <label class="form-label" for="title">Title</label>
                        <input class="form-control @error('title') is-invalid @enderror" id="title" type="text"
                            placeholder="Hub title" wire:model='title'>
                        @error('title')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="col-md-12">
                        <label class="form-label" for="endpoint">Endpoint</label>
                        <input class="form-control @error('endpoint') is-invalid @enderror" id="endpoint"
                            type="text" placeholder="Hub endpoint" wire:model='endpoint'>
                        @error('endpoint')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="col-md-12">
                        <label class="form-label" for="category">Category</label>
                        <select class="form-select @error('category') is-invalid @enderror" id="category"
                            wire:model='category'>
                            <option value="">-- Select --</option>
                            @foreach ($categories as $category)
                                <option value="{{ $category->slug }}">{{ $category->name }}</option>
                            @endforeach
                        </select>
                        @error('category')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="col-md-12">
                        <label class="form-label" for="description">Description</label>
                        <input class="form-control @error('description') is-invalid @enderror" id="description"
                            type="text" placeholder="Hub description" wire:model='description'>
                        @error('description')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="col-md-12">
                        <label class="form-label" for="price">Price</label>
                        <select class="form-select @error('price') is-invalid @enderror" id="price"
                            wire:model='price'>
                            <option value="">-- Select --</option>
                            <option value="free">Free</option>
                        </select>
                        @error('price')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="col-md-12">
                        <label class="form-label" for="resultLogging">Result Logging</label>
                        <select class="form-select @error('resultLogging') is-invalid @enderror" id="resultLogging"
                            wire:model='resultLogging'>
                            <option value="">-- Select --</option>
                            <option value="1">Yes</option>
                            <option value="0">No</option>
                        </select>
                        @error('resultLogging')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="col-12">
                        <button class="btn btn-primary" type="submit">
                            Create Hub
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    @script
        <script>
            $wire.on('error', (message) => {
                $('#error').html(`
                <div class="alert alert-danger dark mb-3" role="alert">
                    ` + message + `
                </div>
            `);
            })
        </script>
    @endscript
</div>
