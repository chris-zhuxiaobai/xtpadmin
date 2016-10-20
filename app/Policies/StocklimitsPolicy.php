<?php

namespace App\Policies;

use App\User;
use App\StockLimits;
use App\Policies\XtpPolicy;


class StocklimitsPolicy extends XtpPolicy
{
    public function enter(User $user, StockLimits $stockLimits)
    {
        return $user->hasPermission('t_xtp_server_admin');
    }
}
