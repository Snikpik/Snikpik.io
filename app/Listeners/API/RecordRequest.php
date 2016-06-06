<?php

namespace Snikpik\Listeners\API;

use Snikpik\Events\ApiRequestWasMade;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Snikpik\Request;

class RecordRequest implements ShouldQueue
{
    use InteractsWithQueue;

    /**
     * Handle the event.
     *
     * @param  ApiRequestWasMade  $event
     * @return void
     */
    public function handle(ApiRequestWasMade $event)
    {
        $request = new Request([
            'from_ip' => $event->request->fromIP,
            'from_origin' => $event->request->fromOrigin,
            'url' => $event->request->url
        ]);
        $request->token()->associate($event->apiToken);
        $request->save();

        logger('ApiRequestWasMade', $request->toArray());
    }
}
