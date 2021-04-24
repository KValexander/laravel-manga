<?php

namespace App\Http\Middleware;
use Illuminate\Support\Facades\Auth;

use Closure;

class AccessMiddleware
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
        if(Auth::check()) {  $user = Auth::user();

            if($user->access == "1" || $user->access == "2" ) { return $next($request); }
            else { return redirect()->route("message"); }

        } else { return redirect()->route("message"); }
        
    }
}
