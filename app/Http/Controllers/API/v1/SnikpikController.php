<?php

namespace Snikpik\Http\Controllers\API\v1;

use Illuminate\Http\Request;
use Snikpik\Http\Controllers\API\ApiController;
use Snikpik\Services\PreviewEngine;
use Snikpik\Transformers\WebpageTransformer;

/**
 * Class SnikpikController
 * @package Snikpik\Http\Controllers\API\v1
 */
class SnikpikController extends ApiController
{
    /**
     * @param Request $request
     * @param PreviewEngine $preview
     * @return \Illuminate\Http\JsonResponse
     */
    public function snikpik(Request $request, PreviewEngine $preview)
    {
        $webpage = $preview->webpage($request->get('url'));

        return response()->json($this->itemResponse(new WebpageTransformer, $webpage));
    }
}
