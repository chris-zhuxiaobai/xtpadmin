<?php

namespace App\Policies;

use App\User;
use App\Servers;
use App\Policies\XtpPolicy;


class ServersPolicy extends XtpPolicy
{
    public function enter(User $user, Servers $server)
    {
        return $user->hasPermission('t_xtp_server_admin');
    }
}
