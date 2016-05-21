<?php

namespace Snikpik\Http\Controllers\API\v1;

use Snikpik\Http\Controllers\API\ApiController;
use Snikpik\Http\Requests\API\v1\SnikpikForm;
use Snikpik\Services\PreviewEngine;
use Snikpik\Transformers\WebpageTransformer;

/**
 * Class SnikpikController
 * @package Snikpik\Http\Controllers\API\v1
 */
class SnikpikController extends ApiController
{
    /**
     * @param SnikpikForm $request
     * @param PreviewEngine $preview
     * @return \Illuminate\Http\JsonResponse
     */
    public function snikpik(SnikpikForm $request, PreviewEngine $preview)
    {
        $webpage = $preview->webpage($request->get('url'));

        return response()->json($this->itemResponse(new WebpageTransformer, $webpage));
    }
}
