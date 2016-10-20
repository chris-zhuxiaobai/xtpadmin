<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Events\OpLog;
use App\TradeWayTypes;
use Redirect;
use Gate;

class TradeWayTypeController extends Controller
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
        if (Gate::denies('enter', new TradeWayTypes())) {
            abort(403);
        }

        $tradeway_types = TradeWayTypes::where('status', '>=', 0)->get();

        return view('tradewaytype.list', ['tradeway_types'=>$tradeway_types]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        event(new OpLog());

        return view('tradewaytype.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store(Request $request)
    {
        if ($request->input('type') == 1) {
            $trade_way_regexp = 'regex:/^[jk7]$/';
        } else if ($request->input('type') == 2) {
            $trade_way_regexp = 'regex:/^[012Z]\w$/';
        } else if ($request->input('type') == 3) {
            $trade_way_regexp = 'max:3';
        } else {
            $trade_way_regexp = '';
        }
        $this->validate($request, [
            'type' => ['required', 'regex:/^[123345]$/'],
            'value' => ['required', 'unique:xtp_trade_way_type,trade_way', $trade_way_regexp],
            'name' => 'required|unique:xtp_trade_way_type,name|max:64',
            'summary' => ''
        ]);

        $tradewaytype = new TradeWayTypes();
        $tradewaytype->type = $request->input('type');
        $tradewaytype->trade_way = $request->input('value');
        $tradewaytype->name = $request->input('name');
        $tradewaytype->summary = $request->input('summary');

        $ret = $tradewaytype->save();
        event(new OpLog($tradewaytype));

        if ($ret) {
            return Redirect::to('tradewaytype/'.$tradewaytype->id);
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

        $tradeway_type = TradeWayTypes::find($id);

        return view('tradewaytype.edit', ['tradeway_type'=>$tradeway_type]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function update(Request $request, $id)
    {
        $tradewaytype = TradeWayTypes::findOrFail($id);

        if ($request->input('type') == 1) {
            $trade_way_regexp = 'regex:/^[jk7]$/';
        } else if ($request->input('type') == 2) {
            $trade_way_regexp = 'regex:/^[012Z]\w$/';
        } else if ($request->input('type') == 3) {
            $trade_way_regexp = 'max:3';
        } else {
            $trade_way_regexp = '';
        }
        $this->validate($request, [
            'type' => ['required', 'regex:/^[123345]$/'],
            'value' => ['required', 'unique:xtp_trade_way_type,trade_way,'.$id.',id', $trade_way_regexp],
            'name' => 'required|unique:xtp_trade_way_type,name,'.$id.',id|max:64',
            'summary' => ''
        ]);

        $tradewaytype->type = $request->input('type');
        $tradewaytype->trade_way = $request->input('value');
        $tradewaytype->name = $request->input('name');
        $tradewaytype->summary = $request->input('summary');

        event(new OpLog($tradewaytype));

        if ($tradewaytype->save()) {
            return Redirect::to('tradewaytype/'.$id);
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
        $tradewaytype = TradeWayTypes::find($id);
        if (!$tradewaytype){
            $ret['error_code'] = -1;
            $ret['error_message'] = '不存在';
        } else {
            if ($tradewaytype->status != -1 ){
                $tradewaytype->trade_way .= 'D';
                $tradewaytype->status = -1;
                if (!$tradewaytype->save()) {
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

        $tradewaytype = TradeWayTypes::findOrFail($id);

        return view('tradewaytype.show', ['tradewaytype'=>$tradewaytype]);
    }
}
