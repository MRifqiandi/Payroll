<?php

namespace App\Http\Middleware;

use App\Models\ApiKey;
use App\Services\ApiAuth;
use App\Utils;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\HttpException;

class ApiKeyMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $user = $request->header('X-API-USER');
        $client = $request->header('X-API-KEY');

        if (!$user || !$client) {
            throw new HttpException(403, 'Invalid API Key / User');
        }

        $key = ApiKey::where('user', $user)->first();

        if (!$key) {
            throw new HttpException(403, 'Invalid API Key / User');
        }

        if (!Utils::VERIFY_API_KEY($client, $key->key)) {
            throw new HttpException(403, 'Invalid API Key / User');
        }

        ApiAuth::setKey($key);

        return $next($request);
    }
}
