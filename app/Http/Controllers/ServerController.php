<?php

namespace App\Http\Controllers;

use App\ServerTypes;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Events\OpLog;
use App\Servers;
use App\Records;
use Redirect;
use Gate;
use Auth;

class ServerController extends Controller
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

        if (Gate::denies('enter', new Servers())) {
            abort(403);
        }

        $filter_id = (int) $request->input('filter_id');

        $query = $request->input();
        $page = empty($query['page']) ? 1 : max(1, intval($query['page']));
        unset($query['page']);
        $servers = Servers::query();
        if ($filter_id){
            $servers->where('id', '=', $filter_id);
        }
        $servers->where('status', '=', 0);

        $server_lists = $servers->paginate()->appends($query);

        $re = new Records();
        $date = $re->getDate();

        $server_types = ServerTypes::getMap();

        $view_data = [
            'server_lists' => $server_lists,
            'server_types' => $server_types,
            'page' => $page,
            'date' => $date,
            'query' => $query
        ];

        return view('server.list', $view_data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        event(new OpLog());

        if (Gate::denies('enter', new Servers())) {
            abort(403);
        }

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

        $ip = $request->input('ip');
        $port = (int) $request->input('port');

        $this->validate($request, [
            'id' => 'required|integer|unique:xtp_server,id|max:9999',
            'server_name' => 'required|unique:xtp_server,server_name|max:32',
            'server_summary' => '',
            'max_connection' => 'required|numeric',
            'ip' => 'required|ip|unique:xtp_server,ip,NULL,id,port,'.$port,
            'port' => 'required|integer|max:65535|unique:xtp_server,port,NULL,id,ip,'.$ip,
            'status_type' => 'required|integer',
            'main_type' => 'required|exists:xtp_server_type,main_type|integer',
            'sub_type' => 'required|exists:xtp_server_type,sub_type|integer',
        ]);

        $id =  (int) $request->input('id');

        $server = new Servers();

        if (Gate::denies('enter', $server)) {
            abort(403);
        }

        $server->id = $id;
        $server->server_name = $request->input('server_name');
        $server->server_summary = $request->input('server_summary');
        $server->max_connection = $request->input('max_connection');
        $server->ip = $ip;
        $server->port = $port;
        $server->status_type = (int) $request->input('status_type');
        $server->main_type = (int) $request->input('main_type');
        $server->sub_type = (int) $request->input('sub_type');
        $server->is_available = (int) $request->input('is_available');

        $ret = $server->save();
        event(new OpLog($server));

        if ($ret) {
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

        $server = Servers::findOrFail($id);
        $server_types = ServerTypes::getMap();

        if (Gate::denies('enter', $server)) {
            abort(403);
        }

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
        $server = Servers::findOrFail($id);

        if (Gate::denies('enter', $server)) {
            abort(403);
        }

        $ip = $request->input('ip');
        $port = (int) $request->input('port');

        $this->validate($request, [
            'server_name' => 'required|unique:xtp_server,server_name,'.$id.',id|max:32',
            'server_summary' => '',
            'max_connection' => 'required|numeric',
            'ip' => 'required|ip',
            'port' => 'required|integer|max:65535|unique:xtp_server,port,'.$id.',id,ip,'.$ip,
            'status_type' => 'required|integer',
            'main_type' => 'required|exists:xtp_server_type,main_type|integer',
            'sub_type' => 'required|exists:xtp_server_type,sub_type|integer',
        ]);

        $server->server_name = $request->input('server_name');
        $server->server_summary = $request->input('server_summary');
        $server->max_connection = $request->input('max_connection');
        $server->ip = $request->input('ip');
        $server->port = (int) $request->input('port');
        $server->status_type = (int) $request->input('status_type');
        $server->main_type = (int) $request->input('main_type');
        $server->sub_type = (int) $request->input('sub_type');
        $server->is_available = (int) $request->input('is_available');

        event(new OpLog($server));

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
            $ret['error_message'] = '服务器不存在';
        } else {

            if (Gate::denies('enter', $server)) {
                abort(403);
            }

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

        $server = Servers::findOrFail($id);

        if (Gate::denies('enter', $server)) {
            abort(403);
        }

        $server_types = ServerTypes::getMap();
        return view('server.show', ['server'=>$server, 'server_types'=>$server_types]);
    }
}
