<?php

namespace App\Http\Middleware;

use App\Exceptions\NotAuthException;
use Closure;
use Illuminate\Http\Request;

class AuthPBEMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        if(empty($request->header('pbe-token'))){
            throw new NotAuthException();
        }
        return $next($request);
    }
}