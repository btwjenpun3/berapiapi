<div>
    <div class="card">
        <div class="card-header">
            <div class="d-flex justify-content-between">
                <div>
                    <h4>Definitions</h4>
                    <span>This is List Table for <code>Hub Definitions</code></span>
                </div>
                <div>
                    <button class="btn btn-primary" wire:click='create({{ $hubId }})' wire:loading.attr='disabled'>
                        <i class="fa fa-plus ms-0 me-3"></i>
                        Create Endpoint
                    </button>
                </div>
            </div>
        </div>
        <div class="table-responsive theme-scrollbar signal-table">
            <table class="table table-hover">
                <thead class="table-light">
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Name</th>
                        <th scope="col">Method</th>
                        <th scope="col">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @if (count($definitions) > 0)
                        @foreach ($definitions as $definition)
                            <tr wire:key='defintion-{{ $definition->id }}'>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $definition->name }}</td>
                                <td>{{ $definition->method }}</td>
                                <td>
                                    <div class="d-flex justify-content-start">
                                        <button class="btn btn-outline-primary"
                                            wire:click='edit({{ $definition->id }})'>
                                            Edit
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    @else
                        <tr>
                            <td colspan="5" class="text-center">
                                <i>No Endpoint found</i>
                            </td>
                        </tr>
                    @endif
                </tbody>
            </table>
        </div>
    </div>
</div>
