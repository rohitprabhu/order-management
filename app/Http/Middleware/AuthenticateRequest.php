<?php

namespace App\Http\Middleware;

use Closure;
use App\Models\ApiKey;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AuthenticateRequest
{
    /**
     * Handle an incoming request.
     *
     * @param  Closure(Request): (Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Extract bearer token from the Authorization header
        $plainKey = $request->bearerToken();

        if (!$plainKey) {
            return response()->json(['success' => false, 'errMsg' => 'API Key is missing in the header'], 401);
        }

        // Generate Hash for the incoming key and match it against database records
        $hashedKey = hash('sha256', $plainKey);
        $apiKeyRecord = ApiKey::where('key', $hashedKey)->first();

        // Check if key exists and validate expiration
        if (!$apiKeyRecord || $apiKeyRecord->expires_at->isPast()) {
            return response()->json(['success' => false, 'errMsg' => 'The API Key passed is either Invalid or Expired'], 401);
        }

        // Share the authenticated client details with the request instance
        $request->attributes->set('api_client', $apiKeyRecord->client_name);

        return $next($request);
    }
}
