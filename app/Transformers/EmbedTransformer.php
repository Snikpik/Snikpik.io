<?php

namespace Snikpik\Transformers;

use Embed\Adapters\Webpage;
use League\Fractal\TransformerAbstract;

/**
 * Class EmbedTransformer
 * @package Snikpik\Transformers
 */
class EmbedTransformer extends TransformerAbstract
{
    /**
     * @param Webpage $webpage
     * @return array
     */
    public function transform(Webpage $webpage)
    {
        return [
            'code' => preg_replace("/(style{1})=[\"']?((?:.(?![\"']?\s+(?:\S+)=|[>\"']))+.)[\"']?/", '', $webpage->code),
            'aspect_ratio' => $webpage->aspectRatio
        ];
    }
}