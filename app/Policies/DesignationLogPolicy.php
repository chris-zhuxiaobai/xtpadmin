<?php

namespace App\Policies;

use App\User;
use App\DesignationLog;
use App\Policies\XtpPolicy;


class DesignationLogPolicy extends XtpPolicy
{
    public function enter(User $user, DesignationLog $designationLog)
    {
        return $user->hasPermission('t_xtp_server_admin');
    }
}
