<?php

namespace App\Livewire\Modal\Hub\Definition;

use App\Livewire\Table\Hub\Definition\Lists;
use App\Models\HubDefinition;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;
use Livewire\Attributes\On;
use Illuminate\Support\Str;
use Livewire\Component;

class Create extends Component
{
    public $hubId;

    public $name, $method, $endpoint;

    public $headers = [];

    public $queries = [];

    // public function mount($id)
    // {
    //     $this->hubId = $id;
        
    //     $this->method = 'GET';

    //     $this->arrayMount();
    // }

    public function arrayMount()
    {
        $this->headers[] = [
            'parameter' => null,
            'type'      => 'string',
            'value'     => null,
            'required'  => false
        ];

        $this->queries[] = [
            'parameter' => null,
            'type'      => 'string',
            'value'     => null,
            'required'  => false
        ];
    }

    #[On('open-create-modal')]
    public function show($hubId)
    {
        $this->reset();

        $this->hubId = $hubId;
        
        $this->method = 'GET';

        $this->arrayMount();

        $this->dispatch('show')->self();
    }

    public function changeMethod($method)
    {
        $this->method = $method;
    }

    public function addHeader($key)
    {
        $key = $key + 1;

        $this->headers[$key] = [
            'parameter' => null,
            'type'      => 'string',
            'value'     => null,
            'required'  => false
        ];
    }

    public function removeHeader($key)
    {
        unset($this->headers[$key]);
    }

    public function addQuery($key)
    {
        $key = $key + 1;

        $this->queries[$key] = [
            'parameter' => null,
            'type'      => 'string',
            'value'     => null,
            'required'  => false
        ];
    }

    public function removeQuery($key)
    {
        unset($this->queries[$key]);
    }

    public function save()
    {
        $this->validate([
            'name'                  => 'required|max:255',
            'endpoint'              => 'required|max:255',
            'method'                => 'required',
            'headers'               => 'array',
            'headers.*.parameter'   => 'nullable',
            'headers.*.value'       => 'nullable',
            'queries'               => 'required|array',
            'queries.*.parameter'   => 'required',
            'queries.*.value'       => 'nullable',
        ]);

        DB::beginTransaction();

        try {
            HubDefinition::create([
                'hub_id'    => $this->hubId,
                'uuid'      => Str::uuid(),
                'name'      => $this->name,
                'method'    => $this->method,
                'endpoint'  => $this->endpoint,
                'headers'   => json_encode($this->headers),
                'queries'   => json_encode($this->queries)
            ]);

            DB::commit();

            $this->dispatch('refresh-definition-table')->to(Lists::class);

            $this->dispatch('close');

        } catch (\Exception $e) {
            DB::rollBack();

            $this->dispatch('error', 'Something error');
        }
    }

    public function render()
    {
        return view('livewire.modal.hub.definition.create');
    }
}
