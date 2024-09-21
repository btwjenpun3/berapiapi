<div>
    <!-- Create Endpoint Modal-->
    <div class="modal fade" id="create-modal" tabindex="-1" aria-labelledby="fullScreenModalLabel" aria-hidden="true"
        wire:ignore.self>
        <div class="modal-dialog modal-fullscreen">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="fullScreenModalLabel">Create Endpoint</h1>
                    <button class="btn-close py-0" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body dark-modal bg-light">
                    <div class="card mt-3">
                        <div class="card-header">
                            <h3>Create your Endpoint</h3>
                            <p class="f-m-light mt-1">
                                When publishing an API version to the Hub, you can either manually edit definitions
                            </p>
                        </div>
                        <div class="card-body bg-light-secondary">
                            <div class="row">
                                <div class="col-md-6">
                                    <input type="text" class="form-control @error('name') is-invalid @enderror"
                                        placeholder="Name your endpoint" wire:model='name'>
                                    @error('name')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="row mt-3">
                                <div class="col-md-4">
                                    <select class="form-select @error('method') is-invalid @enderror"
                                        wire:model='method' wire:change='changeMethod($event.target.value)'>
                                        <option value="GET">GET</option>
                                        <option value="POST">POST</option>
                                    </select>
                                    @error('method')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="col-md-8">
                                    <div class="input-group">
                                        <span class="input-group-text" id="basic-addon1">/</span>
                                        <input class="form-control @error('endpoint') is-invalid @enderror"
                                            type="text" placeholder="Specify the endpoint path relative to base URL"
                                            wire:model.lazy='endpoint'>
                                    </div>
                                    <small class="text-dark">
                                        <i>use {curly braces} to indicate path parameters if needed. e.g.,
                                            /employees/{id}</i>
                                    </small>
                                    @error('endpoint')
                                        <div class="is-invalid text-danger">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>

                            <div class="card mt-3">
                                <div class="card-body bottom-border-tab">
                                    <ul class="nav nav-tabs border-tab mb-0" id="bottom-tab" role="tablist">
                                        <li class="nav-item">
                                            <button class="nav-link nav-border txt-info tab-info pt-0" id="path-tab"
                                                data-bs-toggle="tab" href="#path" role="tab" aria-controls="path"
                                                aria-selected="true" wire:ignore.self>
                                                Path Parameter
                                            </button>
                                        </li>
                                        <li class="nav-item">
                                            <button class="nav-link nav-border txt-info tab-info pt-0" id="headers-tab"
                                                data-bs-toggle="tab" href="#headers" role="tab"
                                                aria-controls="headers" aria-selected="true" wire:ignore.self>
                                                Headers
                                            </button>
                                        </li>
                                        <li class="nav-item">
                                            <button class="nav-link nav-border txt-info tab-info pt-0 active"
                                                id="query-tab" data-bs-toggle="tab" href="#query" role="tab"
                                                aria-controls="query" aria-selected="true" wire:ignore.self>
                                                Query
                                            </button>
                                        </li>
                                        <li class="nav-item">
                                            <button class="nav-link nav-border txt-info tab-info pt-0" id="body-tab"
                                                data-bs-toggle="tab" href="#body" role="tab" aria-controls="body"
                                                aria-selected="true" wire:ignore.self>
                                                Body
                                            </button>
                                        </li>
                                    </ul>
                                    <div class="tab-content" id="bottom-tabContent">
                                        <div class="tab-pane fade" id="path" role="tabpanel"
                                            aria-labelledby="path-tab" wire:ignore.self>
                                            <div class="table-responsive theme-scrollbar signal-table table-vcenter">
                                                @if ($showPathParameter)
                                                    <table class="table table-hover">
                                                        <thead>
                                                            <tr>
                                                                <th scope="col">Name</th>
                                                                <th scope="col">Type</th>
                                                                <th scope="col">Default Value</th>
                                                                <th scope="col">Required</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            @foreach ($pathParameters as $key => $pathParameter)
                                                                <tr wire:key='path-create-{{ $key }}'>
                                                                    <td>
                                                                        <input type="text"
                                                                            class="form-control @error('pathParameters.' . $key . '.parameter') is-invalid @enderror"
                                                                            placeholder="Insert valid parameter name"
                                                                            wire:model='pathParameters.{{ $key }}.parameter'
                                                                            disabled>
                                                                    </td>
                                                                    <td>
                                                                        <select class="form-select"
                                                                            wire:model='pathParameters.{{ $key }}.type'>
                                                                            <option value="string">STRING</option>
                                                                            <option value="number">NUMBER</option>
                                                                            <option value="boolean">BOOLEAN</option>
                                                                        </select>
                                                                    </td>
                                                                    <td>
                                                                        <input type="text"
                                                                            class="form-control @error('pathParameters.' . $key . '.value') is-invalid @enderror"
                                                                            placeholder="Value"
                                                                            wire:model='pathParameters.{{ $key }}.value'>
                                                                    </td>
                                                                    <td>
                                                                        <div
                                                                            class="text-start icon-state switch-outline">
                                                                            <label class="switch mb-0">
                                                                                <input type="checkbox"
                                                                                    wire:model='pathParameters.{{ $key }}.required'>
                                                                                <span
                                                                                    class="switch-state bg-secondary">
                                                                                </span>
                                                                            </label>
                                                                        </div>
                                                                    </td>
                                                                </tr>
                                                            @endforeach
                                                        </tbody>
                                                    </table>
                                                @else
                                                    <p class="mt-3">
                                                        No Path Parameter found
                                                    </p>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                    <div class="tab-content" id="bottom-tabContent">
                                        <div class="tab-pane fade" id="headers" role="tabpanel"
                                            aria-labelledby="headers-tab" wire:ignore.self>
                                            <div class="table-responsive theme-scrollbar signal-table table-vcenter">
                                                <table class="table table-hover">
                                                    <thead>
                                                        <tr>
                                                            <th scope="col">Name</th>
                                                            <th scope="col">Type</th>
                                                            <th scope="col">Default Value</th>
                                                            <th scope="col">Required</th>
                                                            <th scope="col">Actions</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @foreach ($headers as $key => $header)
                                                            <tr wire:key='query-create-{{ $key }}'>
                                                                <td>
                                                                    <input type="text"
                                                                        class="form-control @error('headers.' . $key . '.parameter') is-invalid @enderror"
                                                                        placeholder="Insert valid parameter name"
                                                                        wire:model='headers.{{ $key }}.parameter'>
                                                                </td>
                                                                <td>
                                                                    <select class="form-select"
                                                                        wire:model='headers.{{ $key }}.type'>
                                                                        <option value="string">STRING</option>
                                                                        <option value="number">NUMBER</option>
                                                                        <option value="boolean">BOOLEAN</option>
                                                                    </select>
                                                                </td>
                                                                <td>
                                                                    <input type="text"
                                                                        class="form-control @error('headers.' . $key . '.value') is-invalid @enderror"
                                                                        placeholder="Value"
                                                                        wire:model='headers.{{ $key }}.value'>
                                                                </td>
                                                                <td>
                                                                    <div class="text-start icon-state switch-outline">
                                                                        <label class="switch mb-0">
                                                                            <input type="checkbox"
                                                                                wire:model='headers.{{ $key }}.required'>
                                                                            <span class="switch-state bg-secondary">
                                                                            </span>
                                                                        </label>
                                                                    </div>
                                                                </td>
                                                                <td>
                                                                    <div class="d-flex justify-content-start">
                                                                        @if ($loop->last)
                                                                            <button
                                                                                class="btn btn-outline-success btn-sm b-r-8 me-3"
                                                                                wire:click='addHeader({{ $key }})'>
                                                                                Add Header
                                                                            </button>
                                                                        @endif
                                                                        @if (count($headers) > 1)
                                                                            <button
                                                                                class="btn btn-outline-warning btn-sm b-r-8"
                                                                                wire:click='removeHeader({{ $key }})'>
                                                                                Delete
                                                                            </button>
                                                                        @endif
                                                                    </div>
                                                                </td>
                                                            </tr>
                                                        @endforeach
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="tab-content" id="bottom-tabContent">
                                        <div class="tab-pane fade show active" id="query" role="tabpanel"
                                            aria-labelledby="query-tab" wire:ignore.self>
                                            <div class="table-responsive theme-scrollbar signal-table table-vcenter">
                                                <table class="table table-hover">
                                                    <thead>
                                                        <tr>
                                                            <th scope="col">Name</th>
                                                            <th scope="col">Type</th>
                                                            <th scope="col">Default Value</th>
                                                            <th scope="col">Required</th>
                                                            <th scope="col">Actions</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @foreach ($queries as $key => $query)
                                                            <tr wire:key='query-create-{{ $key }}'>
                                                                <td>
                                                                    <input type="text"
                                                                        class="form-control @error('queries.' . $key . '.parameter') is-invalid @enderror"
                                                                        placeholder="Insert valid parameter name"
                                                                        wire:model='queries.{{ $key }}.parameter'>
                                                                </td>
                                                                <td>
                                                                    <select class="form-select"
                                                                        wire:model='queries.{{ $key }}.type'>
                                                                        <option value="string">STRING</option>
                                                                        <option value="number">NUMBER</option>
                                                                        <option value="boolean">BOOLEAN</option>
                                                                    </select>
                                                                </td>
                                                                <td>
                                                                    <input type="text"
                                                                        class="form-control @error('queries.' . $key . '.value') is-invalid @enderror"
                                                                        placeholder="Value"
                                                                        wire:model='queries.{{ $key }}.value'>
                                                                </td>
                                                                <td>
                                                                    <div class="text-start icon-state switch-outline">
                                                                        <label class="switch mb-0">
                                                                            <input type="checkbox"
                                                                                wire:model='queries.{{ $key }}.required'>
                                                                            <span class="switch-state bg-secondary">
                                                                            </span>
                                                                        </label>
                                                                    </div>
                                                                </td>
                                                                <td>
                                                                    <div class="d-flex justify-content-start">
                                                                        @if ($loop->last)
                                                                            <button
                                                                                class="btn btn-outline-success btn-sm b-r-8 me-3"
                                                                                wire:click='addQuery({{ $key }})'>
                                                                                Add Query
                                                                            </button>
                                                                        @endif
                                                                        @if (count($queries) > 1)
                                                                            <button
                                                                                class="btn btn-outline-warning btn-sm b-r-8"
                                                                                wire:click='removeQuery({{ $key }})'>
                                                                                Delete
                                                                            </button>
                                                                        @endif
                                                                    </div>
                                                                </td>
                                                            </tr>
                                                        @endforeach
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="tab-content" id="bottom-tabContent">
                                        <div class="tab-pane fade" id="body" role="tabpanel"
                                            aria-labelledby="body-tab" wire:ignore.self>
                                            <div class="table-responsive theme-scrollbar signal-table table-vcenter">
                                                @switch($method)
                                                    @case('GET')
                                                        <p class="mt-3">
                                                            <i>
                                                                Body parameters and body modal is not permitted for GET
                                                                method
                                                            </i>
                                                        </p>
                                                    @break

                                                    @case('POST')
                                                        <p class="mt-3">
                                                            <i>
                                                                POST Method Under Maintenance
                                                            </i>
                                                        </p>
                                                    @break

                                                    @default
                                                @endswitch

                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="text-end mt-0">
                                <button class="btn btn-success" type="button" wire:click='save'
                                    wire:loading.attr='disabled'>
                                    <i class="fa fa-save me-2"></i>
                                    Save
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    @script
        <script>
            $wire.on('show', () => {
                $('#create-modal').modal('show');
            });
            $wire.on('close', () => {
                $('#create-modal').modal('hide');
            });
        </script>
    @endscript
</div>
