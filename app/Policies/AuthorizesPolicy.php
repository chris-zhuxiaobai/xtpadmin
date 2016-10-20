<?php

namespace App\Policies;

use App\User;
use App\Authorizes;
use App\Policies\XtpPolicy;


class AuthorizesPolicy extends XtpPolicy
{
    public function enter(User $user, Authorizes $authorizes)
    {
        return $user->hasPermission('t_xtp_server_admin');
    }
}
