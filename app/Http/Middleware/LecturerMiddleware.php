<?php

namespace ppes\Http\Middleware;

use Closure;

class LecturerMiddleware
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
        if (! ($request->user()->isLecturer() || $request->user()->isAdministrator()) )  {
            return redirect()->route('main.dashboard');
        }

        return $next($request);
    }
}
