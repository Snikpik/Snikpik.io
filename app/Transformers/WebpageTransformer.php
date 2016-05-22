<?php

namespace Snikpik\Transformers;

use Embed\Adapters\Webpage;
use League\Fractal\TransformerAbstract;

/**
 * Class WebpageTransformer
 * @package Snikpik\Transformers
 */
class WebpageTransformer extends TransformerAbstract
{
    /**
     * @var array
     */
    protected $defaultIncludes = ['images', 'embed'];

    /**
     * @param Webpage $webpage
     * @return array
     */
    public function transform(Webpage $webpage)
    {
        return [
            'type'=> $webpage->type,
            'url' => $webpage->url,
            'title' => $webpage->title,
            'description' => $webpage->description,
            'tags' => $webpage->tags,
            'main_image' => $webpage->image,
            'published_at' => $webpage->publishedTime,
            'provider' => [
                'name' => $webpage->providerName,
                'url' => $webpage->providerUrl,
                'icon' => $webpage->providerIcon
            ],
        ];
    }

    /**
     * @param Webpage $webpage
     * @return \League\Fractal\Resource\Collection
     */
    public function includeImages(Webpage $webpage) {
        return $this->collection($webpage->images, new ImageTransformer);
    }

    /**
     * @param Webpage $webpage
     * @return array|mixed
     */
    public function includeEmbed(Webpage $webpage) {
        if($webpage->type === "video") {
            return $this->item($webpage, new EmbedTransformer);
        }

        if($webpage->type === "rich") {
            return $this->item($webpage, new EmbedTransformer);
        }
    }
}