<?php

namespace App\Http\Middleware;
use Symfony\Component\HttpFoundation\Response;

use Closure;

class GuruMiddleware
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
         if ( $request->user() && $request->user()->level != 'guru') {
            return new Response(view('unauthorized')->with('role', 'guru'));
        }
        return $next($request);
    }
}
