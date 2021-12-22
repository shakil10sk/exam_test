<?php

namespace App\Http\Middleware;

use Closure;

class Admin
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
        if (auth()->user()->type > 3) {
            return redirect()->route('dashboard')->withErrors('You are not authorized to access that page.');
        }
        return $next($request);
    }
}
