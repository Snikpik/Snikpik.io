<?php

namespace Snikpik\Http;

use Illuminate\Auth\Middleware\AuthenticateWithBasicAuth;
use Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse;
use Illuminate\Foundation\Http\Kernel as HttpKernel;
use Illuminate\Foundation\Http\Middleware\CheckForMaintenanceMode;
use Illuminate\Routing\Middleware\ThrottleRequests;
use Illuminate\Session\Middleware\StartSession;
use Illuminate\View\Middleware\ShareErrorsFromSession;
use Laravel\Spark\Http\Middleware\CreateFreshApiToken;
use Laravel\Spark\Http\Middleware\VerifyTeamIsSubscribed;
use Laravel\Spark\Http\Middleware\VerifyUserHasTeam;
use Laravel\Spark\Http\Middleware\VerifyUserIsDeveloper;
use Laravel\Spark\Http\Middleware\VerifyUserIsSubscribed;
use Snikpik\Http\Middleware\Authenticate;
use Snikpik\Http\Middleware\CheckRateLimiting;
use Snikpik\Http\Middleware\CheckRequestLimit;
use Snikpik\Http\Middleware\EncryptCookies;
use Snikpik\Http\Middleware\RedirectIfAuthenticated;
use Snikpik\Http\Middleware\VerifyCsrfToken;

class Kernel extends HttpKernel
{
    /**
     * The application's global HTTP middleware stack.
     *
     * These middleware are run during every request to your application.
     *
     * @var array
     */
    protected $middleware = [
        CheckForMaintenanceMode::class,
    ];

    /**
     * The application's route middleware groups.
     *
     * @var array
     */
    protected $middlewareGroups = [
        'web' => [
            EncryptCookies::class,
            AddQueuedCookiesToResponse::class,
            StartSession::class,
            ShareErrorsFromSession::class,
            VerifyCsrfToken::class,
            CreateFreshApiToken::class,
        ],

        'api' => [
            CheckRateLimiting::class,
            CheckRequestLimit::class
        ],

        'internal' => [
            
        ],
    ];

    /**
     * The application's route middleware.
     *
     * These middleware may be assigned to groups or used individually.
     *
     * @var array
     */
    protected $routeMiddleware = [
        'auth' => Authenticate::class,
        'auth.basic' => AuthenticateWithBasicAuth::class,
        'dev' => VerifyUserIsDeveloper::class,
        'guest' => RedirectIfAuthenticated::class,
        'hasTeam' => VerifyUserHasTeam::class,
        'throttle' => ThrottleRequests::class,
        'subscribed' => VerifyUserIsSubscribed::class,
        'teamSubscribed' => VerifyTeamIsSubscribed::class,
    ];
}
