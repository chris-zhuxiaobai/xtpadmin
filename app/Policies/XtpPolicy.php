<?php

namespace App\Policies;

use Illuminate\Auth\Access\HandlesAuthorization;
use App\Api;
use App\User;


class XtpPolicy
{
    use HandlesAuthorization;

    /**
     * Create a new policy instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->api = new Api();
    }



    /**
     * Intercepting All Checks
     *
     * @param  \App\User  $user
     * @return bool
     */
    public function before(User $user, $ability)
    {
        if ($user->isSuperAdmin()) {
            return true;
        }
    }
}
