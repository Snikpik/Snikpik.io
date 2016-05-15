<?php

namespace Snikpik\Http\Controllers\API;

use Illuminate\Http\Response;
use Snikpik\Http\Controllers\Controller;
use Snikpik\Traits\API\TransformerResponse;

/**
 * Class ApiController
 * @package Snikpik\Http\Controllers\API
 */
class ApiController extends Controller
{

    use TransformerResponse;

    /**
     * Response 200 - OK
     * @param $data
     * @return mixed
     */
    public function responseOk($data)
    {
        return response()->json($data, Response::HTTP_OK);
    }
}