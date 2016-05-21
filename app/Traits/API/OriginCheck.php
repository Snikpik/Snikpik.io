<?php

namespace Snikpik\Traits\API;

use Closure;
use Illuminate\Http\Request;

/**
 * Trait OriginCheck
 * @package Snikpik\Traits\API
 */
trait OriginCheck
{
    /**
     * @param Request $request
     * @param Closure $next
     * @return mixed
     */
    private function isFromUs(Request $request, Closure $next)
    {
        return url('/') === $request->header('Origin');
    }

    /**
     * @param Request $request
     * @param Closure $next
     * @return bool
     */
    private function isNotFromUs(Request $request, Closure $next)
    {
        return !$this->isFromUs($request, $next);
    }

    /**
     * @param Request $request
     * @param Closure $next
     * @return bool
     */
    private function bypass(Request $request, Closure $next)
    {
        if(!$this->isFromUs($request, $next)) {
            return $next($request);
        }
    }
}