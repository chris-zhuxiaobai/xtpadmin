<?php

namespace App\Listeners;

use App\OpLogs;

class OpLogEventListener
{

    public function handle($event)
    {
        $log = new OpLogs();
        $log->username = $event->username;
        $log->controller = $event->controller;
        $log->action = $event->action;
        $log->env = $event->env;
        $log->input = $event->input;
        $log->model_data = $event->model_data;

        $log->save();
    }
}