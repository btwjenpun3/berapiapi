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
}
