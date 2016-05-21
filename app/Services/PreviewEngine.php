<?php

namespace Snikpik\Services;

use Embed\Adapters\Webpage;
use Embed\Embed;

/**
 * Class PreviewEngine
 * @package Snikpik\Services
 */
class PreviewEngine
{
    /**
     * @var Embed
     */
    private $scrapper;

    /**
     * PreviewEngine constructor.
     * @param Embed $scrapper
     */
    public function __construct(Embed $scrapper)
    {
        $this->scrapper = $scrapper;
    }

    /**
     * @param string $url
     * @return Webpage
     * @throws \Embed\Exceptions\InvalidUrlException
     */
    public function webpage(string $url) : Webpage
    {
        return $this->scrapper->create($url);
    }
}