<div class="col-xxl-10 col-md-6">
    @if ($show)
        <div class="row">
            <div class="col-xxl-5 col-xl-12 col-md-12">
                <div class="card height-equal" style="min-height: 282.594px;">
                    <div class="card-header">
                        <p>{{ $definition->name }}</p>
                        <hr>
                        <ul class="nav nav-pills nav-primary" id="headers-tab" role="tablist">
                            <li class="nav-item" role="presentation">
                                <a class="nav-link active" id="headers-aboutus-tab" data-bs-toggle="pill"
                                    href="#headers-aboutus" role="tab" aria-controls="headers-aboutus"
                                    aria-selected="false" tabindex="-1" wire:ignore.self>
                                    Headers
                                </a>
                            </li>
                            <li class="nav-item" role="presentation">
                                <a class="nav-link" id="params-aboutus-tab" data-bs-toggle="pill" href="#params-aboutus"
                                    role="tab" aria-controls="params-aboutus" aria-selected="false" tabindex="-1"
                                    wire:ignore.self>
                                    Params
                                </a>
                            </li>
                        </ul>
                    </div>
                    <div class="card-body">
                        <div class="tab-content" id="headers-tabContent">
                            <div class="tab-pane fade active show" id="headers-aboutus" role="tabpanel"
                                aria-labelledby="headers-aboutus-tab" wire:ignore.self>
                                <h4 class="mb-3">Header Params</h4>
                                @if (count($headers) >= 1)
                                    @if ($headers[0]['parameter'] === null)
                                        No headers needed
                                    @else
                                        @foreach ($headers as $key => $header)
                                            <div class="mt-4">
                                                <label class="form-label">
                                                    {{ $header['parameter'] }}
                                                    @switch($header['required'])
                                                        @case(false)
                                                        @break

                                                        @case(true)
                                                            <span class="badge bg-danger">Required</span>
                                                        @break

                                                        @default
                                                    @endswitch
                                                </label>
                                                <input type="text" class="form-control"
                                                    wire:model='headers.{{ $key }}.value'>
                                                <span>{{ $headers[$key]['type'] }}</span>
                                            </div>
                                        @endforeach
                                    @endif
                                @endif
                            </div>
                        </div>
                        <div class="tab-content" id="params-tabContent">
                            <div class="tab-pane" id="params-aboutus" role="tabpanel"
                                aria-labelledby="params-aboutus-tab" wire:ignore.self>
                                <h4 class="mb-3">Query Params</h4>
                                @if (count($queries) >= 1)
                                    @if ($queries[0]['parameter'] === null)
                                        No queries needed
                                    @else
                                        @foreach ($queries as $key => $query)
                                            <div class="mt-4">
                                                <label class="form-label">
                                                    {{ $query['parameter'] }}
                                                    @switch($query['required'])
                                                        @case(false)
                                                        @break

                                                        @case(true)
                                                            <span class="badge bg-danger">Required</span>
                                                        @break

                                                        @default
                                                    @endswitch
                                                </label>
                                                <input type="text" class="form-control"
                                                    wire:model='queries.{{ $key }}.value'>
                                                <span>{{ $queries[$key]['type'] }}</span>
                                            </div>
                                        @endforeach
                                    @endif
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xxl-7 col-xl-12 col-md-12 col-md-4">
                <div class="card height-equal">
                    <div class="card-header">
                        Testing Area
                    </div>
                    <div class="card-body">
                        <button class="btn btn-success" wire:click='run' wire:loading.attr='disabled'>
                            <div wire:loading.remove>
                                <i class="fa fa-play-circle me-2"></i>
                                Test Endpoint
                            </div>
                            <div wire:loading>
                                Test running....
                            </div>
                        </button>
                        <div class="mt-3">
                            <label class="form-label">Result show here :</label>
                        </div>
                        @if ($response)
                            <div class="d-flex justify-content-between">
                                <div>
                                    <small class="badge bg-primary">
                                        Time : {{ number_format($executionTime, 2) }} ms
                                    </small>
                                </div>
                                <div>
                                    <small class="badge bg-info">
                                        HTTP {{ $httpStatusCode }}
                                    </small>
                                </div>
                            </div>
                        @endif
                        @if ($response)
                            <pre>{{ $response }}</pre>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    @endif
</div>
