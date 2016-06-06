<?php

namespace Snikpik;

/**
 * Class RequestRecord
 * @package Snikpik
 */
class RequestRecord
{
    /**
     * @var string
     */
    public $fromOrigin;

    /**
     * @var string
     */
    public $fromIP;

    /**
     * @var string
     */
    public $url;

    /**
     * RequestRecord constructor.
     * @param string $fromOrigin
     * @param string $fromIP
     * @param string $url
     */
    public function __construct(string $url, string $fromIP, string $fromOrigin)
    {
        $this->url = $url;
        $this->fromIP = $fromIP;
        $this->fromOrigin = $fromOrigin;
    }
}