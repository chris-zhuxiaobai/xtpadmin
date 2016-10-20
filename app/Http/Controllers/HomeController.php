<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Events\OpLog;
use Auth;
use App\Api;
use Gate;
use App\Servers;

class HomeController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request)
    {

        event(new OpLog());

        return view('home');

//        dd($request->user());

//        dd(Auth::user());

        $api = new Api();
        $users = $api->users(['userName'=>'xtpadmin']);
        dd($users);

//        dd(Auth::user()->isSuperAdmin());
        $server = new Servers();
//        if (Gate::denies('update', $server)) {
//            abort(403);
//        }

        if (Auth::user()->can('update', $server)) {
            echo 'ok';
        } else  {
            abort(403);
        }

//        if ($request->user()->cannot('update-post', ['user_id'=>448])) {
//            abort(403);
//        }
    }
}
