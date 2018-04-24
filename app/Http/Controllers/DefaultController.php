<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Events\OpLog;
use Auth;
use Redirect;

class DefaultController extends Controller
{

    public function index(Request $request)
    {
        event(new OpLog());

        if (!Auth::guest()){
            return Redirect::to('home');
        }

        return view('default');
    }
}