<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Models\ApiKey;

class ApiKeyMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        
        $apiKey = $request->header('X-API-KEY') ?? $request->query('api_key');

        if (!$apiKey) {
            return response()->json(['error' => 'Chave de API não fornecida'], 400);
        }

        
        $apiKeyRecord = ApiKey::where('key', $apiKey)->first();

        if (!$apiKeyRecord) {
            return response()->json(['error' => 'Chave de API inválida'], 403);
        }

        
        $apiKeyRecord->increment('request_count');

        return $next($request);
    }
}
