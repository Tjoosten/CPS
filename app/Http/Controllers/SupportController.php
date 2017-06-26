<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

/**
 * Class SupportController
 *
 * @package App\Http\Controllers
 */
class SupportController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Helpdesk index view.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $data['title'] = 'Helpdesk';
        return view('helpdesk.index', $data);
    }
}
