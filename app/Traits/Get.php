<?php

namespace App\Traits;

use Illuminate\Support\Facades\Http;

trait Get 
{
    public function get(string $baseUrl, string $endpoint, string $httpQuery, array $headers = [])
    {
        $response = Http::withHeaders($headers)->get($baseUrl . '/' . $endpoint . $httpQuery);
        
        return $response;
    }
}