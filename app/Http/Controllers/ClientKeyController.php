<?php

namespace App\Http\Controllers;

use App\Models\ApiKey;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Str;

class ClientKeyController
{
    public function index()
    {
        return $this->generateKey();
    }

    /**
     * @return JsonResponse
     */
    public function generateKey(): JsonResponse
    {
        $plainTextKey   = Str::random(40); // The key given to the user
        $expiry         = now()->addMinutes(30);   // Dynamic duration

        ApiKey::create([
            'client_name'   => 'FrontendInterface',
            'key'           => hash('sha256', $plainTextKey), // Secure hash storage
            'expires_at'    => $expiry,
        ]);

        return response()->json([
            'api_key' => $plainTextKey, // Only shown once
            'expires_at' => $expiry
        ]);
    }
}
