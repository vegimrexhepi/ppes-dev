<?php

namespace ppes\Http\Middleware;

use Closure;

class StudentMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (! ($request->user()->isStudent() || $request->user()->isAdministrator())  ) {
            return redirect()->route('main.dashboard');
        }

        return $next($request);
    }
}
