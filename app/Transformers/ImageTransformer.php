<?php

namespace Snikpik\Transformers;

use League\Fractal\TransformerAbstract;

/**
 * Class ImageTransformer
 * @package Snikpik\Transformers
 */
class ImageTransformer extends TransformerAbstract
{
    /**
     * @param array $image
     * @return array
     */
    public function transform(array $image)
    {
        return $image;
    }
}