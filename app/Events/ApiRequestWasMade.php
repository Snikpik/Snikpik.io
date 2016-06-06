<?php

namespace Snikpik\Events;

use Illuminate\Queue\SerializesModels;
use Laravel\Spark\Token;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Snikpik\Http\Requests\Request;
use Snikpik\RequestRecord;

/**
 * Class ApiRequestWasMade
 * @package Snikpik\Events
 */
class ApiRequestWasMade extends Event
{
    use SerializesModels;

    /**
     * @var Token
     */
    public $apiToken;

    /**
     * @var RequestRecord
     */
    public $request;

    /**
     * Create a new event instance.
     * @param Token $apiToken
     * @param RequestRecord $request
     */
    public function __construct(Token $apiToken, RequestRecord $request)
    {
        $this->apiToken = $apiToken;
        $this->request = $request;
    }

    /**
     * Get the channels the event should be broadcast on.
     *
     * @return array
     */
    public function broadcastOn()
    {
        return [];
    }
}
