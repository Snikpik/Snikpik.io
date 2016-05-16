<?php

namespace Snikpik\Providers;

use Laravel\Cashier\Cashier;
use Laravel\Spark\Exceptions\IneligibleForPlan;
use Laravel\Spark\Spark;
use Laravel\Spark\Providers\AppServiceProvider as ServiceProvider;

class SparkServiceProvider extends ServiceProvider
{
    /**
     * Your application and company details.
     *
     * @var array
     */
    protected $details = [
        'vendor' => 'Snikpik',
        'product' => 'Snikpik',
        'street' => '1202-600 Drake Street',
        'location' => 'V6B 5W7  Vancouver, BC',
        'phone' => '778-317-4194',
    ];

    /**
     * The address where customer support e-mails should be sent.
     *
     * @var string
     */
    protected $sendSupportEmailsTo = 'valentin@whatdafox.com';

    /**
     * All of the application developer e-mail addresses.
     *
     * @var array
     */
    protected $developers = [
        'valentin@whatdafox.com'
    ];

    /**
     * Indicates if the application will expose an API.
     *
     * @var bool
     */
    protected $usesApi = true;

    /**
     * Finish configuring Spark for the application.
     *
     * @return void
     */
    public function booted()
    {
        Spark::useStripe()->noCardUpFront();

        Cashier::useCurrency('CAD', '$');

        Spark::freePlan('Spotted Owl')
            ->features([
                '1 000 requests/month',
                '1 requests/minute',
            ])
            ->attributes([
                'max-requests' => 1000,
                'rate-limiting' => 1,
            ]);

        Spark::plan('Barred Owl', 'barred-owl')
            ->price(9)
            ->features([
                '5 000 requests/month',
                '5 requests/minute',
            ])
            ->attributes([
                'max-requests' => 5000,
                'rate-limiting' => 5,
            ]);

        Spark::plan('Boreal Owl', 'boreal-owl')
            ->price(29)
            ->features([
                '10 000 requests/month',
                '10 requests/minute',
            ])
            ->attributes([
                'max-requests' => 10000,
                'rate-limiting' => 10,
            ]);

        Spark::plan('Snowy Owl', 'snowy-owl')
            ->price(49)
            ->features([
                'Unlimited requests/month',
                'Unlimited requests/minute',
            ])
            ->attributes([
                'max-requests' => -1,
                'rate-limiting' => -1,
            ]);
    }
    
    public function register()
    {
        Spark::useUserModel('Snikpik\User');
        Spark::useTeamModel('Snikpik\Team');
    }
}
