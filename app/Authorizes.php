<?php

namespace App;

use App\Api;


class Authorizes
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



}
