<?php

namespace Snikpik\Http\Middleware;

use Auth;
use Illuminate\Cache\RateLimiter;
use Snikpik\Services\RequestLimiter;
use Snikpik\User;
use Spark;
use Closure;
use Illuminate\Routing\Middleware\ThrottleRequests;
use Laravel\Spark\Subscription;
use Symfony\Component\HttpFoundation\Response;

/**
 * Class CheckRequestLimit
 * @package Snikpik\Http\Middleware
 */
class CheckRequestLimit
{
    /**
     * The request limiter instance.
     *
     * @var \Snikpik\Services\RequestLimiter
     */
    protected $limiter;

    /**
     * Create a new request throttler.
     * @param  \Snikpik\Services\RequestLimiter  $limiter
     */
    public function __construct(RequestLimiter $limiter)
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
        $key = $this->resolveRequestSignature($request) . ':requests';

        $user = Auth::guard('api')->user();
        $plan = $user->sparkPlan();

        if($plan->attribute('max-requests') < 0) {
            return $next($request);
        }

        if ($this->limiter->tooManyAttempts($key, $plan->attribute('max-requests'))) {
            return $this->buildResponse($key, $plan->attribute('max-requests'));
        }

        $this->limiter->hit($key, $plan->attribute('max-requests'));

        return $this->addHeaders(
            $next($request), $plan->attribute('max-requests'),
            $this->calculateRemainingRequests($key, $plan->attribute('max-requests'))
        );
    }

    /**
     * Resolve request signature.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return string
     */
    protected function resolveRequestSignature($request)
    {
        return $request->fingerprint();
    }

    /**
     * Create a 'too many attempts' response.
     *
     * @param  string  $key
     * @param  int  $maxRequests
     * @return \Illuminate\Http\Response
     */
    protected function buildResponse($key, $maxRequests)
    {
        $response = new Response('Too Many Attempts.', 429);

        return $this->addHeaders(
            $response, $maxRequests,
            $this->calculateRemainingRequests($key, $maxRequests),
            $this->limiter->availableIn($key)
        );
    }

    /**
     * Add the limit header information to the given response.
     *
     * @param  \Symfony\Component\HttpFoundation\Response  $response
     * @param  int  $maxRequests
     * @param  int  $remainingAttempts
     * @param  int|null  $retryAfter
     * @return \Illuminate\Http\Response
     */
    protected function addHeaders(Response $response, $maxRequests, $remainingAttempts, $retryAfter = null)
    {
        $headers = [
            'X-RequestLimit-Limit' => $maxRequests,
            'X-RequestLimit-Remaining' => $remainingAttempts,
        ];

        if (! is_null($retryAfter)) {
            $headers['X-RequestLimit-Retry-After'] = $retryAfter;
        }

        $response->headers->add($headers);

        return $response;
    }

    /**
     * Calculate the number of remaining requests.
     *
     * @param  string  $key
     * @param  int  $maxRequests
     * @return int
     */
    protected function calculateRemainingRequests($key, $maxRequests)
    {
        return $maxRequests - $this->limiter->attempts($key) + 1;
    }
}