<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Events\OpLog;
use App\Branches;
use Gate;


class BrancheController extends Controller
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
        if (Gate::denies('enter', new Branches())) {
            abort(403);
        }

        $filter_orgid = $request->input('filter_orgid');
        $filter_node_id = $request->input('filter_node_id');
        $filter_market = $request->input('filter_market');
        $filter_prefix = $request->input('filter_prefix');
        $filter_mkt_branch_id = $request->input('filter_mkt_branch_id');

        $query = $request->input();
        $page = empty($query['page']) ? 1 : max(1, intval($query['page']));
        unset($query['page']);
        $branches_query = Branches::query();
        if ($filter_orgid){
            $branches_query->where('org_id', '=', $filter_orgid);
        }
        if ($filter_node_id){
            $branches_query->where('jzjy_node_id', '=', $filter_node_id);
        }
        if ($filter_market){
            $branches_query->where('market', '=', $filter_market);
        }
        if ($filter_prefix){
            $branches_query->where('prefix', '=', $filter_prefix);
        }
        if ($filter_mkt_branch_id){
            $branches_query->where('mkt_branch_id', '=', $filter_mkt_branch_id);
        }
        $branches_query->orderBy('org_id', 'ASC');

        $branche_lists = $branches_query->paginate()->appends($query);

        $view_data = [
            'branche_lists' => $branche_lists,
            'page' => $page,
            'query' => $query
        ];

        return view('branche.list', $view_data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        event(new OpLog());

        $server_types = ServerTypes::getMap();

        return view('server.create', ['server_types'=>$server_types]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store(Request $request)
    {

        event(new OpLog());

        if ($server->save()) {
            return Redirect::to('server/'.$id);
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
        event(new OpLog($id));

        $server = Servers::find($id);
        $server_types = ServerTypes::getMap();

        return view('server.edit', ['server'=>$server, 'server_types'=>$server_types]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function update(Request $request, $id)
    {
        $id = $request['id'];
        $server = Servers::find($id);
        if (!$server){
            return Redirect::back()->withInput()->withErrors('不存在该服务器配置！');
        }

        event(new OpLog($id));

        if ($server->save()) {
            return Redirect::to('server/'.$id);
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
        $server = Servers::find($id);
        if (!$server){
            $ret['error_code'] = -1;
            $ret['error_message'] = '不存在';
        } else {
            if ($server->status != -1 ){
                $server->status = -1;
                if (!$server->save()) {
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

        $server = Servers::find($id);
        if (!$server){
            return Redirect::back()->withInput()->withErrors('不存在该服务器配置！');
        }

        $server_types = ServerTypes::getMap();
        return view('server.show', ['server'=>$server, 'server_types'=>$server_types]);
    }
}
