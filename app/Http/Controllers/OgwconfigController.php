<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Events\OpLog;
use App\OgwConfigs;
use App\Servers;
use Redirect;
use Auth;
use Gate;

class OgwConfigController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request)
    {

        event(new OpLog());
        if (Gate::denies('enter', new OgwConfigs())) {
            abort(403);
        }

        $filter_id = $request->input('filter_id');
        $filter_ogw_id = $request->input('filter_ogw_id');
        $filter_prefix = $request->input('filter_prefix');

        $query = $request->input();
        $page = empty($query['page']) ? 1 : max(1, intval($query['page']));
        unset($query['page']);
        $ogwconfigs = ogwconfigs::query();
        if ($filter_id){
            $ogwconfigs->where('id', '=', $filter_id);
        }
        if ($filter_prefix){
            $ogwconfigs->where('prefix', '=', $filter_prefix);
        }
        $ogwconfigs->where('status', '=', 0);

        $ogwconfig_lists = $ogwconfigs->paginate()->appends($query);

        $view_data = [
            'ogwconfig_lists' => $ogwconfig_lists,
            'page' => $page,
            'query' => $query
        ];

        return view('ogwconfig.list', $view_data);
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        event(new OpLog());

        $ogw_lists = Servers::where('main_type', 4)->get();

        $view_data = [
            'ogw_lists' => $ogw_lists,
        ];

        return view('ogwconfig.create', $view_data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'ogw_id' => 'required|unique:xtp_ogw_config,ogw_id|exists:xtp_server,id|integer',
            'pbu_id' => 'required|regex:/^\d{5,6}$/|min:5|max:6',
        ]);

        $ogwconfig = new ogwconfigs();
        $ogwconfig->ogw_id = $request->input('ogw_id');
        $ogwconfig->pbu_id = $request->input('pbu_id');

        $ret = $ogwconfig->save();
        event(new OpLog($ogwconfig));

        if ($ret) {
            return Redirect::to('ogwconfig/'.$ogwconfig->id);
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

        $ogwconfig = ogwconfigs::findOrFail($id);

        $ogw_lists = Servers::where('main_type', 4)->get();

        $view_data = [
            'ogwconfig' => $ogwconfig,
            'ogw_lists' => $ogw_lists
        ];

        return view('ogwconfig.edit', $view_data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function update(Request $request, $id)
    {
        $ogwconfig = ogwconfigs::findOrFail($id);
        $ogw_id = $request->input('ogw_id');

        $this->validate($request, [
            'ogw_id' => 'required|unique:xtp_ogw_config,ogw_id,'.$id.',id|exists:xtp_server,id|integer',
            'pbu_id' => 'required|regex:/^\d{5,6}$/|min:5|max:6',
        ]);

        $ogwconfig->ogw_id = $ogw_id;
        $ogwconfig->pbu_id = $request->input('pbu_id');

        event(new OpLog($ogwconfig));

        if ($ogwconfig->save()) {
            return Redirect::to('ogwconfig/'.$id);
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
        $ogwconfig = ogwconfigs::findOrFail($id);

        if ($ogwconfig->status != -1 ){
            $ogwconfig->status = -1;
            if (!$ogwconfig->save()) {
                $ret['error_code'] = 1;
                $ret['error_message'] = '保存失败';
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

        $ogwconfig = ogwconfigs::findOrFail($id);

        return view('ogwconfig.show', ['ogwconfig'=>$ogwconfig]);
    }

}