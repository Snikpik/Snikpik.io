<?php

namespace Snikpik\Services;

use Carbon\Carbon;
use Illuminate\Contracts\Cache\Repository as Cache;

/**
 * Class RequestLimiter
 * @package Snikpik\Services
 */
class RequestLimiter
{
    /**
     * The cache store implementation.
     *
     * @var \Illuminate\Contracts\Cache\Repository
     */
    protected $cache;

    /**
     * Create a new rate limiter instance.
     * @param  \Illuminate\Contracts\Cache\Repository  $cache
     */
    public function __construct(Cache $cache)
    {
        $this->cache = $cache;
    }

    /**
     * Determine if the given key has been "accessed" too many times.
     *
     * @param  string  $key
     * @param  int  $maxAttempts
     * @return bool
     */
    public function tooManyAttempts($key, $maxAttempts)
    {
        if ($this->cache->has($key.':requests:lockout')) {
            return true;
        }

        if ($this->attempts($key) > $maxAttempts) {
            $this->cache->add($key.':requests:lockout', $this->endOfTheMonth(), $this->minutesUntilEndOfTheMonth());

            $this->resetAttempts($key);

            return true;
        }

        return false;
    }

    /**
     * Increment the counter for a given key for a given decay time.
     *
     * @param  string  $key
     * @param  int  $decayMinutes
     * @return int
     */
    public function hit($key, $decayMinutes = 1)
    {
        $this->cache->add($key, 1, $decayMinutes);

        return (int) $this->cache->increment($key);
    }

    /**
     * Get the number of attempts for the given key.
     *
     * @param  string  $key
     * @return mixed
     */
    public function attempts($key)
    {
        return $this->cache->get($key, 0);
    }

    /**
     * Reset the number of attempts for the given key.
     *
     * @param  string  $key
     * @return mixed
     */
    public function resetAttempts($key)
    {
        return $this->cache->forget($key);
    }

    /**
     * Get the number of requests left for the given key.
     *
     * @param  string  $key
     * @param  int  $maxAttempts
     * @return int
     */
    public function retriesLeft($key, $maxAttempts)
    {
        $attempts = $this->attempts($key);

        return $attempts === 0 ? $maxAttempts : $maxAttempts - $attempts + 1;
    }

    /**
     * Clear the hits and lockout for the given key.
     *
     * @param  string  $key
     * @return void
     */
    public function clear($key)
    {
        $this->resetAttempts($key);

        $this->cache->forget($key.':requests:lockout');
    }

    /**
     * Get the number of seconds until the "key" is accessible again.
     *
     * @param  string  $key
     * @return int
     */
    public function availableIn($key)
    {
        $today = Carbon::now();

        return $today->diffInMinutes($this->cache->get($key.':requests:lockout'));
    }

    /**
     * Return the exact date for the end of this month
     */
    private function endOfTheMonth()
    {
        $today = Carbon::now();

        return $today->endOfMonth();
    }

    /**
     *
     */
    private function minutesUntilEndOfTheMonth()
    {
        $today = Carbon::now();
        $endOfMonth = Carbon::now()->endOfMonth();

        return $today->diffInMinutes($endOfMonth);
    }
}
