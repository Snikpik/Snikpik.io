<?php

namespace Snikpik\Listeners\Slack;

use Laravel\Spark\Events\Subscription\SubscriptionCancelled;
use Slack;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

/**
 * Class UserHasCancelledSubscription
 * @package Snikpik\Listeners\Slack
 */
class UserHasCancelledSubscription implements ShouldQueue
{
    /**
     * Handle the event.
     *
     * @param  SubscriptionCancelled  $event
     * @return void
     */
    public function handle(SubscriptionCancelled $event)
    {
        $subscription = $event->user->sparkPlan();

//        if(!is_null($subscription)) {
            Slack::send("{$event->user->name} just cancelled his subscription to {$subscription->name} plan on Snikpik!\n{$event->user->email}");
//        }
    }
}
