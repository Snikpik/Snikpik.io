<?php

namespace Snikpik\Listeners\Slack;

use Slack;
use Laravel\Spark\Events\Auth\UserRegistered;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

/**
 * Class UserHasRegistered
 * @package Snikpik\Listeners\Slack
 */
class UserHasRegistered implements ShouldQueue
{
    /**
     * Handle the event.
     *
     * @param  UserRegistered  $event
     * @return void
     */
    public function handle(UserRegistered $event)
    {
        Slack::send("{$event->user->name} just registered on Snikpik!\n{$event->user->email}");
    }
}
