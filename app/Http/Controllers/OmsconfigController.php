<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Events\OpLog;
use App\OmsConfigs;
use App\Servers;
use Redirect;
use Auth;
use Gate;

class OmsConfigController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request)
    {

        event(new OpLog());
        if (Gate::denies('enter', new OmsConfigs())) {
            abort(403);
        }

        $filter_id = $request->input('filter_id');
        $filter_ogw_id = $request->input('filter_ogw_id');
        $filter_prefix = $request->input('filter_prefix');

        $query = $request->input();
        $page = empty($query['page']) ? 1 : max(1, intval($query['page']));
        unset($query['page']);
        $omsconfigs = omsconfigs::query();
        if ($filter_id){
            $omsconfigs->where('id', '=', $filter_id);
        }
        if ($filter_prefix){
            $omsconfigs->where('prefix', '=', $filter_prefix);
        }
        $omsconfigs->where('status', '=', 0);

        $omsconfig_lists = $omsconfigs->paginate()->appends($query);

        $view_data = [
            'omsconfig_lists' => $omsconfig_lists,
            'page' => $page,
            'query' => $query
        ];

        return view('omsconfig.list', $view_data);
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        event(new OpLog());

        $oms_lists = Servers::where('main_type', 3)->where('sub_type', 0)->get();
        $ogws_sh = Servers::where('main_type', 4)->where('sub_type', 0)->get();
        $ogws_sz = Servers::where('main_type', 4)->where('sub_type', 1)->get();

        $view_data = [
            'oms_lists' => $oms_lists,
            'ogws_sh' => $ogws_sh,
            'ogws_sz' => $ogws_sz,
        ];

        return view('omsconfig.create', $view_data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'oms_id' => 'required|unique:xtp_oms_config,oms_id|exists:xtp_server,id|integer',
            'ogw_sh_id' => 'required|exists:xtp_server,id|integer',
            'ogw_sz_id' => 'required|exists:xtp_server,id|integer',
        ]);

        $omsconfig = new omsconfigs();
        $omsconfig->oms_id = $request->input('oms_id');
        $omsconfig->ogw_sh_id = $request->input('ogw_sh_id');
        $omsconfig->ogw_sz_id = $request->input('ogw_sz_id');

        $ret = $omsconfig->save();
        event(new OpLog($omsconfig));

        if ($ret) {
            return Redirect::to('omsconfig/'.$omsconfig->id);
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

        $omsconfig = omsconfigs::findOrFail($id);

        $oms_lists = Servers::where('main_type', 3)->where('sub_type', 0)->get();
        $ogws_sh = Servers::where('main_type', 4)->where('sub_type', 0)->get();
        $ogws_sz = Servers::where('main_type', 4)->where('sub_type', 1)->get();

        $view_data = [
            'omsconfig' => $omsconfig,
            'oms_lists' => $oms_lists,
            'ogws_sh' => $ogws_sh,
            'ogws_sz' => $ogws_sz,
        ];

        return view('omsconfig.edit', $view_data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function update(Request $request, $id)
    {
        $omsconfig = omsconfigs::findOrFail($id);
        $oms_id = $request->input('oms_id');

        $this->validate($request, [
            'oms_id' => 'required|unique:xtp_oms_config,oms_id,'.$id.',id|exists:xtp_server,id|integer',
            'ogw_sh_id' => 'required|exists:xtp_server,id|integer',
            'ogw_sz_id' => 'required|exists:xtp_server,id|integer',
        ]);

        $omsconfig->oms_id = $request->input('oms_id');
        $omsconfig->ogw_sh_id = $request->input('ogw_sh_id');
        $omsconfig->ogw_sz_id = $request->input('ogw_sz_id');

        event(new OpLog($omsconfig));

        if ($omsconfig->save()) {
            return Redirect::to('omsconfig/'.$id);
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
        $omsconfig = omsconfigs::findOrFail($id);

        if ($omsconfig->status != -1 ){
            $omsconfig->status = -1;
            if (!$omsconfig->save()) {
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

        $omsconfig = omsconfigs::findOrFail($id);

        return view('omsconfig.show', ['omsconfig'=>$omsconfig]);
    }

}