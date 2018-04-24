<?php

namespace App\Policies;

use App\User;
use App\OpLogs;
use App\Policies\XtpPolicy;


class OpLogsPolicy extends XtpPolicy
{
    public function enter(User $user, OpLogs $log)
    {
        return $user->hasPermission('t_xtp_supervision_admin');
    }
}
