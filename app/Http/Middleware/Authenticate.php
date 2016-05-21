<?php

namespace Snikpik\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use Snikpik\Traits\API\OriginCheck;

class Authenticate
{
    use OriginCheck;

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  $guard
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = null)
    {
        if (Auth::guard($guard)->guest() && $this->isNotFromUs($request, $next)) {
            if ($request->ajax() || $request->wantsJson()) {
                return response('Unauthorized.', 401);
            } else {
                return redirect()->guest('login');
            }
        }

        return $next($request);
    }
}
