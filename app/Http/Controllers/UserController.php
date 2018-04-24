<?php

namespace App\Http\Controllers;

use App\Helpers\Helpers;
use App\OmsConfigs;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

use App\Http\Requests;
use App\Events\OpLog;
use App\UserTradeWays;
use App\Users;
use App\Whitelists;
use App\Branches;
use Redirect;
use Gate;

class UserController extends Controller
{
    /**
     * construct
     *
     */
    public function __construct()
    {
        $this->middleware('auth');


    }

    private function designation_process_sh($user_id, $bregist=0){
        $market = 'sh';
        if ($bregist == 1) {
            $pre_user = Whitelists::findOrFail($user_id);
        } else {
            $user = Users::findOrFail($user_id);
            $pre_users = Whitelists::where('fundid', $user->fundid)->get();

            if ($pre_users && count($pre_users)){
                $pre_user = $pre_users[0];
            } else {
                return ['error_code'=>10022,'error_msg'=>'找不到预定义客户'];
            }
        }

//        $secu_infos = $user->secuInfo;
//        if (!empty($secu_infos)){
//            foreach ($secu_infos as $secu_info){
//                if ($secu_info->market == 1){
//                    $secu_info_sh = $secu_info;
//                    break;
//                }
//            }
//        }
//        if (empty($secu_info_sh)){
//            return ['error_code'=>10032,'error_msg'=>'找不到客户信息'];
//        }

        $org_branche_sh = Branches::where('market', 1)->where('jzjy_node_id', $pre_user->node_id)
            ->where('org_id', $pre_user->orgid)->get();
        if (!$org_branche_sh || count($org_branche_sh) != 1) {
            return ['error_code' => 10024, 'error_msg' => '找不到该客户所在营业部的上交所合同号数据'];
        }
        $org_branche_sh = $org_branche_sh[0];

        $param_sh = [
            $bregist,
            $pre_user->accountid,
            $org_branche_sh->mkt_branch_id,
            $org_branche_sh->prefix
        ];
        $ret_sh = Helpers::designation($market, $param_sh);
        if (!isset($ret_sh['status'])) {
            return ['error_code' => 10026, 'error_msg' => '执行超时或者调用失败'];
        }
        if (($ret_sh['status']) != 0) {
            return ['error_code' => 11100 + $ret_sh['status'], 'error_msg' => '参数错误'];
        }
        if (isset($ret_sh['error_code']) && ($ret_sh['error_code']) != 0) {
            return ['error_code' => 12100 + $ret_sh['error_code'], 'error_msg' => $ret_sh['message']];
        }

        return ['error_code'=>0];

    }

    private function designation_process_sz($user_id, $pbu_id){
        $market = 'sz';

        if (empty($pbu_id)){
            return ['error_code'=>10011,'error_msg'=>'pbu id 不能为空'];
        }

        $user = Users::findOrFail($user_id);
        $pre_users = Whitelists::where('fundid',$user->fundid)->get();

        if ($pre_users && count($pre_users)){
            $pre_user = $pre_users[0];
        } else {
            return ['error_code'=>10023,'error_msg'=>'找不到预定义客户'];
        }

        $secu_infos = $user->secuInfo;
        if (!empty($secu_infos)){
            foreach ($secu_infos as $secu_info){
                if ($secu_info->market == 0){
                    $secu_info_sz = $secu_info;
                    break;
                }
            }
        }
        if (empty($secu_info_sz)){
            return ['error_code'=>10033,'error_msg'=>'找不到客户深交所股东帐号信息'];
        }

        $org_branche_sz =  Branches::where('market',0)->where('jzjy_node_id', $pre_user->node_id)
            ->where('org_id', $pre_user->orgid)->get();
        if (!$org_branche_sz || count($org_branche_sz) !=1) {
            return ['error_code' => 10025, 'error_msg' => '找不到该客户所在营业部的深交所合同号数据'];
        }
        $org_branche_sz = $org_branche_sz[0];

        $param_sz = [
            $pbu_id,
            $secu_info_sz->secu_acc,
            $org_branche_sz->mkt_branch_id,
            $org_branche_sz->prefix
        ];
        $ret_sz = Helpers::designation($market, $param_sz);
        if (!isset($ret_sz['status'])) {
            return ['error_code' => 10027, 'error_msg' => '执行超时或者调用失败'];
        }
        if (($ret_sz['status']) != 0) {
            return ['error_code' => 11200 + $ret_sz['status'], 'error_msg' => '参数错误'];
        }
        if (isset($ret_sh['error_code']) && ($ret_sz['error_code']) != 0) {
            return ['error_code' => 12200 + $ret_sz['error_code'], 'error_msg' => $ret_sz['message']];
        }

        return ['error_code'=>0];
    }

