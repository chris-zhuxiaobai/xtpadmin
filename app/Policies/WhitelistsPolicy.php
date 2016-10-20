<?php

namespace App\Policies;

use App\User;
use App\Whitelists;
use App\Policies\XtpPolicy;


class WhitelistsPolicy extends XtpPolicy
{
    public function enter(User $user, Whitelists $whiteLists)
    {
        return $user->hasPermission('t_xtp_custom_mng_admin');
    }
}
