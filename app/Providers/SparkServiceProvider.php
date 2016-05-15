<?php

namespace Snikpik\Providers;

use Laravel\Cashier\Cashier;
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
        Spark::useStripe()->noCardUpFront()->trialDays(15);

        Cashier::useCurrency('CAD', '$');

        Spark::freePlan()
            ->features([
                '5 000 requests/month',
                '5 requests/minute',
                '1 application'
            ]);

        Spark::plan('Barred Owl', 'barred-owl')
            ->price(9)
            ->features([
                '10 000 requests/month',
                '10 requests/minute',
                '5 applications'
            ]);

        Spark::plan('Boreal Owl', 'boreal-owl')
            ->price(29)
            ->features([
                '100 000 requests/month',
                '100 requests/minute',
                '10 applications'
            ]);

        Spark::plan('Snowy Owl', 'snowy-owl')
            ->price(49)
            ->features([
                'Unlimited requests/month',
                'Unlimited requests/minute',
                'Unlimited applications'
            ]);
    }

    public function register()
    {
        Spark::useUserModel('Snikpik\User');
        Spark::useTeamModel('Snikpik\Team');
    }
}