    public function designation(Request $request) {

        $pre_user_id = $request->input('pre_user_id');
        $user_id = $request->input('user_id');
        $market = $request->input('market');
        $pbu_id = $request->input('pbu_id');
        $flag = 0;

        if (!empty($pre_user_id)){
            if (empty($market)) {
                $market = 'sh';
            }
            if (empty($user_id)){
                $user_id = $pre_user_id;
            }
            $flag = 1;
        }


        if ($market == 'sh'){
            $ret = $this->designation_process_sh($user_id, $flag);
        } else if ($market == 'sz'){
            $ret = $this->designation_process_sz($user_id, $pbu_id);
        }
        if (!is_array($ret)){
            $ret = [$ret];
        }

        return new JsonResponse($ret);
    }


    /**
     * index
     *
     * @return Response
     */
    public function index(Request $request)
    {

        event(new OpLog());
        if (Gate::denies('enter', new Users())) {
            abort(403);
        }

        $filter_user_id = (int) $request->input('filter_user_id');
        $filter_user_name = $request->input('filter_user_name');
        $filter_fundid = $request->input('filter_fundid');

        $query = $request->input();
        $page = empty($query['page']) ? 1 : max(1, intval($query['page']));
        unset($query['page']);
        $users = Users::query();
        if ($filter_user_id){
            $users->where('id', '=', $filter_user_id);
        }
        if ($filter_user_name){
            $users->where('user_name', '=', $filter_user_name);
        }
        if ($filter_fundid){
            $users->where('fundid', '=', $filter_fundid);
        }
        $users->where('user_type', 0);

        $user_lists = $users->paginate()->appends($query);

        $view_data = [
            'user_lists'=>$user_lists,
            'page'=>$page,
            'query'=>$query
        ];

        return view('user.list', $view_data);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create(Request $request)
    {
        event(new OpLog());
        if (Gate::denies('enter', new Users())) {
            abort(403);
        }

        return view('user.create.choice');

//        $white_lists = Whitelists::where('status', 0)->get();
//        if (count($white_lists)>0) {
//            $view_data = [
//                'white_lists' => $white_lists
//            ];
//
//            return view('user.create.choice', $view_data);
//        } else {
//            return view('user.create.empty');
//        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function choice(Request $request)
    {
        $fundid = $request->input('fundid');
        $pre_user = Whitelists::where('fundid', $fundid)->get();
        if (empty($pre_user) || empty($pre_user[0])) {
            return Redirect::back()->withInput()->withErrors(['fundid'=>"资金帐号「{$fundid}」当前尚未执行预开户操作, 无法进行开户"]);
        }
        $pre_user = $pre_user[0];
        if ($pre_user['status']!=0) {
            if ($pre_user['status'] == 1){
                $pre_user_status = '已经开户';
            } elseif ($pre_user['status'] == -1){
                $pre_user_status = '已经在预开户数据中删除';
            } else {
                $pre_user_status = "状态异常(status={$pre_user['status']})";
            }
            return Redirect::back()->withInput()->withErrors(['fundid'=>"资金帐号「{$fundid}」当前{$pre_user_status}, 无法进行开户"]);
        }

        event(new OpLog($pre_user));

        $exist = Users::where('user_name', $pre_user->fundid)->orWhere('fundid', $pre_user->fundid)->get();
        if ($exist && count($exist) > 0) {
            return Redirect::back()->withInput()->withErrors(['fundid'=>"客户 [xtp帐号:{$exist[0]['user_name']}, 资金帐号:{$exist[0]['fundid']}] 已存在"]);
        }
        unset($exist);

        if (!$pre_user->trade){
            return Redirect::back()->withInput()->withErrors(['fundid'=>"客户预开户数据中不存在交易节点配置, 无法进行开户"]);
        }

        $oms_config = OmsConfigs::where('oms_id', $pre_user->trade->id)->get();
        if (!empty($oms_config) && count($oms_config)){
            $oms_config = $oms_config[0];
        }

        return view('user.create.create', ['pre_user'=>$pre_user, 'oms_config'=>$oms_config]);

    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'pre_user_id' => 'required|exists:xtp_white_list,id',
            'password' => 'required|min:6|confirmed',
        ]);

        $pre_user_id = $request->input('pre_user_id');
        $pre_user = Whitelists::findOrFail($pre_user_id);

        $exist = Users::where('user_name', $pre_user->fundid)->orWhere('fundid', $pre_user->fundid)->get();
        if ($exist && count($exist) > 0) {
            return Redirect::to('user/failure?exists')->withErrors(["客户[xtp帐号:{$exist[0]['user_name']}, 资金帐号:{$exist[0]['fundid']}] 已存在"]);;
        }
        unset($exist);

        $org_branche_sh =  Branches::where('market',1)->where('jzjy_node_id', $pre_user->node_id)
            ->where('org_id', $pre_user->orgid)->get();
        if (!$org_branche_sh || count($org_branche_sh) !=1) {
            return Redirect::to('user/failure?branche.sh')->withErrors(['找不到该客户所在营业部的上交所合同号数据']);
        }

        $user = new Users();

        if (Gate::denies('enter', $user)) {
            abort(403);
        }

        $user->user_name = $pre_user->fundid;
        $user->user_pass = md5($request->input('password'));
        $user->custid = $pre_user->custid;
        $user->fundid = $pre_user->fundid;
        $user->user_type = $pre_user->trade->sub_type;
        $user->quote_server_id = $pre_user->quote->id;
        $user->trade_server_id = $pre_user->trade->id;
        $user->max_connection = $pre_user->max_connection;
        $user->status = 0;

        event(new OpLog($user));

        if (!$user->save()) {
            return Redirect::to('user/failure?db')->withErrors(['数据库处理失败']);
        }

        $user_trade_way = new UserTradeWays();
        $user_trade_way->user_id = $user->id;
        $user_trade_way->tradeway_id = $pre_user->trade_way_id;
        $user_trade_way->save();

        event(new OpLog($user_trade_way));

        $pre_user->status = 1;
        $pre_user->save();

        event(new OpLog($pre_user));

        return Redirect::to('user/success/'.$user->id);

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

        $user = Users::findOrFail($id);

        if (Gate::denies('enter', $user)) {
            abort(403);
        }

        $user_types = ServerTypes::getMap();

        return view('user.edit', ['user'=>$user, 'user_types'=>$user_types]);
    }



