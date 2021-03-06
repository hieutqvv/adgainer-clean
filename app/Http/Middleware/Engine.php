<?php

namespace App\Http\Middleware;

use Auth;
use Closure;

class Engine
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
        if (empty(session('engine'))) {
            return redirect('/account_report');
        }
        return $next($request);
    }
}
