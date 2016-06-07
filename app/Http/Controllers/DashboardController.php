<?php

namespace Snikpik\Http\Controllers;

/**
 * Class DashboardController
 * @package Snikpik\Http\Controllers
 */
class DashboardController extends Controller
{
    /**
     * Show the application dashboard.
     * @return Response
     */
    public function show()
    {
        return view('dashboard');
    }
}
