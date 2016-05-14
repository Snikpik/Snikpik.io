<?php

namespace Snikpik\Providers;

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
        Spark::useStripe()->noCardUpFront()->trialDays(10);

        Spark::freePlan()
            ->features([
                'First', 'Second', 'Third'
            ]);

        Spark::plan('Basic', 'provider-id-1')
            ->price(10)
            ->features([
                'First', 'Second', 'Third'
            ]);
    }

    public function register()
    {
        Spark::useUserModel('Snikpik\User');
        Spark::useTeamModel('Snikpik\Team');
    }
}
