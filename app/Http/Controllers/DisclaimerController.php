<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DisclaimerController extends Controller
{
    /**
     * Disclaimer constructor
     *
     * @return void.
     */
    public function __construct()
    {
        // $this->middleware('lang');
    }

    /**
     * Show the disclaimer page.
     *
     * @return void
     */
    public function index()
    {
        $data['title'] = 'Disclaimer';
        return view('disclaimer', $data);
    }
}
