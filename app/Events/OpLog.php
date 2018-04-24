<?php

namespace App\Events;

use Auth;
use App\Events\Event;
use Illuminate\Queue\SerializesModels;

class OpLog extends Event
{
    use SerializesModels;

    /**
     * Create a new event instance.
     *
     * @param  Order  $order
     * @return void
     */
    public function __construct($model_data=null)
    {
        $bt = debug_backtrace(DEBUG_BACKTRACE_IGNORE_ARGS, 2)[1];
        $env = $_SERVER;
        $input = $_REQUEST;
        unset($input['password'], $input['user_pass'], $input['password_confirm']);

        $this->controller = $bt['class'];
        $this->action = $bt['function'];
        $this->model_data = json_encode($model_data);
        $this->username = Auth::user()['username'];
        $this->env = json_encode($env);
        $this->input = json_encode($_REQUEST);
    }


}