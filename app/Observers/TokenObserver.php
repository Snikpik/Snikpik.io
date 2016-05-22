<?php

namespace Snikpik\Observers;

use Illuminate\Http\Request;
use Laravel\Spark\Token;
use Snikpik\AllowedDomain;

/**
 * Class TokenObserver
 * @package Snikpik\Observers
 */
class TokenObserver
{
    /**
     * @var Request
     */
    protected $request;

    /**
     * TokenObserver constructor.
     * @param Request $request
     */
    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    /**
     * @param Token $token
     */
    public function created(Token $token)
    {
        $domain = new AllowedDomain($this->request->only('domain'));
        $domain->token()->associate($token);
        $domain->save();
    }

    /**
     * @param Token $token
     */
    public function deleting(Token $token)
    {
        $token->origin->delete();
    }
}