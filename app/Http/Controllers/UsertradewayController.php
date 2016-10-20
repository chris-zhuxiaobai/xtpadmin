<?php

namespace App\Http\Controllers;

use App\Users;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Events\OpLog;
use App\UserTradeWays;
use App\TradeWays;
use App\TradeWayTypes;
use Redirect;
use Gate;

class UserTradeWayController extends Controller
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
        if (Gate::denies('enter', new UserTradeWays())) {
            abort(403);
        }

        $usertradeways = UserTradeWays::get();

        return view('usertradeway.list', ['usertradeways'=>$usertradeways]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        event(new OpLog());
        if (Gate::denies('enter', new UserTradeWays())) {
            abort(403);
        }

        $tradeway_lists = TradeWays::where('status', '0')->get();

        return view('usertradeway.create', ['tradeway_lists'=>$tradeway_lists]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store(Request $request)
    {
        event(new OpLog());

        $user_name = $request->input('user_name');
        $user = Users::where('user_name', $user_name)->get();

        if (count($user)>0) {
            $user = $user[0];
            $user_id = $user->id;
        } else {
            $user_id = 0;
        }

        $this->validate($request, [
            'user_name' => 'required|exists:xtp_user,user_name|max:32',
            'trade_way_id' => 'required|exists:xtp_trade_way,id|unique:xtp_user_tradeway,tradeway_id,NULL,id,user_id,'.$user_id
        ]);

        $usertradeway = new UserTradeWays();
        if (Gate::denies('enter', $usertradeway)) {
            abort(403);
        }

        $usertradeway->user_id = $user->id;
        $usertradeway->tradeway_id = $request->input('trade_way_id');

        $ret = $usertradeway->save();
        event(new OpLog($usertradeway));

        if ($ret) {
            return Redirect::to('usertradeway/'.$usertradeway->id);
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

        $usertradeway = UserTradeWays::findOrFail($id);
        if (Gate::denies('enter', $usertradeway)) {
            abort(403);
        }

        $tradeway_types = TradeWayTypes::getMap();

        return view('usertradeway.edit', ['usertradeway'=>$usertradeway, 'tradeway_types'=>$tradeway_types]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function update(Request $request, $id)
    {
        event(new OpLog($id));

        $usertradeway = UserTradeWays::findOrFail($id);
        if (Gate::denies('enter', $usertradeway)) {
            abort(403);
        }

        $this->validate($request, [
            'type1' => 'required|exists:xtp_trade_way_type,id',
            'type2' => 'required|exists:xtp_trade_way_type,id',
            'type3' => 'required|exists:xtp_trade_way_type,id',
            'name' => 'required|unique:xtp_trade_way,name,'.$id.',id|max:64',
            'summary' => ''
        ]);

        $usertradeway->name = $request->input('name');
        $usertradeway->type1_id = $request->input('type1');
        $usertradeway->type2_id = $request->input('type2');
        $usertradeway->type3_id = $request->input('type3');
        $usertradeway->key = md5($usertradeway->name . ',' . $usertradeway->type1_id . ',' . $usertradeway->type2_id . ',' . $usertradeway->type3_id);
        $usertradeway->summary = $request->input('summary');

        event(new OpLog($usertradeway));

        if ($usertradeway->save()) {
            return Redirect::to('usertradeway/'.$id);
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
        $usertradeway = UserTradeWays::findOrFail($id);
        if (Gate::denies('enter', $usertradeway)) {
            abort(403);
        }
        if (!$usertradeway){
            $ret['error_code'] = -1;
            $ret['error_message'] = '不存在';
        } else {
            if (!$usertradeway->delete() ){
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

        $usertradeway = UserTradeWays::findOrFail($id);
        if (Gate::denies('enter', $usertradeway)) {
            abort(403);
        }

        return view('usertradeway.show', ['usertradeway'=>$usertradeway]);
    }
}
