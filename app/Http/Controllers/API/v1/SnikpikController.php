<?php

namespace Snikpik\Http\Controllers\API\v1;

use Snikpik\Events\ApiRequestWasMade;
use Snikpik\Http\Controllers\API\ApiController;
use Snikpik\Http\Requests\API\v1\SnikpikForm;
use Snikpik\RequestRecord;
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
    public function preview(SnikpikForm $request, PreviewEngine $preview)
    {
        $webpage = $preview->webpage($request->get('url'));

        event(
            new ApiRequestWasMade(
                auth()->user()->token(),
                new RequestRecord($request->get('url'), $request->ip(), $request->header('Origin', ''))
            )
        );

        return response()->json($this->itemResponse(new WebpageTransformer, $webpage));
    }
}
