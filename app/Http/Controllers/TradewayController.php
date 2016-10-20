<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Events\OpLog;
use App\TradeWays;
use App\TradeWayTypes;
use Redirect;
use Gate;

class TradeWayController extends Controller
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
        if (Gate::denies('enter', new TradeWays())) {
            abort(403);
        }

        $tradeways = TradeWays::where('status', '>=', 0)->get();

        return view('tradeway.list', ['tradeways'=>$tradeways]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        event(new OpLog());

        $tradeway_types = TradeWayTypes::getMap();

        return view('tradeway.create', ['tradeway_types'=>$tradeway_types]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store(Request $request)
    {
        $trade_way_regexp = $request->input('type') == 1 ? 'regex:/^[jk7]$/' : 'regex:/^[012Z]\w$/';
        $this->validate($request, [
            'type1' => 'required|exists:xtp_trade_way_type,id',
            'type2' => 'required|exists:xtp_trade_way_type,id',
            'type3' => 'required|exists:xtp_trade_way_type,id',
            'name' => 'required|unique:xtp_trade_way,name|max:64',
            'summary' => ''
        ]);

        $tradeway = new TradeWays();
        $tradeway->name = $request->input('name');
        $tradeway->type1_id = $request->input('type1');
        $tradeway->type2_id = $request->input('type2');
        $tradeway->type3_id = $request->input('type3');
        $tradeway->key = md5($tradeway->name . ',' . $tradeway->type1_id . ',' . $tradeway->type2_id . ',' . $tradeway->type3_id);
        $tradeway->summary = $request->input('summary');

        $ret = $tradeway->save();
        event(new OpLog($tradeway));

        if ($ret) {
            return Redirect::to('tradeway/'.$tradeway->id);
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

        $tradeway = TradeWays::find($id);
        $tradeway_types = TradeWayTypes::getMap();

        return view('tradeway.edit', ['tradeway'=>$tradeway, 'tradeway_types'=>$tradeway_types]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function update(Request $request, $id)
    {
        $tradeway = TradeWays::findOrFail($id);

        $this->validate($request, [
            'type1' => 'required|exists:xtp_trade_way_type,id',
            'type2' => 'required|exists:xtp_trade_way_type,id',
            'type3' => 'required|exists:xtp_trade_way_type,id',
            'name' => 'required|unique:xtp_trade_way,name,'.$id.',id|max:64',
            'summary' => ''
        ]);

        $tradeway->name = $request->input('name');
        $tradeway->type1_id = $request->input('type1');
        $tradeway->type2_id = $request->input('type2');
        $tradeway->type3_id = $request->input('type3');
        $tradeway->key = md5($tradeway->name . ',' . $tradeway->type1_id . ',' . $tradeway->type2_id . ',' . $tradeway->type3_id);
        $tradeway->summary = $request->input('summary');

        event(new OpLog($tradeway));

        if ($tradeway->save()) {
            return Redirect::to('tradeway/'.$id);
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
        $tradeway = TradeWays::findOrFail($id);
        if (!$tradeway){
            $ret['error_code'] = -1;
            $ret['error_message'] = '不存在';
        } else {
            if ($tradeway->status != -1 ){
                $tradeway->name .= 'D';
                $tradeway->status = -1;
                if (!$tradeway->save()) {
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

        $tradeway = TradeWays::findOrFail($id);

        return view('tradeway.show', ['tradeway'=>$tradeway]);
    }
}
