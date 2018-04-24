<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Events\OpLog;
use App\Permissions;
use App\Authorizes;
use Gate;
use Redirect;
use Auth;


class AuthorizeController extends Controller
{
    /**
     * construct
     *
     */
    public function __construct()
    {
        $this->middleware('auth');

        $this->permission = new Permissions();
        $this->auth = new Authorizes();
    }

    public function index()
    {
        event(new OpLog());

        if (Gate::denies('enter', new Authorizes())) {
            abort(403);
        }

        $users = $this->auth->applications_users([
            'size' => 1000,
            'page' => 1
        ]);
        if (is_array($users) && !empty($users['items'])){
            $user_lists = $users['items'];
        }

        $view_data = [
            'authorize_lists' => $user_lists
        ];

        return view('authorize.list', $view_data);
    }

    public function create()
    {
        event(new OpLog());

        if (Gate::denies('enter', new Authorizes())) {
            abort(403);
        }

        return view('authorize.create.username');
    }

    public function choice(Request $request)
    {
        event(new OpLog());

        if (Gate::denies('enter', new Authorizes())) {
            abort(403);
        }

        $username = $request->input('username');
        $user = $this->auth->users([
            'userName' => $username
        ]);

        if (!is_array($user) || empty($user['items'])){
            return Redirect::back()->withInput()->withErrors(['username'=>$username.'不存在']);
        }

        if ($user['count'] == 1){
            return $this->edit($user['items'][0]['id']);
        } else {
            $view_data = [
                'user_lists' => $user['items']
            ];
            return view('authorize.create.choice', $view_data);
        }

    }

    public function edit($userid)
    {
        event(new OpLog($userid));

        if (Gate::denies('enter', new Authorizes())) {
            abort(403);
        }

        $user = $this->permission->user($userid, false);
        $permission = $this->permission->all();

        foreach ($user['permissions'] as $item){
            if (isset($permission[$item['permissionNumber']])){
                $permission[$item['permissionNumber']]['check'] = true;
            }
        }

        $view_data = [
            'user' => $user,
            'permission' => $permission
        ];

        return view('authorize.create.create', $view_data);
    }

    public function auth(Request $request)
    {
        event(new OpLog());

        if (Gate::denies('enter', new Authorizes())) {
            abort(403);
        }

        $userid = $request->input('id');
        $permission_ids = $request->input('permission');
        $permission = $this->permission->all();

        if (!is_array($permission_ids)){
            $permission_ids = [];
        }

        $num = 0;
        foreach ($permission as $item){
            if(array_search($item['id'], $permission_ids)!==false){
                $ret = $this->auth->user_permission_create($userid, $item['id']);
                if ($ret['http_error']['code'] == 0 ){
                    $num ++;
                }
            } else {
                $ret = $this->auth->user_permission_delete($userid, $item['id']);
                if ($ret['http_error']['code'] == 0 ){
                    $num ++;
                }
            }
        }

        return $this->show($userid);
    }


    public function show($id)
    {
        event(new OpLog($id));

        if (Gate::denies('enter', new Authorizes())) {
            abort(403);
        }

        $user = $this->permission->user($id, false);


        $view_data = [
            'user' => $user
        ];

        return view('authorize.show', $view_data);
    }


}