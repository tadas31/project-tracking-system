<?php

namespace App\Http\Middleware;

use Closure;

class JWTAuth
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next, $userType)
    {
        if (auth($userType)->user() == null)
            return response()->json(['error' => 'Unauthorized'], 401);

        return $next($request);
    }
}
