<?php

namespace App\Livewire\Modal\Hub\Definition;

use App\Livewire\Table\Hub\Definition\Lists;
use App\Models\HubDefinition;
use App\Traits\ConvertArrayEmptyStringToNull;
use Illuminate\Support\Facades\DB;
use Livewire\Attributes\On;
use Livewire\Component;

class Edit extends Component
{
    use ConvertArrayEmptyStringToNull;

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
            
            $this->headers = json_decode($definition->headers, true);
            $this->queries = json_decode($definition->queries, true);

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

        $this->headers = array_values($this->headers);
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

        $this->queries = array_values($this->queries);
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
            'queries.*.parameter'   => 'required'
        ]);

        DB::beginTransaction();

        try {
            $headers = $this->convertArrayEmptyStringToNull($this->headers);
            $queries = $this->convertArrayEmptyStringToNull($this->queries);

            HubDefinition::where('id', $this->definitionId)->update([
                'name'      => $this->name,
                'method'    => $this->method,
                'endpoint'  => $this->endpoint,
                'headers'   => json_encode($headers),
                'queries'   => json_encode($queries)
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
