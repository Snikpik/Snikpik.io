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

        Spark::plan('Spotted Owl', 'spotted-owl')
            ->price(0)
            ->features([
                '5 000 requests/month',
                '5 requests/minute',
                '1 application'
            ])
            ->attributes([
                'max-requests' => 5000,
                'rate-limiting' => 5,
                'max-applications' => 1
            ]);

        Spark::plan('Barred Owl', 'barred-owl')
            ->price(9)
            ->features([
                '10 000 requests/month',
                '10 requests/minute',
                '5 applications'
            ])
            ->attributes([
                'max-requests' => 10000,
                'rate-limiting' => 10,
                'max-applications' => 5
            ]);

        Spark::plan('Boreal Owl', 'boreal-owl')
            ->price(29)
            ->features([
                '100 000 requests/month',
                '100 requests/minute',
                '10 applications'
            ])
            ->attributes([
                'max-requests' => 100000,
                'rate-limiting' => 100,
                'max-applications' => 10
            ]);

        Spark::plan('Snowy Owl', 'snowy-owl')
            ->price(49)
            ->features([
                'Unlimited requests/month',
                'Unlimited requests/minute',
                'Unlimited applications'
            ])
            ->attributes([
                'max-requests' => -1,
                'rate-limiting' => -1,
                'max-applications' => -1
            ]);

        Spark::checkPlanEligibilityUsing(function ($user, $plan) {
            logger('Change of plan');
            if($plan->attribute('max-applications') > 0 and $user->tokens->count() > $plan->attribute('max-applications')) {
                throw IneligibleForPlan::because('You have too many applications. Try deleting applications to downgrade.');
            }

            return true;
        });
    }

    public function register()
    {
        Spark::useUserModel('Snikpik\User');
        Spark::useTeamModel('Snikpik\Team');
    }
}
