<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;


class RouteCalculatorController extends Controller
{
    public function getRoute(Request $request)
    {
        $request->validate([
            'mode' => 'required|in:driving,cycling,walking',
            'latStart' => 'required|numeric',
            'longStart' => 'required|numeric',
            'latEnd' => 'required|numeric',
            'longEnd' => 'required|numeric',
        ]);

        $mode = $request->input('mode');
        $latStart = $request->input('latStart');
        $longStart = $request->input('longStart');
        $latEnd = $request->input('latEnd');
        $longEnd = $request->input('longEnd');


        $base_url = "http://localhost:5000/";


        $route_service_url = "{$base_url}/route/v1/{$mode}/{$longStart},{$latStart};{$longEnd},{$latEnd}?overview=full&steps=true&geometries=geojson";


        $response = Http::get($route_service_url);


        if ($response->successful()) {
            return response()->json($response->json());
        }


        return response()->json(['error' => 'Não foi possível obter a rota'], 500);
    }

}