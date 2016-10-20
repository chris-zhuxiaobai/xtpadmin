<?php

namespace App\Policies;

use App\User;
use App\SecuInfo;
use App\Policies\XtpPolicy;


class SecuinfoPolicy extends XtpPolicy
{
    public function enter(User $user, SecuInfo $SecuInfo)
    {
        return $user->hasPermission('t_xtp_server_admin');
    }
}
