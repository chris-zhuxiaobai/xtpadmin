<?php

namespace App\Policies;

use App\User;
use App\OmsConfigs;
use App\Policies\XtpPolicy;


class OmsConfigsPolicy extends XtpPolicy
{
    public function enter(User $user, OmsConfigs $omsConfigs)
    {
        return $user->hasPermission('t_xtp_server_admin');
    }
}
