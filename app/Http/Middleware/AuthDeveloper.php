<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Auth\Middleware\Authenticate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AuthDeveloper
{
    private const KEY_HEADER = 'dev-key';
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if($request->bearerToken() !== null) {
            return app(Authenticate::class)->handle($request, fn(Request $request) => $next($request), 'sanctum');
        }

        if(!$request->hasHeader(self::KEY_HEADER) || $request->header(self::KEY_HEADER) !== env('APP_DEV_KEY')) {
            return response(['message' => 'unauthenticated...'], 401);
        }

        return $next($request);
    }
}
