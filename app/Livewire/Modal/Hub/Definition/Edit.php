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

    public $pathParameters = [];

    public $showPathParameter = false;

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
            $this->pathParameters = json_decode($definition->path_parameter, true);
            
            if (isset($this->pathParameters) && count($this->pathParameters) > 0) {
                $this->showPathParameter = true;
            }

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

    /**
     * Show Path Paramter
     * 
     * Show Path Parameter form if endpoint contains {}
     */
    public function updatedEndpoint($value)
    {
        $pattern = '/\{([^\}]+)\}/';
        $string = $value;

        if (preg_match_all($pattern, $string, $matches)) {
            $this->pathParameters = [];

            foreach ($matches[1] as $match) {
                $this->pathParameters[] = [
                    'parameter' => $match,
                    'type'      => 'string',
                    'value'     => null,
                    'required'  => false
                ];
            }

            $this->showPathParameter = true;

        } else {
            $this->pathParameters = [];

            $this->showPathParameter = false;
        }
    }

    public function save()
    {
        //dd($this->queries);

        $this->validate([
            'name'                  => 'required|max:255',
            'endpoint'              => 'nullable|max:255',
            'method'                => 'required',
            'headers'               => 'array',
            'queries'               => 'required|array',
        ]);

        DB::beginTransaction();

        try {
            $headers = $this->convertArrayEmptyStringToNull($this->headers);
            $queries = $this->convertArrayEmptyStringToNull($this->queries);
            $pathParameters = $this->pathParameters;

            HubDefinition::where('id', $this->definitionId)->update([
                'name'      => $this->name,
                'method'    => $this->method,
                'endpoint'  => $this->endpoint,
                'path_parameter' => json_encode($pathParameters),
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
