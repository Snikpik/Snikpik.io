<?php

namespace Snikpik\Http\Controllers\API\v1;

use Illuminate\Http\Request;
use Snikpik\Http\Controllers\API\ApiController;
use Snikpik\Services\PreviewEngine;

/**
 * Class SnikpikController
 * @package Snikpik\Http\Controllers\API\v1
 */
class SnikpikController extends ApiController
{

    public function snikpik(Request $request, PreviewEngine $preview)
    {
        $webpage = $preview->webpage($request->get('url'));

        return view('test', compact('webpage'));
    }
}
