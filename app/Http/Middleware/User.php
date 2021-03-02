<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class User
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
//        Session::remove(NAME_SESSION);
        $userCookie = $request->cookie(NAME_SESSION);
        $userSession = Session::get(NAME_SESSION);
//        dd(json_decode($userCookie));

        if(!$userCookie) {
            $userInfo = json_encode(['count' => 0, 'products' => []]);

//            if(!$userSession) {
//                Session::put(NAME_SESSION, $userInfo);
//            }

            return $next($request)->withCookie(cookie(NAME_SESSION, $userInfo, env('SESSION_LIFETIME', 120), '/', null, null, false, false, null));
        }
        else {
//            if(!$userSession) {
//
//                return $next($request)->withCookie(cookie(NAME_SESSION, $userCookie, env('SESSION_LIFETIME', 120), '/', null, null, false, false, null));
//            }

            return $next($request);
        }
    }
}
