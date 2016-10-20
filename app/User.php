<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;
use App\Api;

class User extends Authenticatable
{

    protected $superAdmin = 'xtpadmin';

    protected $property_map = [
        'userId' => 'id',
        'userName'  => 'username',
    ];

    protected function setProperties($properties)
    {

        if (!is_array($properties) || !count($properties)) return;

        foreach ($properties as $k=>$v){
            if (isset($this->property_map[$k])){
                $this->{$this->property_map[$k]} = $v;
            } else {
                $this->$k = $v;
            }
        }

        if (!isset($this->name) && isset($this->username)){
            $this->name = $this->username;
        }
    }

    /**
     * construct
     *
     */
    public function __construct($username)
    {
        $this->api = new Api();
        if (!empty($username)){
            $properties_extra = $this->api->user_by_name($username);
            $this->setProperties($properties_extra);
        }

    }

    /**
     * isSuperAdmin
     *
     */
    public function isSuperAdmin(){
        return $this->superAdmin == $this->username;
    }

    /**
     * hasPermission
     *
     */
    public function hasPermission($permission_name){
        $api = new Api();
        $user = $api->user($this->id);
        if (is_array($user) && !empty($user['permissions'])){
            foreach ($user['permissions'] as $permission){
                if ($permission_name == $permission['permissionNumber']){
                    return true;
                }
            }
        }

        return false;
    }

//    public function
}
