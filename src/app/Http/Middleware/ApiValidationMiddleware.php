<?php

namespace App\Http\Middleware;

use App\Http\Requests\ApiRequest;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ApiValidationMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if ($request->is('api/*')) {
            $apiRequest = app(ApiRequest::class);
            $apiRequest->merge($request->all());
            $apiRequest->setMethod($request->method());
            $apiRequest->validateResolved();
        }

        return $next($request);
    }
}
