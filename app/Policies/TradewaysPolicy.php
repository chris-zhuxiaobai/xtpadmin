<?php

namespace App\Policies;

use App\User;
use App\TradeWays;
use App\Policies\XtpPolicy;


class TradewaysPolicy extends XtpPolicy
{
    public function enter(User $user, TradeWays $tradeWays)
    {
        return $user->hasPermission('t_xtp_server_admin');
    }
}
