<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Events\OpLog;
use App\Permissions;
use Gate;

class PermissionController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('auth');

    }

    public function index(Request $request)
    {
        event(new OpLog());
        if (Gate::denies('enter', new Permissions())) {
            abort(403);
        }

        $permission = new Permissions();

        $permission_lists = $permission->all();
        $view_data = [
            'permission_lists' => $permission_lists
        ];

        return view('permission.list', $view_data);

    }

}