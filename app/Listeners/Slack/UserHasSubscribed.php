<?php

namespace Snikpik\Listeners\Slack;

use Laravel\Spark\Events\Subscription\UserSubscribed;
use Slack;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

/**
 * Class UserHasSubscribed
 * @package Snikpik\Listeners\Slack
 */
class UserHasSubscribed implements ShouldQueue
{
    /**
     * Handle the event.
     *
     * @param  UserSubscribed  $event
     * @return void
     */
    public function handle(UserSubscribed $event)
    {
        Slack::send("{$event->user->name} just subscribed to {$event->plan->name} plan on Snikpik!\n{$event->user->email}");
    }
}
