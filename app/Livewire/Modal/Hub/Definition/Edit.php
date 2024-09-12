<?php

namespace App\Livewire\Modal\Hub\Definition;

use App\Livewire\Table\Hub\Definition\Lists;
use App\Models\HubDefinition;
use Illuminate\Support\Facades\DB;
use Livewire\Attributes\On;
use Livewire\Component;

class Edit extends Component
{
    public $definitionId;

    public $name, $method, $endpoint;

    public $headers = [];

    public $queries = [];

    #[On('open-edit-modal')]
    public function open($definitionId)
    {
        try {
            $this->reset();

            $this->definitionId = $definitionId;

            $definition = HubDefinition::find($definitionId);

            $this->name     = $definition->name;
            $this->method   = $definition->method;
            $this->endpoint = $definition->endpoint;
            
            $this->headers = json_decode($definition->headers);
            $this->queries = json_decode($definition->queries);

            $this->dispatch('show')->self();

        } catch (\Exception $e) {
            $this->dispatch('error', 'Something error');
        }
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

    public function debug()
    {
        dd($this->queries);
    }

    public function save()
    {
        //dd($this->queries);

        $this->validate([
            'name'                  => 'required|max:255',
            'endpoint'              => 'required|max:255',
            'method'                => 'required',
            'headers'               => 'array',
            'queries'               => 'required|array',
        ]);

        DB::beginTransaction();

        try {
            HubDefinition::where('id', $this->definitionId)->update([
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
        return view('livewire.modal.hub.definition.edit');
    }
}
