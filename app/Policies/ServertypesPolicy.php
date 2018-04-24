<?php

namespace App\Policies;

use App\User;
use App\ServerTypes;
use App\Policies\XtpPolicy;


class ServertypesPolicy extends XtpPolicy
{
    public function enter(User $user, ServerTypes $serverTypes)
    {
        return $user->hasPermission('t_xtp_server_admin');
    }
}
