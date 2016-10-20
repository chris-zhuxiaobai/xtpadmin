<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Events\OpLog;
use App\Orgs;
use Auth;

class AccountController extends Controller
{
    /**
     * construct
     *
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * index
     *
     * @return Response
     */
    public function index(Request $request)
    {
        event(new OpLog());

        return view('account.home');
    }

}