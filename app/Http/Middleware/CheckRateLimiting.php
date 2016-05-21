<?php

namespace Snikpik\Http\Middleware;

use Auth;
use Snikpik\Traits\API\OriginCheck;
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

    use OriginCheck;

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
        if (Auth::guard('api')->check()) {
            $user = Auth::guard('api')->user();

            $plan = $user->sparkPlan();

            if ($plan->attribute('rate-limiting') < 0) {
                return $next($request);
            }

            return $this->limiter->handle($request, $next, $plan->attribute('rate-limiting'));
        }

        return $this->bypass($request, $next);
    }
}