<?php

namespace Snikpik\Http\Middleware;

use Auth;
use Snikpik\User;
use Spark;
use Closure;
use Illuminate\Routing\Middleware\ThrottleRequests;
use Laravel\Spark\Subscription;

/**
 * Class CheckRateLimiting
 * @package Snikpik\Http\Middleware
 */
class CheckRateLimiting
{

    /**
     * @var ThrottleRequests
     */
    protected $limiter;

    /**
     * CheckRateLimiting constructor.
     * @param ThrottleRequests $limiter
     */
    public function __construct(ThrottleRequests $limiter)
    {
        $this->limiter = $limiter;
    }

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $user = Auth::guard('api')->user();

        $plan = $user->sparkPlan();

        return $this->limiter->handle($request, $next, $plan->attribute('rate-limiting'));
    }
}