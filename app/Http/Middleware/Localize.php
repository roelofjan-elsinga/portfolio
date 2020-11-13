<?php

namespace Main\Http\Middleware;

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
        if ($request->getHttpHost() === 'roelofjanelsinga.nl') {
            app()->setLocale('nl');
        }

        return $next($request);
    }
}
