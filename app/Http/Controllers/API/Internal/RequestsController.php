<?php

namespace Snikpik\Http\Controllers\API\Internal;

use Illuminate\Http\Request;

use Snikpik\Http\Requests;
use Snikpik\Http\Controllers\Controller;

/**
 * Class RequestsController
 * @package Snikpik\Http\Controllers\API\Internal
 */
class RequestsController extends Controller
{
    /**
     * @param Request $request
     * @return mixed
     */
    public function index(Request $request)
    {
        $requests = auth()->user()->requests()
            ->latest()->with('token')->whereHas('token', function($query) use ($request) {
              $query->when($request->has('filter'), function($query) use ($request) {
                $query->whereName($request->get('filter'));
              });
            })
            ->paginate(25);

        $requests->map(function($request) {
            $request->makeVisible(['token', 'token_id', 'id']);
        });

        return $requests;
    }
}
