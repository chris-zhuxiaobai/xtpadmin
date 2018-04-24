<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Events\OpLog;
use App\Http\Requests;
use App\Whitelists;
use App\Servers;
use App\TradeWays;
use App\Orgs;
use Redirect;
use Gate;

class WhiteListController extends Controller
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
        if (Gate::denies('enter', new Whitelists())) {
            abort(403);
        }

        $filter_id = $request->input('filter_id');

        $query = $request->input();
        $page = empty($query['page']) ? 1 : max(1, intval($query['page']));
        unset($query['page']);
        $white_lists_query = Whitelists::query();
        if ($filter_id){
            $white_lists_query->where('id', '=', $filter_id);
        }
        $white_lists_query->where('status', '=', 0);

        $white_lists = $white_lists_query->paginate()->appends($query);

        $view_data = [
            'white_lists' => $white_lists,
            'page' => $page,
            'query' => $query
        ];

        return view('whitelist.list', $view_data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        event(new OpLog());

        if (Gate::denies('enter', new Whitelists())) {
            abort(403);
        }

        $quote_lists = Servers::where('main_type', '2')->where('status', '0')->get();
        $trade_lists = Servers::where('main_type', '3')->where('status', '0')->get();
        $org_lists = Orgs::where('status', '0')->get();
        $tradeway_lists = TradeWays::where('status', '0')->get();

        $view_data = [
            'quote_lists'  => $quote_lists,
            'trade_lists'  => $trade_lists,
            'org_lists'  => $org_lists,
            'tradeway_lists'  => $tradeway_lists,
        ];

        return view('whitelist.create', $view_data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|max:32',
            'node_id' => 'required|integer|exists:xtp_branches,jzjy_node_id',
            'accountid' => 'required|unique:xtp_white_list,accountid|max:16',
            'custid' => 'required|unique:xtp_white_list,custid|unique:xtp_user,custid|max:16',
            'fundid' => 'required|unique:xtp_white_list,fundid|unique:xtp_user,fundid|max:16',
            'orgid' => 'required|exists:xtp_org,orgid|numeric',
            'bind_oms' => 'required|exists:xtp_server,id|numeric',
            'bind_quote' => 'required|exists:xtp_server,id|numeric',
            'max_connection' => 'required|numeric',
            'trade_way_id' => 'required|exists:xtp_trade_way,id|numeric'
        ]);

        $whitelist = new Whitelists();

        if (Gate::denies('enter', $whitelist)) {
            abort(403);
        }

        $whitelist->name = $request->input('name');
        $whitelist->node_id = $request->input('node_id');
        $whitelist->accountid = $request->input('accountid');
        $whitelist->custid = $request->input('custid');
        $whitelist->fundid = $request->input('fundid');
        $whitelist->orgid = $request->input('orgid');
        $whitelist->bind_oms = $request->input('bind_oms');
        $whitelist->bind_quote = $request->input('bind_quote');
        $whitelist->max_connection = $request->input('max_connection');
        $whitelist->trade_way_id = $request->input('trade_way_id');

        $ret = $whitelist->save();
        event(new OpLog($whitelist));

        if ($ret) {
            return Redirect::to('whitelist/'.$whitelist->id);
        } else {
            return Redirect::back()->withInput()->withErrors('保存失败！');
        }

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
        event(new OpLog());

        $white_list = Whitelists::findOrFail($id);

        if (Gate::denies('enter', $white_list)) {
            abort(403);
        }

        $quote_lists = Servers::where('main_type', '2')->where('status', '0')->get();
        $trade_lists = Servers::where('main_type', '3')->where('status', '0')->get();
        $org_lists = Orgs::where('status', '0')->get();
        $tradeway_lists = TradeWays::where('status', '0')->get();

        $view_data = [
            'white_list' => $white_list,
            'quote_lists'  => $quote_lists,
            'trade_lists'  => $trade_lists,
            'org_lists'  => $org_lists,
            'tradeway_lists'  => $tradeway_lists,
        ];

        return view('whitelist.edit', $view_data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function update(Request $request, $id)
    {
        $id = $request->input('id');
        $whitelist = Whitelists::findOrFail($id);
        if (!$whitelist){
            return Redirect::back()->withInput()->withErrors('不存在该服务器配置！');
        }

        if (Gate::denies('enter', $whitelist)) {
            abort(403);
        }

        $orgid = $request->input('orgid');

        $this->validate($request, [
            'name' => 'required|max:32',
            'node_id' => 'required|integer|exists:xtp_branches,jzjy_node_id,org_id,'.$orgid,
            'accountid' => 'required|unique:xtp_white_list,accountid,'.$request->input('accountid').',accountid|max:16',
            'custid' => 'required|unique:xtp_white_list,custid,'.$id.',id|unique:xtp_user,custid|max:16',
            'fundid' => 'required|unique:xtp_white_list,fundid,'.$id.',id|unique:xtp_user,fundid|max:16',
            'orgid' => 'required|exists:xtp_org,orgid|numeric',
            'bind_oms' => 'required|exists:xtp_server,id|numeric',
            'bind_quote' => 'required|exists:xtp_server,id|numeric',
            'max_connection' => 'required|numeric',
            'trade_way_id' => 'required|exists:xtp_trade_way,id|numeric'
        ]);

        $whitelist->name = $request->input('name');
        $whitelist->node_id = $request->input('node_id');
        $whitelist->accountid = $request->input('accountid');
        $whitelist->custid = $request->input('custid');
        $whitelist->fundid = $request->input('fundid');
        $whitelist->orgid = $request->input('orgid');
        $whitelist->bind_oms = $request->input('bind_oms');
        $whitelist->bind_quote = $request->input('bind_quote');
        $whitelist->max_connection = $request->input('max_connection');
        $whitelist->trade_way_id = $request->input('trade_way_id');

        event(new OpLog($whitelist));

        if ($whitelist->save()) {
            return Redirect::to('whitelist/'.$id);
        } else {
            return Redirect::back()->withInput()->withErrors('保存失败！');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        event(new OpLog($id));

        $ret = [
            'error_code' => 0,
            'error_message' => ''
        ];
        $whitelist = WhiteLists::find($id);
        if (Gate::denies('enter', $whitelist)) {
            abort(403);
        }
        if (!$whitelist){
            $ret['error_code'] = -1;
            $ret['error_message'] = '不存在';
        } else {
            if ($whitelist->status != -1 ){
                $whitelist->status = -1;
                if (!$whitelist->save()) {
                    $ret['error_code'] = 1;
                    $ret['error_message'] = '保存失败';
                }
            }
        }

        echo json_encode($ret);
    }

    /**
     * Show the page for display resource.
     *
     * @return Response
     */
    public function show($id)
    {
        event(new OpLog($id));

        $white_list = Whitelists::findOrFail($id);

        if (Gate::denies('enter', $white_list)) {
            abort(403);
        }

        return view('whitelist.show', ['white_list'=>$white_list]);
    }


}
