<?php

namespace App\Http\Middleware;
use Illuminate\Support\Facades\Auth;

use Closure;

class UserMiddleware
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

        if(!Auth::check()) {
            // $message = "Вы не авторизованы";
            // $data = (object)["message" => $message];
            // return view("manga.errors.error", ["data" => $data]);
            return redirect()->route("error");
        }

        return $next($request);
        
    }
}
