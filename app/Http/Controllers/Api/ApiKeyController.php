<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\ApiKey;
use Str;

class ApiKeyController extends Controller
{
  
    public function generateApiKey(Request $request)
    {
        
        $request->validate([
            'user_id' => 'required|exists:users,id',
        ]);

        
        $apiKey = Str::random(32);

        
        $apiKeyModel = ApiKey::create([
            'key' => $apiKey,
            'request_count' => 0,
            'user_id' => $request->user_id, 
        ]);

        
        return response()->json(['api_key' => $apiKeyModel->key]);
    }
    
}
