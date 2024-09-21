<?php

namespace App\Livewire\Content\Hub\Playground;

use App\Models\HubDefinition;
use App\Traits\BuildHeaders;
use App\Traits\BuildQueries;
use App\Traits\BuildHttpQuery;
use App\Traits\BuildEndpoint;
use App\Traits\Get;
use Illuminate\Support\Facades\Http;
use Livewire\Attributes\On;
use Livewire\Component;

class Endpoint extends Component
{
    use Get, BuildHeaders, BuildQueries, BuildHttpQuery, BuildEndpoint;

    public $definition, $hub;

    public $headers = [];

    public $queries = [];

    public $pathParameters = [];

    public $response, $executionTime, $httpStatusCode;

    public $codeSnippets, $codeSnippetsContent;

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
        $this->pathParameters = json_decode($definition->path_parameter, true);
        
        $codeSnippets = 'PHP';
        $this->codeSnippets = $codeSnippets;
        $this->setCodeSnippets($codeSnippets);

        $this->show = true;
    }

    public function run()
    {
        $endpoint       = $this->definition->endpoint;
        $queries        = $this->queries;
        $headers        = $this->headers;
        $pathParameters = $this->pathParameters;

        // Build Path Parameter
        $endpoint = $this->buildEndpoint($pathParameters, $endpoint);

        //Build Headers
        $headerParam = $this->buildHeaders($headers);
        
        // Build Query
        $queryParam = $this->buildQueries($queries);

        // Build HTTP Query
        $queryString = $this->buildHttpQuery($queryParam);

        // Mulai menghitung waktu sebelum request
        $startTime = microtime(true);
        
        // GO!        
        $response = $this->get($this->hub->base_url, $endpoint, $queryString, $headerParam);

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

    public function updated($key, $value)
    {
        $this->setCodeSnippets($this->codeSnippets);
    }

    public function setCodeSnippets($code)
    {
        $appUrl = env('APP_URL');
        $baseUrl = $appUrl . 'api/' . $this->hub->slug . '/';

        // Build Path Parameter
        $endpoint = $this->buildEndpoint($this->pathParameters, $this->definition->endpoint);

        //Build Headers
        $headerParam = $this->buildHeaders($this->headers);
        $headerFix = array_merge($headerParam, [
            'X-Berapiapi-Key' => '<YOUR_API_KEY>'
        ]);

        // Convert headerFix array into cURL compatible format
        $headerFixArray = [];
        foreach ($headerFix as $key => $value) {
            $headerFixArray[] = "{$key}: {$value}";
        }
        
        $headersString = json_encode($headerFixArray, JSON_PRETTY_PRINT);

        // Build Query
        $queryParam = $this->buildQueries($this->queries);

        $httpQuery = $this->buildHttpQuery($queryParam);

        switch ($code) {
            case 'PHP':

                $this->codeSnippetsContent = <<<PHP

                <?php

                \$curl = curl_init();

                curl_setopt_array(\$curl, [
                    CURLOPT_URL => "{$baseUrl}{$endpoint}{$httpQuery}",
                    CURLOPT_RETURNTRANSFER => true,
                    CURLOPT_ENCODING => "",
                    CURLOPT_MAXREDIRS => 10,
                    CURLOPT_TIMEOUT => 30,
                    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                    CURLOPT_CUSTOMREQUEST => "GET",
                    CURLOPT_HTTPHEADER => {$headersString},
                ]);

                \$response = curl_exec(\$curl);
                \$err = curl_error(\$curl);

                curl_close(\$curl);

                if (\$err) {
                    echo "cURL Error #:" . \$err;
                } else {
                    echo \$response;
                }
                PHP;
            break;
        }
    }
}
