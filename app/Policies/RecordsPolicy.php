<?php

namespace App\Policies;

use App\User;
use App\Records;
use App\Policies\XtpPolicy;


class RecordsPolicy extends XtpPolicy
{
    public function enter(User $user, Records $records)
    {
        return $user->hasPermission('t_xtp_server_admin');
    }
}
