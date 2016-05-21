<?php

namespace Snikpik\Transformers;

use League\Fractal\TransformerAbstract;

/**
 * Class EmbedTransformer
 * @package Snikpik\Transformers
 */
class EmbedTransformer extends TransformerAbstract
{
    /**
     * @param string $embed
     * @return array
     */
    public function transform(string $embed)
    {
        return [
            'code' => preg_replace("/(style{1})=[\"']?((?:.(?![\"']?\s+(?:\S+)=|[>\"']))+.)[\"']?/", '', $embed)
        ];
    }
}