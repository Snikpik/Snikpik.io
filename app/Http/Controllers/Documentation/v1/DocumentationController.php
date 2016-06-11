<?php

namespace Snikpik\Http\Controllers\Documentation\v1;

use Illuminate\Http\Request;

use Snikpik\Http\Controllers\Controller;
use Snikpik\Http\Requests;

/**
 * Class DocumentationController
 * @package Snikpik\Http\Controllers
 */
class DocumentationController extends Controller
{
    /**
     * Documentation main page
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        return view('docs.v1.index');
    }

    /**
     * Release Notes
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function faq()
    {
        return view('docs.v1.faq');
    }

    /**
     * Release Notes
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function releaseNotes()
    {
        return view('docs.v1.release-notes');
    }
}
