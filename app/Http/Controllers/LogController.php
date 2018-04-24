<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\OpLogs;
use Auth;
use Gate;

class logController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request)
    {
        if (Gate::denies('enter', new OpLogs())) {
            abort(403);
        }

        $filter_id = $request->input('filter_id');
        $filter_username = $request->input('filter_username');
        $filter_controller = $request->input('filter_controller');
        $filter_action = $request->input('filter_action');
        $filter_begin_date = $request->input('filter_begin_date');
        $filter_end_date = $request->input('filter_end_date');

        $query = $request->input();
        $page = empty($query['page']) ? 1 : max(1, intval($query['page']));
        unset($query['page']);
        $logs = OpLogs::query();
        if ($filter_id){
            $logs->where('id', '=', $filter_id);
        }
        if ($filter_username){
            $logs->where('username', '=', $filter_username);
        }
        if ($filter_controller){
            $filter_controller = "App\\Http\\Controllers\\{$filter_controller}Controller";
            $logs->where('controller', '=', $filter_controller);
        }
        if ($filter_action){
            $logs->where('action', '=', $filter_action);
        }
        if ($filter_begin_date){
            $filter_begin_date = date('Y-m-d H:i:s', strtotime($filter_begin_date));
            $logs->where('created_at', '>=', $filter_begin_date);
        }
        if ($filter_end_date){
            $filter_end_date = date('Y-m-d H:i:s', strtotime($filter_end_date));
            $logs->where('created_at', '<=', $filter_end_date);
        }
        $logs->orderBy('id', 'DESC');

        $log_lists = $logs->paginate()->appends($query);

        $view_data = [
            'log_lists' => $log_lists,
            'page' => $page,
            'query' => $query
        ];

        return view('log.list', $view_data);
    }

}