<?php

namespace App\Http\Controllers;

use App\Servers;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Events\OpLog;
use App\OgwBranches;
use Redirect;
use Auth;
use Gate;

class OgwBrancheController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request)
    {
        event(new OpLog());
        if (Gate::denies('enter', new OgwBranches())) {
            abort(403);
        }

        $filter_id = $request->input('filter_id');
        $filter_ogw_id = $request->input('filter_ogw_id');
        $filter_prefix = $request->input('filter_prefix');

        $query = $request->input();
        $page = empty($query['page']) ? 1 : max(1, intval($query['page']));
        unset($query['page']);
        $ogwbranches = OgwBranches::query();
        if ($filter_id){
            $ogwbranches->where('id', '=', $filter_id);
        }
        if ($filter_prefix){
            $ogwbranches->where('prefix', '=', $filter_prefix);
        }

        $ogwbranche_lists = $ogwbranches->paginate()->appends($query);

        $view_data = [
            'ogwbranche_lists' => $ogwbranche_lists,
            'page' => $page,
            'query' => $query
        ];

        return view('ogwbranche.list', $view_data);
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        event(new OpLog());

        $ogws = Servers::where('main_type', 4)->where('sub_type', 0)->get();

        $view_data = [
            'ogws' => $ogws
        ];

        return view('ogwbranche.create', $view_data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store(Request $request)
    {

        $sno_start = $request->input('sno_start');
        $this->validate($request, [
            'ogw_id' => 'required|exists:xtp_server,id|integer',
            'prefix' => 'required|integer|max:9999',
            'sno_start' => 'required_unless:is_whole,1|integer',
            'sno_end' => 'required_unless:is_whole,1|integer|min:'.$sno_start,
            'is_whole' => 'boolean',
        ]);

        $ogwbranche = new OgwBranches();
        $ogwbranche->xogw_id = $request->input('ogw_id');
        $ogwbranche->branch_prefix = $request->input('prefix');
        $ogwbranche->is_whole = (int) $request->input('is_whole');
        if ($ogwbranche->is_whole){
            $ogwbranche->sno_start = 0;
            $ogwbranche->sno_end = 0;
        } else {
            $ogwbranche->sno_start = $request->input('sno_start');
            $ogwbranche->sno_end = $request->input('sno_end');
        }

        $ret = $ogwbranche->save();
        event(new OpLog($ogwbranche));

        if ($ret) {
            return Redirect::to('ogwbranche/'.$ogwbranche->id);
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

        $ogwbranche = OgwBranches::findOrFail($id);
        $ogws = Servers::where('main_type', 4)->where('sub_type', 0)->get();

        $view_data = [
            'ogwbranche' => $ogwbranche,
            'ogws' => $ogws
        ];

        return view('ogwbranche.edit', $view_data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function update(Request $request, $id)
    {
        $ogwbranche = OgwBranches::findOrFail($id);

        $branch_prefix = $request->input('prefix');
        $sno_start = $request->input('sno_start');

        $this->validate($request, [
            'ogw_id' => 'required|exists:xtp_server,id|integer',
            'prefix' => 'required|integer|max:9999',
            'sno_start' => 'required_unless:is_whole,1|integer',
            'sno_end' => 'required_unless:is_whole,1|integer|min:'.$sno_start,
            'is_whole' => 'boolean',
        ]);

        $ogwbranche->xogw_id = $request->input('ogw_id');
        $ogwbranche->branch_prefix = $request->input('prefix');
        $ogwbranche->is_whole = (int) $request->input('is_whole');
        if ($ogwbranche->is_whole){
            $ogwbranche->sno_start = 0;
            $ogwbranche->sno_end = 0;
        } else {
            $ogwbranche->sno_start = $request->input('sno_start');
            $ogwbranche->sno_end = $request->input('sno_end');
        }

        event(new OpLog($ogwbranche));

        if ($ogwbranche->save()) {
            return Redirect::to('ogwbranche/'.$id);
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
        $ogwbranche = OgwBranches::findOrFail($id);

        if (!$ogwbranche->delete()){
            $ret['error_code'] = 1;
            $ret['error_message'] = '保存失败';
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

        $ogwbranche = OgwBranches::findOrFail($id);

        return view('ogwbranche.show', ['ogwbranche'=>$ogwbranche]);
    }

}