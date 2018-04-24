<?php

namespace App\Policies;

use App\User;
use App\OgwConfigs;
use App\Policies\XtpPolicy;


class OgwConfigsPolicy extends XtpPolicy
{
    public function enter(User $user, OgwConfigs $ogwConfigs)
    {
        return $user->hasPermission('t_xtp_server_admin');
    }
}
