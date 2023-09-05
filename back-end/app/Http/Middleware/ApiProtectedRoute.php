<?php

namespace App\Http\Middleware;

use Closure;
use Tymon\JWTAuth\Http\Middleware\BaseMiddleware;
use Tymon\JWTAuth\Facades\JWTAuth;
use Tymon\JWTAuth\Exceptions\TokenExpiredException;

class ApiProtectedRoute extends BaseMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        try {
            JWTAuth::parseToken()->authenticate();   
        } catch (\Exception $exception) {

            if ($exception instanceof \Tymon\JWTAuth\Exceptions\TokenInvalidException){
                return response()->json(['message' => 'Token is Invalid'], 401, ['X-Header-One' => 'Header Value']);
            }else if ($exception instanceof TokenExpiredException){     
                return response()->json(['message' => 'Token is Expired'], 401, ['X-Header-One' => 'Header Value']);
            }else{
                return response()->json(['message' => 'Authorization Token not found'], 401, ['X-Header-One' => 'Header Value']);
            }
        }
        return $next($request);
    }
}
