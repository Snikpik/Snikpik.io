<?php

namespace Snikpik\Listeners\Slack;

use Laravel\Spark\Events\Subscription\SubscriptionUpdated;
use Slack;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

/**
 * Class UserHasUpdatedSubscription
 * @package Snikpik\Listeners\Slack
 */
class UserHasUpdatedSubscription implements ShouldQueue
{
    /**
     * Handle the event.
     *
     * @param  SubscriptionUpdated  $event
     * @return void
     */
    public function handle(SubscriptionUpdated $event)
    {
        $subscription = $event->user->sparkPlan();

        if(!is_null($subscription)) {
            Slack::send("{$event->user->name} just updated his subscription to {$subscription->name} plan on Snikpik!\n{$event->user->email}");
        } else {
            Slack::send("{$event->user->name} just updated his subscription plan on Snikpik!\n{$event->user->email}");
        }
    }
}
