<?php

namespace App\Http\Middleware;

use Carbon\Carbon;
use Closure;

class Localize
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
        Carbon::setLocale('fr');
        return $next($request);
    }
}
