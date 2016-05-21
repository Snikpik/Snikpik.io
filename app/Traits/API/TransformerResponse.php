<?php

namespace Snikpik\Traits\API;

use Illuminate\Pagination\LengthAwarePaginator;
use League\Fractal;
use League\Fractal\Manager;
use League\Fractal\Serializer\DataArraySerializer;
use League\Fractal\TransformerAbstract;

/**
 * Trait TransformerResponse
 * @package Snikpik\Traits\API
 */
trait TransformerResponse
{

    /**
     * Return a transformed item
     * @param TransformerAbstract $transformer
     * @param mixed $data
     * @return string
     */
    public function itemResponse(TransformerAbstract $transformer, $data)
    {
        $manager = new Manager();
        $manager->setSerializer(new DataArraySerializer());

        if (property_exists($this, 'request') && $this->request->has('include')) {
            $manager->parseIncludes($this->request->get('include'));
        }

        $item = new Fractal\Resource\Item($data, $transformer);

        return $manager->createData($item)->toArray();
    }

    /**
     * Return a transformed collection
     * @param TransformerAbstract $transformer
     * @param mixed $data
     * @return string
     */
    public function collectionResponse(TransformerAbstract $transformer, $data)
    {
        $manager = new Manager();
        $manager->setSerializer(new DataArraySerializer())->parseIncludes(['memberships']);

        if (property_exists($this, 'request') && $this->request->has('include')) {
            $manager->parseIncludes($this->request->get('include'));
        }

        if ($data instanceof LengthAwarePaginator) {
            $collection = new Fractal\Resource\Collection($data->getCollection(), $transformer);
            $collection->setPaginator(new Fractal\Pagination\IlluminatePaginatorAdapter($data));
        } else {
            $collection = new Fractal\Resource\Collection($data, $transformer);
        }

        return $manager->createData($collection)->toArray();
    }

}