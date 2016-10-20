<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;
use App\Api;

class Permissions
{
    /**
     * construct
     *
     */
    public function __construct()
    {
        $this->api = new Api();
    }

    public function __call($name, $arguments)
    {
        if (method_exists($this->api, $name)
            && is_callable(array($this->api, $name))){
            return call_user_func_array(array($this->api, $name), $arguments);
        }

        throw new BadMethodCallException();
    }

    protected function makeProperty(&$maps, $index) {
        $property = new \stdClass();
        if (isset($maps[$index])){
            $map =$maps[$index];
            foreach ($map as $k=>$v) {
                $property->$k = $v;
            }
        }

        return $property;
    }

    protected function makeType($permissionTypeId) {
        static $types_map = [
            1 => ['id' => 1, 'name' => 'entry', 'title' => '单个权限'],
            2 => ['id' => 2, 'name' => 'menu', 'title' => '组权限']
        ];

        $type = $this->makeProperty($types_map, $permissionTypeId);

        return $type;
    }

    protected function makeLevel($levelId) {
        static $levels_map = [
            1 => ['id' => 1, 'name' => 'entry', 'title' => '准入'],
            2 => ['id' => 2, 'name' => 'menu', 'title' => '功能菜单'],
            3 => ['id' => 3, 'name' => 'button', 'title' => '按钮'],
        ];

        $level = $this->makeProperty($levels_map, $levelId);

        return $level;
    }

    protected function makeStatus($status) {
        static $status_map = [
            1 => ['id' => 1, 'name' => 'enabled', 'title' => '启用'],
            2 => ['id' => 2, 'name' => 'disabled', 'title' => '未启用']
        ];

        $status = $this->makeProperty($status_map, $status);

        return $status;
    }

    private function init_permissions(){
        $this->permission_list = [
            't_xtp_server_admin' => ['name' => '服务节点管理', 'enabled' => false],
            't_xtp_custom_mng_admin' => ['name' => '客户审核管理', 'enabled' => false],
            't_xtp_custom_teller' => ['name' => '营业部柜员管理', 'enabled' => false],
            't_xtp_supervision_admin' => ['name' => '监管管理', 'enabled' => false],
            't_xtp_other' => ['name' => '其它管理', 'enabled' => false],
        ];

        $permissions = $this->permissions();
        if (is_array($permissions) && count($permissions)>0 && !empty($permissions['items'])){
            $permissions = $permissions['items'];
        } else {
            $permissions = [];
        }

        foreach ($permissions as $permission){
            if (isset($this->permission_list[$permission['permissionNumber']])){
                $this->permission_list[$permission['permissionNumber']] = array_merge(
                    $this->permission_list[$permission['permissionNumber']],
                    $permission
                );
                $this->permission_list[$permission['permissionNumber']]['enabled'] = true;
            }
        }

        foreach ($this->permission_list as $name=>$item){
            if ($item['enabled']) continue;

            $permission = [
                'permissionName' => $item['name'],
                'permissionNumber' => $name,
                'permissionType' => 2,
                'permissionLevel' => 2
            ];

            $ret = $this->permission_create($permission);
            if (is_array($ret) && $ret['http_error']['code']==0){
                $this->permission_list[$permission['permissionNumber']] = array_merge(
                    $this->permission_list[$permission['permissionNumber']],
                    $permission
                );
                $this->permission_list[$permission['permissionNumber']]['enabled'] = true;
            }
        }

        return $this->permission_list;
    }

    public function user($userid, $cache=true)
    {
        $user = $this->api->user($userid, $cache);
        $permissions = $this->all();
        foreach ($user['permissions'] as $i=>$item) {
            if ($item['permissionType'] == 2) {
                if (isset($permissions[$item['permissionNumber']])){
                    $user['permissions'][$i] = $permissions[$item['permissionNumber']];
                } else {
                    unset($user['permissions'][$i]);
                }
            }
        }

        return $user;
    }

    public function all(){

        return $this->init_permissions();
    }




}
