<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Events\OpLog;
use App\Records;
use Gate;

class RecordController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request)
    {
        event(new OpLog());
        if (Gate::denies('enter', new Records())) {
            abort(403);
        }

        $filter_rec_no = (int) $request->input('filter_rec_no');
        $filter_node_id = (int) $request->input('filter_node_id');
        $filter_server_id = (int) $request->input('filter_server_id');
        $filter_user_id = (int) $request->input('filter_user_id');
        $filter_fund_id = $request->input('filter_fund_id');
        $filter_stock_code = $request->input('filter_stock_code');

        $query = $request->input();
        $page = empty($query['page']) ? 1 : max(1, intval($query['page']));
        unset($query['page']);
        $records = Records::query();
        if ($filter_rec_no){
            $records->where('RecNo', '=', $filter_rec_no);
        }
        if ($filter_node_id){
            $records->where('NodeID', '=', $filter_node_id);
        }
        if ($filter_server_id){
            $records->where('ServerID', '=', $filter_server_id);
        }
        if ($filter_user_id){
            $records->where('UserID', '=', $filter_user_id);
        }
        if ($filter_fund_id){
            $records->where('FundAcc', '=', $filter_fund_id);
        }
        if ($filter_stock_code){
            $records->where('StockCode', '=', $filter_stock_code);
        }

        $record_lists = $records->paginate()->appends($query);

        $re = new Records();
        $date = $re->getDate();

        $view_data = [
            'record_lists'=>$record_lists,
            'page'=>$page,
            'date'=>$date,
            'query'=>$query
        ];

        return view('record.list', $view_data);
    }

    public function show($id)
    {
        event(new OpLog($id));

        $record = Records::find($id);
        return view('record.show', ['id'=>$id, 'record'=>$record]);
    }
}