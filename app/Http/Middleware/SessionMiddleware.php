<?php

namespace App\Http\Middleware;
use Illuminate\Support\Facades\Auth;

use Closure;

class SessionMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if(Auth::check()) {
            $user = Auth::user();
            $access = $user->access;
            $username = $user->username;
            view()->share(["access" => $access, "username" => $username]);
        } else {
            $access = "0";
            view()->share(["access" => $access]);
        }
        
        return $next($request);
    }
}
