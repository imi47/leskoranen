<?php

namespace App\Http\Middleware;

use Closure;

class AdminRole
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
        if(\Auth::check() AND \Auth::user()->is_admin AND \Auth::user()->role == 1){
            if(\Auth::user()->status == 0 OR \Auth::user()->is_blocked == 1)
            {
                \Auth::logout();
                return redirect(admin());
            }
            return $next($request);
        }else{
            return redirect(admin());
        }
    }
}
