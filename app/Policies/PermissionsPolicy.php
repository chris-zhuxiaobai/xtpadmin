<?php

namespace App\Policies;

use App\User;
use App\Permissions;
use App\Policies\XtpPolicy;


class PermissionsPolicy extends XtpPolicy
{
    public function enter(User $user, Permissions $permissions)
    {
        return $user->hasPermission('t_xtp_server_admin');
    }
}
