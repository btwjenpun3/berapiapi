<div class="col-xxl-2 col-md-6">
    <div class="card">
        <div class="card-header">
            <h4>Endpoints</h4>
        </div>
        <div class="card-body">
            <input type="text" class="form-control mb-3" placeholder="Search Endpoint">
            <div class="vertical-scroll scroll-demo scroll-b-none ps-container ps-theme-default ps-active-y"
                data-ps-id="2e8f383e-df4f-6fed-d097-7899c30eb283">
                @if (count($hub->definitions) > 0)
                    <ol class="list-group scroll-rtl">
                        @foreach ($hub->definitions as $definition)
                            <li class="list-group-item d-flex align-items-start flex-wrap list-hover-primary">
                                <a href="#" wire:click='selectEndpoint({{ $definition->id }})'>
                                    <div class="ms-2 me-auto">{{ $definition->name }}</div>
                                </a>
                            </li>
                        @endforeach
                    </ol>
                @else
                    <i>No endpoints found</i>
                @endif
            </div>
        </div>
    </div>
</div>
