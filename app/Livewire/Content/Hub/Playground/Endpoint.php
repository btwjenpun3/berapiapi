<?php

namespace App\Livewire\Content\Hub\Playground;

use App\Models\HubDefinition;
use Illuminate\Support\Facades\Http;
use Livewire\Attributes\On;
use Livewire\Component;

class Endpoint extends Component
{
    public $definition, $hub;

    public $headers = [];

    public $queries = [];

    public $response, $executionTime, $httpStatusCode;

    public $show = false;

    #[On('select-endpoint')]
    public function show($definitionId)
    {
        $this->reset();

        $definition = HubDefinition::find($definitionId);

        $this->definition   = $definition;
        $this->hub          = $definition->hub;

        $this->headers = json_decode($definition->headers, true);
        $this->queries = json_decode($definition->queries, true);

        $this->show = true;
    }

    public function run()
    {
        $queries = $this->queries;
        $headers = $this->headers;

        //Build Headers
        $headerParam = [];

        foreach ($headers as $header) {
            if (isset($header['parameter'], $header['value'])) {
                $headerParam[$header['parameter']] = $header['value'];
            }            
        }

        // Build Query
        $queryParam = [];

        foreach ($queries as $query) {
            $queryParam[$query['parameter']] = $query['value'];
        }

        // Build HTTP Query
        $queryString = '?' . http_build_query($queryParam);

        // Mulai menghitung waktu sebelum request
        $startTime = microtime(true);
        
        // GO!
        $response = Http::withHeaders($headerParam)
                        ->get($this->hub->endpoint . '/' . $this->definition->endpoint . $queryString);

        // Selesai menghitung waktu setelah request
        $endTime = microtime(true);

        // Hitung total waktu dalam milidetik
        $executionTime = ($endTime - $startTime) * 1000;

        // Dapatkan HTTP status code
        $httpStatusCode = $response->status();
        
        $result = $response->json();

        $this->response = json_encode($result, JSON_PRETTY_PRINT);

        $this->executionTime = $executionTime;
        
        $this->httpStatusCode = $httpStatusCode;
    }

    public function render()
    {
        return view('livewire.content.hub.playground.endpoint');
    }
}
