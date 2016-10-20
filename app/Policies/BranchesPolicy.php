<?php

namespace App\Policies;

use App\User;
use App\Branches;
use App\Policies\XtpPolicy;


class BranchesPolicy extends XtpPolicy
{
    public function enter(User $user, Branches $branches)
    {
        return $user->hasPermission('t_xtp_server_admin');
    }
}
