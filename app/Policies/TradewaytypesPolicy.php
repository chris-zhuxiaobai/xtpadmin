<?php

namespace App\Policies;

use App\User;
use App\TradewayTypes;
use App\Policies\XtpPolicy;


class TradewaytypesPolicy extends XtpPolicy
{
    public function enter(User $user, TradewayTypes $tradewayTypes)
    {
        return $user->hasPermission('t_xtp_server_admin');
    }
}
