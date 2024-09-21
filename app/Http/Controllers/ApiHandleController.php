<?php

namespace App\Http\Controllers;

use App\Models\Hub;
use App\Traits\BuildHeaders;
use App\Traits\BuildQueries;
use App\Traits\BuildHttpQuery;
use App\Traits\BuildEndpoint;
use App\Traits\Get;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class ApiHandleController extends Controller
{
    use Get, BuildHeaders, BuildQueries, BuildHttpQuery, BuildEndpoint;

    public function handle(Request $request)
    {
        try {
            $hub = Hub::where('slug', $request->slug)->first();

            $headers = $request->header();
            $headerParam = [];
            foreach ($headers as $key => $header) {
                $headerParam[$key] = $header[0];
            }

            $queryParam = $this->buildHttpQuery($request->query());

            $headerParam['accept-encoding'] = '';
            unset($headerParam['x-berapiapi-key']);
            unset($headerParam['cookie']);
            unset($headerParam['host']);

            $response = Http::withHeaders($headerParam)->get($hub->base_url . '/' . $request->endpoint . $queryParam);

            return response()->json([
                $response->json()
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'error' => $e->getMessage()
            ], 422);
        }
    }
}
