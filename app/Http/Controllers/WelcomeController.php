<?php

namespace Snikpik\Http\Controllers;

/**
 * Class WelcomeController
 * @package Snikpik\Http\Controllers
 */
class WelcomeController extends Controller
{
    /**
     * WelcomeController constructor.
     */
    public function __construct()
    {
        $this->middleware('guest');
    }
    /**
     * Show the application splash screen.
     *
     * @return Response
     */
    public function show()
    {
        return view('welcome');
    }
}
