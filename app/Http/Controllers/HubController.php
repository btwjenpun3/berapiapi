<?php

namespace App\Http\Controllers;

use App\Models\Hub;
use Illuminate\Http\Request;

class HubController extends Controller
{
    public function index()
    {
        $hubs = Hub::orderBy('id', 'desc')->get();

        return view('pages.hub.index', [
            'hubs' => $hubs,
        ]);
    }

    public function create()
    {
        return view('pages.hub.create');
    }

    public function list()
    {
        $hubs = Hub::orderBy('id', 'desc')->get();

        return view('pages.hub.list', [
            'hubs' => $hubs,
        ]);
    }

    public function definitions(Request $request)
    {
        $hub = Hub::where('slug', $request->slug)->first();

        if (! $hub) {
            abort(404);
        }

        return view('pages.hub.studio.definitions', [
            'hub' => $hub,
        ]);
    }

    public function playground(Request $request)
    {
        $hub = Hub::where('slug', $request->slug)->first(); 

        if (! $hub) {
            abort(404);
        }

        return view('pages.hub.playground', [
            'hub' => $hub
        ]);
    }
}
