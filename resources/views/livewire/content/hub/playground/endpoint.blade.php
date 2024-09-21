<div class="col-xxl-10 col-md-6">
    @if ($show)
        <div class="row">
            <div class="col-xxl-5 col-xl-12 col-md-12">
                <div class="card height-equal" style="min-height: 282.594px;">
                    <div class="card-header">
                        <p>{{ $definition->name }}</p>
                        <hr>
                        <ul class="nav nav-pills nav-primary" id="path-tab" role="tablist">
                            <li class="nav-item" role="presentation">
                                <a class="nav-link" id="path-aboutus-tab" data-bs-toggle="pill" href="#path-aboutus"
                                    role="tab" aria-controls="path-aboutus" aria-selected="false" tabindex="-1"
                                    wire:ignore.self>
                                    Path Parameter
                                </a>
                            </li>
                            <li class="nav-item" role="presentation">
                                <a class="nav-link" id="headers-aboutus-tab" data-bs-toggle="pill"
                                    href="#headers-aboutus" role="tab" aria-controls="headers-aboutus"
                                    aria-selected="false" tabindex="-1" wire:ignore.self>
                                    Headers
                                </a>
                            </li>
                            <li class="nav-item" role="presentation">
                                <a class="nav-link active" id="params-aboutus-tab" data-bs-toggle="pill"
                                    href="#params-aboutus" role="tab" aria-controls="params-aboutus"
                                    aria-selected="false" tabindex="-1" wire:ignore.self>
                                    Params
                                </a>
                            </li>
                        </ul>
                    </div>
                    <div class="card-body">
                        <div class="tab-content" id="path-tabContent">
                            <div class="tab-pane" id="path-aboutus" role="tabpanel" aria-labelledby="path-aboutus-tab"
                                wire:ignore.self>
                                <h4 class="mb-3">Path Parameter</h4>
                                @if (count($pathParameters) >= 0)
                                    @if ($pathParameters === [])
                                        No path parameter needed
                                    @else
                                        @foreach ($pathParameters as $key => $pathParameter)
                                            <div class="mt-4">
                                                <label class="form-label">
                                                    {{ $pathParameter['parameter'] }}
                                                    @switch($pathParameter['required'])
                                                        @case(false)
                                                        @break

                                                        @case(true)
                                                            <span class="badge bg-danger">Required</span>
                                                        @break

                                                        @default
                                                    @endswitch
                                                </label>
                                                <input type="text" class="form-control"
                                                    wire:model.lazy='pathParameters.{{ $key }}.value'>
                                                <span>{{ $pathParameters[$key]['type'] }}</span>
                                            </div>
                                        @endforeach
                                    @endif
                                @endif
                            </div>
                        </div>
                        <div class="tab-content" id="headers-tabContent">
                            <div class="tab-pane fade" id="headers-aboutus" role="tabpanel"
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
                                                    wire:model.lazy='headers.{{ $key }}.value'>
                                                <span>{{ $headers[$key]['type'] }}</span>
                                            </div>
                                        @endforeach
                                    @endif
                                @endif
                            </div>
                        </div>
                        <div class="tab-content" id="params-tabContent">
                            <div class="tab-pane fade active show" id="params-aboutus" role="tabpanel"
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
                                                    wire:model.lazy='queries.{{ $key }}.value'>
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
                    <div class="card-body bottom-border-tab">
                        <ul class="nav nav-tabs border-tab mb-0" id="bottom-tab" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link nav-border txt-primary tab-primary pt-0 active"
                                    id="bottom-testing-tab" data-bs-toggle="tab" href="#bottom-testing" role="tab"
                                    aria-controls="bottom-testing" aria-selected="true" wire:ignore.self>
                                    <i class="fa fa-play" aria-hidden="true"></i>
                                    Testing Area
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link nav-border txt-primary tab-primary pt-0" id="bottom-code-tab"
                                    data-bs-toggle="tab" href="#bottom-code" role="tab"
                                    aria-controls="bottom-code" aria-selected="true" wire:ignore.self>
                                    <i class="fa fa-code" aria-hidden="true"></i>
                                    Code Snippets
                                </a>
                            </li>
                        </ul>
                        <div class="tab-content" id="bottom-tabContent">
                            <div class="tab-pane fade show active" id="bottom-testing" role="tabpanel"
                                aria-labelledby="bottom-testing-tab" wire:ignore.self>
                                <div class="mt-3">
                                    <div class="d-flex justify-content-end">
                                        <button class="btn btn-success" wire:click='run'
                                            wire:loading.attr='disabled'>
                                            <div wire:loading.remove>
                                                <i class="fa fa-play-circle me-2"></i>
                                                Test Endpoint
                                            </div>
                                            <div wire:loading>
                                                Test running....
                                            </div>
                                        </button>
                                    </div>
                                    @if ($response)
                                        <div class="d-flex justify-content-between mt-3">
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
                            <div class="tab-pane fade" id="bottom-code" role="tabpanel"
                                aria-labelledby="bottom-code-tab" wire:ignore.self>
                                <div class="mt-3">
                                    <select class="form-select" wire:model='codeSnippets'
                                        wire:change='setCodeSnippets($event.target.value)'>
                                        <option value="PHP">PHP</option>
                                    </select>
                                    <pre class="mt-3">{{ $codeSnippetsContent }}</pre>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif
</div>
