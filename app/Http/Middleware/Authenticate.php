<?php

namespace App\Http\Middleware;

use Closure;
use Auth;
use App\User;


class Authenticate
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  $guard
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = null)
    {
        if (cas()->isAuthenticated()){
            if (Auth::guest()) {
                $user = new User(cas()->getCurrentUser());
                Auth::guard()->login($user);
            }
        } else {
            cas()->authenticate();
        }

//
//        if( ! cas()->isAuthenticated() )
//        {
//            if ($request->ajax()) {
//                return response('Unauthorized.', 401);
//            }
//
//            cas()->authenticate();
//        }
//        session()->put('username', cas()->getAttribute('userName'));
//        session()->put('auth', []);

        if (Auth::guard($guard)->guest()) {
            if ($request->ajax() || $request->wantsJson()) {
                return response('Unauthorized.', 401);
            } else {
                return redirect()->guest('auth/login');
            }
        }


        return $next($request);
    }
}
