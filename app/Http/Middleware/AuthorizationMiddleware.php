<?php

namespace App\Http\Middleware;

use App\Helpers\AhcResponse;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Symfony\Component\HttpFoundation\Response;

class AuthorizationMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $token = \Laravel\Sanctum\PersonalAccessToken::findToken($request->header('Authorization'));
        if ($token != null) {
            if ($token->expires_at < Carbon::now()) {
                return AhcResponse::sendResponse([], false, ['Your token has expired, please login again']);
            }
            else {
                return $next($request);
            }
        }
        return AhcResponse::sendResponse([], false, ['You are not logged in']);
    }
}
