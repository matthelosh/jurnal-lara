<?php

namespace App\Http\Middleware;

use Closure;

class forAdmin
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
         if ( $request->user() && $request->user()->level != 'admin') {
            return new Response(view('unauthorized')->with('role', 'admin'));
        }
        return $next($request);
    }
}
