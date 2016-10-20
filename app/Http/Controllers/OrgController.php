<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Events\OpLog;
use App\Orgs;
use Auth;
use Gate;

class OrgController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request)
    {
        event(new OpLog());
        if (Gate::denies('enter', new Orgs())) {
            abort(403);
        }

        $filter_org_id = $request->input('filter_org_id');
        $filter_org_name = $request->input('filter_org_name');

        $query = $request->input();
        $page = empty($query['page']) ? 1 : max(1, intval($query['page']));
        unset($query['page']);
        $orgs = Orgs::query();
        if ($filter_org_id){
            $orgs->where('orgid', '=', $filter_org_id);
        }
        if ($filter_org_name){
            $orgs->where('orgname', 'like', '%'.$filter_org_name.'%');
        }
        $orgs->where('status', '=', 0);

        $org_lists = $orgs->paginate()->appends($query);

        $view_data = [
            'org_lists' => $org_lists,
            'page' => $page,
            'query' => $query
        ];

        return view('org.list', $view_data);
    }

    public function show($id)
    {
        event(new OpLog($id));

        $org = Orgs::findOrFail($id);

        return view('org.show', ['org'=>$org]);
    }
}