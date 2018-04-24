<?php

namespace App\Policies;

use App\User;
use App\Orgs;
use App\Policies\XtpPolicy;


class OrgsPolicy extends XtpPolicy
{
    public function enter(User $user, Orgs $orgs)
    {
        return $user->hasPermission('t_xtp_server_admin');
    }
}
