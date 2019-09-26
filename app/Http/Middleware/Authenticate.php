<?php

namespace Main\Http\Middleware;

use Closure;
use Main\User;

class Authenticate
{
    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure                 $next
     *
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (is_null(User::fromRequest($request))) {
            User::logout($request);

            return redirect()->to('/login');
        }

        return $next($request);
    }
}
