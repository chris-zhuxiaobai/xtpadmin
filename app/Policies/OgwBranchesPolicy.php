<?php

namespace App\Policies;

use App\User;
use App\OgwBranches;
use App\Policies\XtpPolicy;


class OgwBranchesPolicy extends XtpPolicy
{
    public function enter(User $user, OgwBranches $ogwBranches)
    {
        return $user->hasPermission('t_xtp_server_admin');
    }
}