    /**
     *
     *
     * @return Response
     */
    public function getDestroy()
    {
        event(new OpLog());

        return view('user.destroy.home');
    }

    /**
     *
     *
     * @param  int  $id
     * @return Response
     */
    public function check(Request $request)
    {
        $user_name = $request->input('user_name');
        $this->validate($request, [
            'user_name' => 'required|exists:xtp_user,user_name',
        ]);

        $user = Users::where('user_name', $user_name)->get();

        if (empty($user)){
            return Redirect::back()->withInput()->withErrors(['找不到用户']);
        }
        $user = $user[0];

        if (Gate::denies('enter', $user)) {
            abort(403);
        }

        event(new OpLog($user));

        return view('user.destroy.designation', ['user'=>$user]);
    }

//    /**
//     * Update the specified resource in storage.
//     *
//     * @param  int  $id
//     * @return Response
//     */
//    public function update(Request $request, $id)
//    {
//        event(new OpLog($id));
//
//        $user = Users::findOrFail($id);
//
//        if ($user->save()) {
//            return Redirect::to('user/success/'.$id);
//        } else {
//            return Redirect::back()->withInput()->withErrors('保存失败！');
//        }
//    }

//    /**
//     * Remove the specified resource from storage.
//     *
//     * @param  int  $id
//     * @return Response
//     */
    public function destroy($id)
    {
        event(new OpLog($id));

        $user = Users::findOrFail($id);

        if (Gate::denies('enter', $user)) {
            abort(403);
        }

        $user->status = -1;
        $user->destroy_at = date('Y-m-d H:i:s');
        $ret = $user->save();

        if ($ret) {
            return view('user.destroy.success', ['user'=>$user]);
        } else {
            return view('user.destroy.failure', ['user'=>$user]);
        }
    }

    /**
     * Show the page for display result.
     *
     * @return Response
     */
    public function failure()
    {
        event(new OpLog());

        return view('user.create.failure');
    }

    /**
     * Show the page for display result.
     *
     * @return Response
     */
    public function success($id=0)
    {
        event(new OpLog($id));

        if ($id>0){
            $user = Users::find($id);
        }
        if (empty($user)){
            $user = new Users();
        }

        return view('user.create.success', ['user'=>$user]);
    }

    /**
     * Show the page for display resource.
     *
     * @return Response
     */
    public function show($id)
    {
        event(new OpLog($id));

        $user = Users::findOrFail($id);

        if (Gate::denies('enter', $user)) {
            abort(403);
        }

        return view('user.show', ['user'=>$user]);
    }


}
